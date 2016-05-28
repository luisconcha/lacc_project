angular.module( 'app.controllers' )
    .controller( 'ProjectNoteListController', [
        '$scope', '$routeParams', 'ProjectNote',
        function ( $scope, $routeParams, ProjectNote ) {
            $scope.projectId            = $routeParams.id;
            $scope.projectNotes         = [];
            $scope.totalProjectsNotes   = 0;
            $scope.projectsNotesPerPage = 10;

            $scope.pagination = {
                current: 1
            };

            //Quando usuario clicar em uma páginação
            $scope.pageChanged = function ( newPage ) {
                getResultsPage( newPage );
            };

            function getResultsPage( pageNumber ) {

                ProjectNote.getProjectNote( {
                    id: $routeParams.id,
                    page: pageNumber,
                    limit: $scope.projectsNotesPerPage
                }, function ( data ) {
                    $scope.projectNotes       = data.data;
                    $scope.totalProjectsNotes = data.meta.pagination.total;

                    if ( data.data.length > 0 ) {
                        $scope.nameProject  = data.data[ 0 ].project_name;
                        $scope.projectNotes = data.data;
                    }
                } );
            }

            //Chama a função na primeira página
            getResultsPage( 1 );
        } ] );