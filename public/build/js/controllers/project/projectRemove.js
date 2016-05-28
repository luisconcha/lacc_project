angular.module( 'app.controllers' )
    .controller( 'ProjectRemoveController',
    [ '$scope', '$location', '$routeParams', 'Project',
        function ( $scope, $location, $routeParams, Project ) {

            /**
             * :id do resource (service/project.js)
             * $routeParams.id da rota (app.js)
             * @type {Project.get}
             */
            Project.get( { id: $routeParams.id }, function ( data ) {
                //Verifica se não existe msg de acesso negado
                if ( !data.access ) {
                    $scope.project = data;
                } else {
                    swal( "Aviso!", data.access, "warning" );
                    $location.path( '/projects' );
                }
            } );

            $scope.remove = function () {
                swal( {
                        title: "Remover?",
                        text: "Deseja deletar o  projeto? \n '" + $scope.project.name + "'",
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
                            Project.remove( {
                                id: $routeParams.id
                            }, $scope.project, function ( data ) {

                                if ( data.success ) {
                                    $location.path( '/projects' );
                                    swal( "Deletado!", data.success, "success" );
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