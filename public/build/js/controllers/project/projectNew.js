angular.module( 'app.controllers' )
    .controller( 'ProjectNewController',
    [ '$scope', '$location', '$cookies', 'Project', 'Client', 'appConfig',
        function ( $scope, $location, $cookies, Project, Client, appConfig ) {

            $scope.project = new Project();
            $scope.status  = appConfig.project.status;

            Client.get( {}, function ( data ) {
                console.log('CLI:', data.data);
                $scope.clients = data.data;
            } );


            $scope.save = function () {
                if ( $scope.form.$valid ) {

                    $scope.project.owner_id = $cookies.getObject( 'user' ).user_id;

                    $scope.project.$save().then( function () {
                        swal( "Cadastro!", "O projeto foi cadastrada com sucesso!.", "success" );
                        $location.path( '/projects' );
                    } );
                }
            };

        } ] );