angular.module( 'app.controllers' )
    .controller( 'ProjectNoteListController', [
        '$scope', '$routeParams', 'ProjectNote',
        function ( $scope, $routeParams, ProjectNote ) {


            ProjectNote.getProjectNote( { id: $routeParams.id }, function ( data ) {

                $scope.projectId = $routeParams.id;
                
                if( data.length > 0 ){
                    $scope.nameProject  = data[0].project_name;
                    $scope.projectNotes = data;
                }

            } );

        } ] );