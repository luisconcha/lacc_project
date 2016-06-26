angular.module( 'app.controllers' )
    .controller( 'ProjectNewController',
    [ '$scope', '$location', '$cookies', '$q', '$filter', 'Project', 'Client', 'appConfig',
        function ( $scope, $location, $cookies, $q, $filter, Project, Client, appConfig ) {

            $scope.project = new Project();
            $scope.status  = appConfig.project.status;

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
                var deffered = $q.defer();
                Client.query( {
                    search: name,
                    searchFields: 'name:like'
                }, function ( data ) {
                    var result = $filter( 'limitTo' )( data.data, 10 );
                    deffered.resolve( result );
                }, function ( error ) {
                    deffered.reject( error );
                } );
                return deffered.promise;
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

                    $scope.project.$save().then( function () {
                        swal( "Cadastro!", "O projeto foi cadastrada com sucesso!.", "success" );
                        $location.path( '/projects' );
                    } );
                }
            };

        } ] );