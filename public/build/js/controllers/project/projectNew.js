angular.module( 'app.controllers' )
    .controller( 'ProjectNewController',
    [ '$scope', '$location', 'Project',
        function ( $scope, $location, Project ) {

            $scope.project = new Project();

            $scope.save = function () {
                if ( $scope.form.$valid ) {
                    $scope.project.$save().then( function () {
                        swal( "Cadastro!", "O projeto foi cadastrada com sucesso!.", "success" );
                        $location.path( '/projects' );
                    } );
                }
            };

        } ] );