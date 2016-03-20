angular.module( 'app.controllers' )
    .controller( 'ClientEditController',
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


            $scope.save = function () {
                if ( $scope.form.$valid ) {
                    //console.info($scope.client);
                    Client.update( { id: $scope.client.id }, $scope.client, function () {
                        $location.path( '/clients' );
                    } );
                }
            };
        } ] );