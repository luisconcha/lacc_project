angular.module( 'app.controllers' )
    .controller( 'ProjectEditController',
    [ '$scope', '$location', '$cookies', '$routeParams', 'Project', 'Client', 'appConfig',
        function ( $scope, $location, $cookies, $routeParams, Project, Client, appConfig ) {

            $scope.status = appConfig.project.status;

            Client.getClient( {}, function ( data ) {
                $scope.clients = data.data;
            } );

            /**
             * :id do resource (service/project.js)
             * $routeParams.id da rota (app.js)
             * @type {Project.get}
             */
            Project.get( { id: $routeParams.id }, function ( data ) {
                $scope.project = data;
            } );

            $scope.save = function () {
                if ( $scope.form.$valid ) {
                    $scope.project.owner_id = $cookies.getObject( 'user' ).user_id;
                    Project.update( { id: $scope.project.project_id }, $scope.project, function ( data ) {
                        console.log('RES', data);
                        swal( "Alterado!", "O projeto foi alterado com sucesso!.", "success" );
                        $location.path( '/projects' );
                    } );
                }
            };
        } ] );