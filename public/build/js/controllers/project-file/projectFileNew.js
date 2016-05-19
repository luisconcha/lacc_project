angular.module( 'app.controllers' )
    .controller( 'ProjectFileNewController',
    [ '$scope', '$location', '$routeParams', 'appConfig', 'Url', 'Upload', 'Project',
        function ( $scope, $location, $routeParams, appConfig, Url, Upload, Project ) {

            Project.getProjectById( { id: $routeParams.id, fileId: null }, function ( data ) {
                $scope.project = data;
            } );

            $scope.save = function () {
                if ( $scope.form.$valid ) {

                    var url = appConfig.baseUrl + Url.getUrlFromUrlSymbol( appConfig.urls.projectFile, {
                            id: $routeParams.id,
                            fileId: ''
                        } );

                    Upload.upload( {
                        url: url,
                        data: {
                            name: $scope.projectFile.name,
                            description: $scope.projectFile.description,
                            file: $scope.projectFile.file,
                            project_id: $routeParams.id
                        }
                    } ).then( function ( resp ) {
                        swal( "Cadastro!", "O Arquivo "+resp.config.data.file.name+" foi cadastrado com sucesso!.", "success" );
                        $location.path( '/projects/' + $routeParams.id + '/files' );
                    }, function ( resp ) {
                        swal( "Ups!", "Error: "+resp.status+ ".", "error" );
                    }, function ( evt ) {
                        var progressPercentage = parseInt( 100.0 * evt.loaded / evt.total );
                        $scope.progressFile = progressPercentage;
                        console.log( 'progress: ' + progressPercentage + '% ' + evt.config.data.file.name );
                    } );
                }
            };

        } ] );