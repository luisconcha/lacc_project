angular.module( 'app.controllers' )
    .controller( 'ProjectNoteListController', [
        '$scope', '$routeParams', 'ProjectNote',
        function ( $scope, $routeParams, ProjectNote ) {

            ProjectNote.getProjectNote( { id: $routeParams.id }, function ( data ) {
                console.log(data);
                $scope.nameProject  = data.data[0].project_name;
                $scope.projectNotes = data.data;
            } );

        } ] );