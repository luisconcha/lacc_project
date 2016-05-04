angular.module( 'app.controllers' )
    .controller( 'ProjectNoteEditController',
    [ '$scope', '$location', '$routeParams', 'ProjectNote',
        function ( $scope, $location, $routeParams, ProjectNote ) {

            /**
             * :id do resource (service/projectNote.js)
             * $routeParams.id da rota (app.js)
             * @type {projectNote.get}
             */
            ProjectNote.get( { id: $routeParams.id, idNote: $routeParams.idNote }, function ( data ) {
                $scope.projectNote = data.data;
            } );


            $scope.save = function () {
                if ( $scope.form.$valid ) {
                    ProjectNote.update( { 
                        id: $routeParams.id, 
                        idNote: $routeParams.idNote 
                    }, $scope.projectNote, function () {
                        swal( "Alterado!", "A nota foi alterada com sucesso!.", "success" );
                        $location.path( '/projects/' + $scope.projectNote.project_id + '/notes' );
                    } );
                }
            };
        } ] );