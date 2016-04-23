angular.module( 'app.controllers' )
    .controller( 'ClientNewController',
    [ '$scope', '$location', 'Client', function ( $scope, $location, Client ) {
        $scope.client = new Client();

        $scope.save = function () {
            if( $scope.form.$valid ) {
                $scope.client.$save().then( function () {
                    swal("Cadastro!", "O cliente foi cadastrado com sucesso!.", "success");
                    $location.path( '/clients' );
                } );
            }
        };

    } ] );