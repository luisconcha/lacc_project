angular.module( 'app.controllers' )
    .controller( 'ProjectFileRemoveController',
    [ '$scope', '$location', '$routeParams', 'ProjectFile',
        function ( $scope, $location, $routeParams, ProjectFile ) {
            /**
             * :id do resource (service/projectFile.js)
             * $routeParams.id da rota (app.js)
             * @type {ProjectFile.get}
             */
            ProjectFile.get( { id: $routeParams.id, fileId: $routeParams.fileId }, function ( data ) {
                $scope.projectFile = data;
            } );

            $scope.remove = function () {
                swal( {
                        title: "Remover?",
                        text: "Deseja deletar a o arquivo '" + $scope.projectFile.name + "' do projeto: \n '" + $scope.projectFile.project_name + "'",
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
                            ProjectFile.remove( {
                                id: $routeParams.id,
                                fileId: $routeParams.fileId
                            }, $scope.projectFile, function ( data ) {

                                if ( data ) {
                                    $location.path( '/projects/' + $scope.projectFile.project_id + '/files' );
                                    swal( "Deletado!", 'Documento: ' + data.name + ' foi deletado com sucesso!', "success" );
                                } else {
                                    swal( "Ups!", data.message, "error" );
                                }
                            } );
                        } else {
                            swal( "Ups!!", "Quase faço #$%@!@ :)", "error" );
                        }
                    } );

            };

        } ] );