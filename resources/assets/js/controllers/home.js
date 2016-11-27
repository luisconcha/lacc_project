angular.module( 'app.controllers' )
    .controller( 'HomeController', [ '$scope', '$cookies', 'Project', '$pusher', '$timeout',
        function ( $scope, $cookies, Project, $pusher, $timeout ) {

            $scope.user_name       = $cookies.getObject( 'user' ).user_name;
            $scope.projects        = [];
            $scope.tasks           = [];
            $scope.totalProjects   = 0;
            $scope.projectsPerPage = 6;

            $scope.pagination = {
                current: 1
            };


            //Quando usuario clicar em uma páginação
            $scope.pageChanged = function ( newPage ) {
                getResultsPage( newPage );
            };

            function getResultsPage( pageNumber ) {
                Project.getProject( {
                    page: pageNumber,
                    limit: $scope.projectsPerPage
                }, function ( data ) {
                    console.log('Obj: ', data);
                    $scope.projects      = data.data;
                    $scope.totalProjects = data.meta.pagination.total;
                } );
            }

            //Chama a função na primeira página
            getResultsPage( 1 );

            /**
             * Reordena a forma de visualização dos projetos
             * @param typeView
             */
            $scope.alterViewProjects = function ( typeView ) {
                if ( typeView == 'viewList' ) {
                    $( '.div-list-project' ).removeClass( 'col-sm-4' ).addClass( 'col-sm-12' );
                } else if ( typeView == 'viewPanel' ) {
                    $( '.div-list-project' ).removeClass( 'col-sm-12' ).addClass( 'col-sm-4' );
                }
            };

            var pusher  = $pusher( window.client );
            var channel = pusher.subscribe( 'user.' + $cookies.getObject( 'user' ).user_id );
            channel.bind( 'LACC\\Events\\TaskWasIncluded',
                function ( data ) {

                    if ( $scope.tasks.length == 6 ) {
                        $scope.tasks.splice( $scope.tasks.length - 1, 1 );
                    }
                    $timeout( function () {
                        $scope.tasks.unshift( data.task );
                    }, 1000 );

                    //var name     = data.task.name;
                    //var createAt = data.task.created_at;
                    //Notification.success( {
                    //    message: 'Tarefa: <b>' + name + '</b> foi incluida em: ' + createAt,
                    //    title: 'LACC-Project',
                    //    positionY: 'bottom',
                    //    positionX: 'right',
                    //    delay: 2000
                    //} );
                }
            );

        } ] );