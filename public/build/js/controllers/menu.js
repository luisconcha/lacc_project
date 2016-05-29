angular.module( 'app.controllers' )
    .controller( 'MenuController', [ '$scope', '$cookies', function ( $scope, $cookies ) {
        $scope.user_name = $cookies.getObject( 'user' ).user_name;
    } ] );