angular.module( 'app.controllers' )
    .controller( 'ProjectDashboardController', [ '$scope', 'Project', function ( $scope, Project ) {

        $scope.viewAcaoModule = false;
        $scope.viewHelp       = true;
        $scope.project        = {};

        Project.get( {
            orderBy: 'created_at',
            sortedBy: 'desc',
            limit: 5
        }, function ( data ) {
            $scope.projects = data.data;
        } );

        /**
         * Seta os dados do Projeto
         */
        $scope.showProject = function ( project ) {
            console.info('project: ',project );
            $scope.project        = project;
            $scope.viewAcaoModule = true;
            $scope.viewHelp       = false;
        };

    } ] );