angular.module( 'app.controllers' )
    .controller( 'ProjectNoteListController', [
        '$scope', '$routeParams', 'ProjectNote',
        function ( $scope, $routeParams, ProjectNote ) {
            console.log('Obj: ',$routeParams );
            ProjectNote.getProjectNote( { id: $routeParams.id }, function ( data ) {
                console.log('Obj: ',data );
                if( data.length > 0 ){
                    $scope.nameProject  = data[0].project_name;
                    $scope.projectNotes = data;
                }

            } );

        } ] );