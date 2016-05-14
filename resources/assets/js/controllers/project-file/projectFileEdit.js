angular.module( 'app.controllers' )
    .controller( 'ProjectFileEditController',
    [ '$scope', '$location', '$routeParams', 'ProjectFile',
        function ( $scope, $location, $routeParams, ProjectFile ) {

            /**
             * :id do resource (service/projectFile.js)
             * $routeParams.id da rota (app.js)
             * @type {projectFile.get}
             */
            ProjectFile.get( { id: null, idFile: $routeParams.idFile }, function ( data ) {
                $scope.projectFile = data;
            } );

            $scope.save = function () {
                if ( $scope.form.$valid ) {
                    ProjectFile.update( {
                        id: null,
                        idFile: $routeParams.idFile
                    }, $scope.projectFile, function ( data ) {
                        console.log( 'Obj: ', data );

                        if ( !data.error ) {
                            swal( "Alterado!", "A arquivo foi alterado com sucesso!.", "success" );
                            $location.path( '/projects/' + $scope.projectFile.project_id + '/files' );
                        }else{
                            swal( "Ups!", "Houve um erro: " + data.error, "error" );
                        }
                    } );
                }
            };
        } ] );