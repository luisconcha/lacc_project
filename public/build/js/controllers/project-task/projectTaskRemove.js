angular.module( 'app.controllers' )
    .controller( 'ProjectTaskRemoveController',
    [ '$scope', '$location', '$routeParams', 'ProjectTask',
        function ( $scope, $location, $routeParams, ProjectTask ) {

            ProjectTask.get( {
                id: $routeParams.id,
                idTask: $routeParams.idTask
            }, function ( data ) {
                $scope.projectTask = data;
            } );
           console.info('$routeParams::: ',$routeParams.id );
            $scope.remove = function () {
                swal( {
                        title: "Remover?",
                        text: "Deseja deletar a tarefa do projeto? \n '" + $scope.projectTask.name + "'",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Sim, deletar!",
                        cancelButtonText: "Ups, não...!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function ( isConfirm ) {
                        if ( isConfirm ) {
                            ProjectTask.remove( {
                                id: $routeParams.id,
                                idTask: $routeParams.idTask
                            }, $scope.projectTask, function ( data ) {
                                if ( data.success ) {
                                    swal( "Deletado!",data.message, "success" );
                                    $location.path( '/project/' + $routeParams.id + '/tasks' );
                                } else {
                                    swal( "Ups!", data.message, "error" );
                                }
                            } );
                        } else {
                            swal( "Ups!!", "Quase faço #$%@!@ :)", "error" );
                        }
                    } );

            };

        } ] );