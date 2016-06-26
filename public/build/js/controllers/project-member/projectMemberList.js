angular.module( 'app.controllers' )
    .controller( 'ProjectMemberListController', [
        '$scope', '$routeParams', 'ProjectMember', 'User', '$timeout',
        function ( $scope, $routeParams, ProjectMember, User, $timeout ) {
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
                $scope.projectMember.user_id = item.id;
            };

            $scope.save = function () {
                if ( $scope.formMember.$valid ) {
                    $scope.projectMember.$save( { id: $routeParams.id } ).then( function ( e ) {
                        $timeout( function () {
                            $scope.showFrmMember = false;
                        }, 2000 );

                        $scope.projectMember  = new ProjectMember();
                        $scope.memberSelected = "";
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

            $scope.removeMember = function (idProject, idMember) {
                swal( {
                        title: "Remover?",
                        text: "Deseja deletar o membro do projeto?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Sim, deletar!",
                        cancelButtonText: "Ups, não...!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function ( isConfirm ) {
                        if ( isConfirm ) {
                            ProjectMember.remove( {
                                id: idProject,
                                idUser: idMember
                            }, function ( data ) {
                                console.log('data: ',data );
                                if ( data.success == "true" ) {
                                    swal( "Deletado!",data.message, "success" );
                                    $scope.loadMember();
                                } else {
                                    swal( "Ups!", data.message, "error" );
                                }
                            } );
                        } else {
                            swal( "Ups!!", "Quase faço #$%@!@ :)", "error" );
                        }
                    } );
            }
        } ] );