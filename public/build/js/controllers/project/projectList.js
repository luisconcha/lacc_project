angular.module( 'app.controllers' )
    .controller( 'ProjectListController', [ '$scope', 'Project','$window', function ( $scope, Project, $window ) {

        $scope.projects        = [];
        $scope.totalProjects   = 0;
        $scope.projectsPerPage = 10;

        $scope.pagination = {
            current: 1
        };

        //Quando usuario clicar em uma páginação
        $scope.pageChanged = function ( newPage ) {
            getResultsPage( newPage );
        };

        function getResultsPage( pageNumber ) {

            Project.getProject( {
                page: pageNumber,
                limit: $scope.projectsPerPage
            }, function ( data ) {
                console.info( 'Obj: ', data );
                $scope.projects      = data.data;
                $scope.totalProjects = data.meta.pagination.total;
            } );
        }

        //Chama a função na primeira página
        getResultsPage( 1 );

        $scope.printDetailProject = function( project_id ){

            Project.getDetailPdf( { id: project_id } , function ( data ) {
                console.log('Obj: ', data);
                $window.open(data,'_blank');
                return;
            } );
        };

    } ] );