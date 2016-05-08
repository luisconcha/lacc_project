
angular.module( 'app.controllers' )
    .controller( 'ClientListController', [ '$scope', 'Client', function ( $scope, Client ) {
        Client.getClient( {}, function ( data ) {
            $scope.clients = data;
        } );
    } ] );