angular.module( 'app.controllers' )
    .controller( 'ProjectTaskListController', [
        '$scope', '$routeParams', 'appConfig', 'ProjectTask', '$timeout',
        function ( $scope, $routeParams, appConfig, ProjectTask, $timeout ) {

            $scope.showFrmJob  = false;
            $scope.projectTask = new ProjectTask();

            $scope.save = function () {
                if ( $scope.formJob.$valid ) {
                    $scope.projectTask.status = appConfig.projectTask.status[ 0 ].value;

                    $scope.projectTask.$save( { id: $routeParams.id } ).then( function ( e ) {

                        $timeout( function () {
                            $scope.showFrmJob = false;
                        }, 2000 );

                        //Cria uma nova instancia do frm para zerar o frm
                        $scope.projectTask = new ProjectTask();
                        $scope.loadTask();
                    } )
                }
            };

            /**
             *  Função para reordenar a listagem das tasks
             */
            $scope.loadTask = function () {
                /**
                 * chama a lista de tarefas
                 */
                $scope.projectTasks = ProjectTask.query( {
                    id: $routeParams.id,
                    orderBy: 'id',
                    sortedBy: 'desc'
                } );
            };

            $scope.loadTask();
        } ] );