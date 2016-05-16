angular.module( 'app.services' )
    .service( 'ProjectFile', [ '$resource', '$httpParamSerializer', 'appConfig', 'Url',
        function ( $resource, $httpParamSerializer, appConfig, Url ) {

            var url = appConfig.baseUrl + Url.getUrlResource( appConfig.urls.projectFile );
            console.log('ObjUrl: ',url );
            //http://project.dev/projects/:id/file/:fileId
            return $resource( url, { id: '@id', fileId: '@fileId' }, {

                //Listagem dos files por projeto
                getProjectFile: {
                    method: 'GET',
                    url: '/projects/:id/file',
                    isArray: true
                },

                update: {
                    method: 'PUT',
                    url: '/projects/:id/file/:fileId'
                },

                download: {
                    url: url + '/download',
                    //url: '/projects/:id/file/:fileId/download',
                    method: 'GET'
                },

                remove: {
                    method: 'DELETE',
                    url: '/projects/:id/file/:fileId'
                }
            } );

        } ] );