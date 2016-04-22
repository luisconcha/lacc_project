
angular.module( 'app.controllers' )
    .controller( 'ClientListController', [ '$scope', 'Client', function ( $scope, Client ) {
        Client.get( {}, function ( data ) {
            $scope.clients = data;
        } );
    } ] );