angular.module( 'app.controllers' )
    .controller( 'ProjectTaskEditController',
    [ '$scope', '$location', '$routeParams', 'ProjectTask', 'appConfig',
        function ( $scope, $location, $routeParams, ProjectTask, appConfig ) {

            $scope.projectTask = new ProjectTask.get( {
                id: $routeParams.id,
                idTask: $routeParams.idTask
            } );

            $scope.status = appConfig.projectTask.status;

            $scope.start_date = {
                status: { opened: false }
            };

            $scope.due_date = {
                status: { opened: false }
            };

            $scope.openStartDatePicker = function ( $evet ) {
                $scope.start_date.status.opened = true;
            };

            $scope.openDueDatePicker = function ( $evet ) {
                $scope.due_date.status.opened = true;
            };

            $scope.save = function () {
                if ( $scope.form.$valid ) {
                    ProjectTask.update( {
                        id: $routeParams.id,
                        idTask: $scope.projectTask.id
                    }, $scope.projectTask, function ( e ) {
                        console.info( 'Obj: ', e );
                        if ( e.error ) {
                            swal( "Ei.. Psiu!", e.message.due_date, "error" );
                            return;
                        }
                        swal( "Cadastro!", "A tarefa para o projeto '" + e.project_name + "' foi alterada com sucesso!.", "success" );
                        $location.path( '/project/' + $routeParams.id + '/tasks' );
                    } );
                }
            };

        } ] );