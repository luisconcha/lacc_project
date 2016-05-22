angular.module( 'app.controllers' )
    .controller( 'ProjectMemberListController', [
        '$scope', '$routeParams', 'ProjectMember', 'User', '$timeout','Client',
        function ( $scope, $routeParams, ProjectMember, User, $timeout,Client ) {

            $scope.showFrmMember = false;
            $scope.projectMember = new ProjectMember();

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
            $scope.getMembers = function ( name ) {
                return User.query( {
                    search: name,
                    searchFields: 'name:like'
                } ).$promise;
            };


            /**
             * Função que seta o cliente do projeto no input
             * @param item
             */
            $scope.selectMember = function ( item ) {
                console.log('item: ',item );
                $scope.projectMember.user_id = item.id;
            };

            $scope.save = function () {
                if ( $scope.formMember.$valid ) {
                    $scope.projectMember.$save( { id: $routeParams.id } ).then( function (e) {
                        console.info('EE: ',e );
                        $timeout( function () {
                            $scope.formMember = false;
                        }, 2000 );

                        $scope.projectMember = new ProjectMember();
                        $scope.loadMember();
                    } )
                }
            };

            /**
             *  Função para listar e reordenar a listagem dos membros
             */
            $scope.loadMember = function () {
                /**
                 * chama a lista de membros
                 */
                $scope.projectMembers = ProjectMember.query( {
                    id: $routeParams.id,
                    orderBy: 'id',
                    sortedBy: 'desc'
                } );
            };

            $scope.loadMember();



        } ] );