angular.module( 'app.controllers' )
    .controller( 'ProjectNoteRemoveController',
    [ '$scope', '$location', '$routeParams', 'ProjectNote',
        function ( $scope, $location, $routeParams, ProjectNote ) {
            /**
             * :id do resource (service/projectNote.js)
             * $routeParams.id da rota (app.js)
             * @type {ProjectNote.get}
             */
            ProjectNote.get( { id: $routeParams.id, idNote: $routeParams.idNote }, function ( data ) {
                $scope.projectNote = data.data;
            } );

            $scope.remove = function () {
                swal( {
                        title: "Remover?",
                        text: "Deseja deletar a nota do projeto? \n '"+ $scope.projectNote.title + "'",
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
                            ProjectNote.remove( {
                                id: $routeParams.id,
                                idNote: $scope.projectNote.id
                            }, $scope.projectNote, function () {
                                $location.path( '/projects/' + $scope.projectNote.project_id + '/notes' );
                            } );
                            swal( "Deletado!", "A nota foi deletada com sucesso!.", "success" );
                        } else {
                            swal( "Ups!!", "Quase faço #$%@!@ :)", "error" );
                        }
                    } );

            };

        } ] );