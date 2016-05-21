angular.module( 'app.controllers' )
    .controller( 'ProjectTaskNewController',
    [ '$scope', '$location', '$routeParams', 'ProjectTask', 'appConfig',
        function ( $scope, $location, $routeParams, ProjectTask, appConfig ) {

            $scope.projectTask = new ProjectTask();
            $scope.status      = appConfig.projectTask.status;

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
                    $scope.projectTask.$save( { id: $routeParams.id } ).then( function () {
                        swal( "Cadastro!", "A tarefa para o projeto foi cadastrada com sucesso!.", "success" );
                        $location.path( '/project/' + $routeParams.id + '/tasks' );
                    } );
                }
            };

        } ] );