angular.module( 'app.controllers' )
    .controller( 'ProjectEditController',
    [ '$scope', '$location', '$cookies', '$routeParams', 'Project', 'Client', 'appConfig',
        function ( $scope, $location, $cookies, $routeParams, Project, Client, appConfig ) {

            $scope.status = appConfig.project.status;

            /**
             * Oculta o calendario ao setar a página
             * @type {{status: {opened: boolean}}}
             */
            $scope.due_date = {
                status: {
                    opened: false
                }
            };

            /**
             * habilita o calendario ao clicar no btn data
             * @param event
             */
            $scope.open = function ( event ) {
                $scope.due_date.status.opened = true
            };

            /**
             * Função que retorna o objeto a ser editado
             * :id do resource (service/project.js)
             * $routeParams.id da rota (app.js)
             * @type {Project.get}
             */
            Project.get( { id: $routeParams.id }, function ( data ) {
                $scope.project = data;

                //Obtem o client do projeto
                Client.get( { id: data.client_id }, function ( data ) {
                    $scope.clientSelected = data;
                } );
            } );

            /**
             * Função que retorna o NOME do campo Clients do autocomplete para mostrar na label e não seu ID
             * @param id
             * @returns {*}
             */
            $scope.formatName = function ( model ) {
                if ( model ) {
                    return model.name;
                }
                return '';
            };

            /**
             * Função que retorna o valor da pesquisa por clients
             * @param name
             * @returns {*}
             */
            $scope.getClients = function ( name ) {
                return Client.query( {
                    search: name,
                    searchFields: 'name:like'
                } ).$promise;
            };

            /**
             * Função que seta o cliente do projeto no input
             * @param item
             */
            $scope.selectClient = function ( item ) {
                $scope.project.client_id = item.id;
            };

            $scope.save = function () {
                if ( $scope.form.$valid ) {
                    $scope.project.owner_id = $cookies.getObject( 'user' ).user_id;
                    Project.update( { id: $scope.project.project_id }, $scope.project, function ( data ) {
                        swal( "Alterado!", "O projeto foi alterado com sucesso!.", "success" );
                        $location.path( '/projects' );
                    } );
                }
            };
        } ] );