angular.module( 'app.controllers' )
    .controller( 'ClientListController', [ '$scope', 'Client', function ( $scope, Client ) {

        $scope.clients        = [];
        $scope.totalClients   = 0;
        $scope.clientsPerPage = 10;

        $scope.pagination = {
            current: 1
        };

        //Quando usuario clicar em uma páginação
        $scope.pageChanged = function ( newPage ) {
            getResultsPage( newPage );
        };

        function getResultsPage( pageNumber ) {

            Client.getClient( {
                page: pageNumber,
                limit: $scope.clientsPerPage
            }, function ( data ) {
                $scope.clients      = data.data;
                $scope.totalClients = data.meta.pagination.total;
            } );
        }

        //Chama a função na primeira página
        getResultsPage( 1 );

        //Client.getClient( {}, function ( data ) {
        //    $scope.clients = data;
        //} );
    } ] );