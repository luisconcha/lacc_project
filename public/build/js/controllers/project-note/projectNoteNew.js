angular.module( 'app.controllers' )
    .controller( 'ProjectNoteNewController',
    [ '$scope', '$location', '$routeParams', 'ProjectNote',
        function ( $scope, $location, $routeParams, ProjectNote ) {

            $scope.projectNote            = new ProjectNote();
            $scope.projectNote.project_id = $routeParams.id;

            $scope.save = function () {
                if ( $scope.form.$valid ) {
                    $scope.projectNote.$save( { id: $routeParams.id } ).then( function () {
                        swal( "Cadastro!", "A nota para o projeto foi cadastrada com sucesso!.", "success" );
                        $location.path( '/project/' + $routeParams.id + '/notes' );
                    } );
                }
            };

        } ] );