angular.module( 'app.controllers' )
    .controller( 'ProjectListController', [ '$scope', 'Project', function ( $scope, Project ) {
        Project.getProject( {}, function ( data ) {
            $scope.projects = data;
            $scope.fecha = '1990-11-18'; //para teste, deletar depois
        } );
    } ] );