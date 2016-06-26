angular.module( 'app.controllers' )
    .controller( 'HomeController', [ '$scope', '$cookies', 'Project', function ( $scope, $cookies, Project ) {

        $scope.user_name       = $cookies.getObject( 'user' ).user_name;
        $scope.projects        = [];
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
                console.log( 'projects:: ', data.data );
                $scope.projects      = data.data;
                $scope.totalProjects = data.meta.pagination.total;
            } );
        }

        //Chama a função na primeira página
        getResultsPage( 1 );

        $scope.alterViewProjects = function ( typeView ) {
            if ( typeView == 'viewList' ) {
                $( '.div-list-project' ).removeClass( 'col-sm-4' ).addClass( 'col-sm-12' );
            } else if ( typeView == 'viewPanel' ) {
                $( '.div-list-project' ).removeClass( 'col-sm-12' ).addClass( 'col-sm-4' );
            }
        };

    } ] );