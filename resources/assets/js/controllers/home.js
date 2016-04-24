angular.module( 'app.controllers' )
    .controller( 'HomeController', [ '$scope', '$cookies', function ( $scope, $cookies ) {
            $scope.user_name = $cookies.getObject( 'user' ).user_name;
    } ] );