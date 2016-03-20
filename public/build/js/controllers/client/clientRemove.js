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

                Client.remove({}, $scope.client, function () {
                    $location.path( '/clients' );
                } );
            };
        }
    ] );