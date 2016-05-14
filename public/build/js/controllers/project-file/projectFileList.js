angular.module( 'app.controllers' )
    .controller( 'ProjectFileListController', [
        '$scope', '$routeParams', 'ProjectFile', 'Project',
        function ( $scope, $routeParams, ProjectFile, Project ) {

            /**
             * Função que pega os dado do projeto para mostrar algumas informações do mesmo (nome, id etc)
             * tendo ou não registros do tipo file
             */
            Project.getProjectById( { id: $routeParams.id }, function ( data ) {
                $scope.project = data;
            } );

            ProjectFile.getProjectFile( { id: $routeParams.id }, function ( data ) {
                $scope.projectFiles = data;
            } );

        } ] );