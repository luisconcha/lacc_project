angular.module( 'app.controllers' )
    .controller( 'ClientRemoveController',
    [ '$scope', '$location', '$routeParams', 'Client',
        function ( $scope, $location, $routeParams, Client ) {
            /**
             * :id do resource (service/client.js)
             * $routeParams.id da rota (app.js)
             * @type {Client.get}
             */
            Client.get( { id: $routeParams.id }, function ( data ) {
                $scope.client = data.data;
            } );

            $scope.remove = function () {
                //$scope.client.$delete().then( function () {
                //    $location.path( '/clients' );
                //} );

                // Client.remove({}, $scope.client, function () {
                //     $location.path( '/clients' );
                // } );
                swal({
                        title: "Remover?",
                        text: "Deseja remover o(a) cliente?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Sim, deletar!",
                        cancelButtonText: "Ups, não...!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            swal("Deletado!", "O cliente foi deletado com sucesso!.", "success");
                            Client.remove( {}, $scope.client, function () {
                                $location.path( '/clients' );
                            } )
                        } else {
                            swal("Ups!!", "Quase faço #$%@!@ :)", "error");
                        }
                    });
            };
        }
    ] );