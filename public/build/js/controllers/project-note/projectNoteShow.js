angular.module( 'app.controllers' )
    .controller( 'ProjectNoteShowController',
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

        } ] );