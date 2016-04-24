angular.module( 'app.controllers' )
    .controller( 'ClientShowController',
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
        } ] );