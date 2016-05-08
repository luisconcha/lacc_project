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
                $scope.client = data;
            } );

            $scope.remove = function () {
                swal( {
                        title: "Remover?",
                        text: "Deseja remover o(a) cliente? \n" + $scope.client.name,
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
                            Client.remove( {}, $scope.client, function ( data ) {

                                if ( data.success ) {
                                    $location.path( '/clients' );
                                    swal( "Deletado!", data.success, "success" );
                                } else {
                                    swal( "Ups!", data.message, "error" );
                                }
                            } )
                        } else {
                            swal( "Ups!!", "Quase faço #$%@!@ :)", "error" );
                        }
                    } );
            };
        }
    ] );