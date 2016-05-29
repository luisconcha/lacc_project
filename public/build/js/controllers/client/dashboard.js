angular.module( 'app.controllers' )
    .controller( 'ClientDashboardController', [ '$scope', 'Client', function ( $scope, Client ) {

        $scope.viewAcaoModule = false;
        $scope.viewHelp       = true
        ;
        $scope.client         = {};

        Client.getClient( {
            orderBy: 'created_at',
            sortedBy: 'desc',
            limit: 8
        }, function ( data ) {
            $scope.clients = data.data;
        } );

        /**
         * Seta os dados do cliente
         */
        $scope.showClient = function ( client ) {
            $scope.client         = client;
            $scope.viewAcaoModule = true;
            $scope.viewHelp       = false;
        };

    } ] );