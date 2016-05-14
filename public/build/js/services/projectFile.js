angular.module( 'app.services' )
    .service( 'ProjectFile', [ '$resource', '$httpParamSerializer', 'appConfig', 'Url',
        function ( $resource, $httpParamSerializer, appConfig, Url ) {

            var url = appConfig.baseUrl + Url.getUrlResource( appConfig.urls.projectFile );
            console.log('ObjUrl: ',url );
            //http://project.dev/projects/:id/file/:idFile
            return $resource( url, { id: '@id', idFile: '@idFile' }, {

                getProjectFile: {
                    method: 'GET',
                    isArray: true
                },

                update: {
                    method: 'PUT',
                    url: '/projects/file/:idFile'
                },

                download: {
                    url: url + '/download',
                    method: 'GET'
                },

                remove: {
                    method: 'DELETE',
                    url: '/projects/file/:idFile'
                }
            } );

        } ] );