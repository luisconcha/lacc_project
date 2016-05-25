angular.module( 'app.controllers' )
    .controller( 'ProjectMemberRemoveController',
    [ '$scope', '$location', '$routeParams', 'ProjectTask',
        function ( $scope, $location, $routeParams, ProjectTask ) {


           console.info('$routeParams::: ',$routeParams);
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
                        console.info('isConfirm: ',isConfirm );
                        if ( isConfirm ) {
                            console.info('Obj: ','ssssssssssssssss' );
                            ProjectTask.remove( {
                                id: $routeParams.id,
                                idTask: $routeParams.idTask
                            }, function ( data ) {
                                console.info('Obj: ',data.success );
                                if ( data.success == "true" ) {
                                    console.log('Obj: ','asdasasd' );
                                    swal( "Deletado!",data.message, "success" );
                                    $location.path( '/project/' + $routeParams.id + '/members' );
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