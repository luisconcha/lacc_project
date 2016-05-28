angular.module( 'app.controllers' )
    .controller( 'ProjectTaskListController', [
        '$scope', '$routeParams', 'appConfig', 'ProjectTask', '$timeout',
        function ( $scope, $routeParams, appConfig, ProjectTask, $timeout ) {

            $scope.showFrmJob          = false;
            $scope.projectTask         = new ProjectTask();
            $scope.projectTasks        = [];
            $scope.totalProjectTasks   = 0;
            $scope.projectTasksPerPage = 10;

            $scope.pagination = {
                current: 1
            };

            //Quando usuario clicar em uma páginação
            $scope.pageChanged = function ( newPage ) {
                getResultsPage( newPage );
            };

            function getResultsPage( pageNumber ) {

                //$scope.loadTask = function () {
                ProjectTask.query( {
                    id: $routeParams.id,
                    page: pageNumber,
                    limit: $scope.projectTasksPerPage
                }, function ( data ) {
                    $scope.projectTasks      = data.data;
                    $scope.totalProjectTasks = data.meta.pagination.total;
                } );
                //};
            }

            $scope.save = function () {
                if ( $scope.formJob.$valid ) {
                    $scope.projectTask.status = appConfig.projectTask.status[ 0 ].value;

                    $scope.projectTask.$save( { id: $routeParams.id } ).then( function ( e ) {

                        $timeout( function () {
                            $scope.showFrmJob = false;
                        }, 2000 );

                        //Cria uma nova instancia do frm para zerar o frm
                        $scope.projectTask = new ProjectTask();
                        //$scope.loadTask();
                        getResultsPage( 1 );
                    } )
                }
            };

            //Chama a função na primeira página
            getResultsPage( 1 );

            /**
             *  Função para reordenar a listagem das tasks
             */
            //$scope.loadTask = function () {
            //    /**
            //     * chama a lista de tarefas
            //     */
            //    $scope.projectTasks = ProjectTask.query( {
            //        id: $routeParams.id,
            //        orderBy: 'id',
            //        sortedBy: 'desc'
            //    } );
            //};
            //
            //$scope.loadTask();
        } ] );