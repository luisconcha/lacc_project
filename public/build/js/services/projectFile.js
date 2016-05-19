angular.module( 'app.services' )
    .service( 'ProjectFile', [ '$resource', '$httpParamSerializer', 'appConfig', 'Url',
        function ( $resource, $httpParamSerializer, appConfig, Url ) {

            var url = appConfig.baseUrl + Url.getUrlResource( appConfig.urls.projectFile );
            //http://project.dev/projects/:id/file/:fileId
            return $resource( url, { id: '@id', fileId: '@fileId' }, {

                //Listagem dos files por projeto
                getProjectFile: {
                    method: 'GET',
                    url: url,
                    isArray: true
                },

                update: {
                    method: 'PUT',
                    url: url
                },

                download: {
                    method: 'GET',
                    url: url + '/download'
                },

                remove: {
                    method: 'DELETE',
                    url: url
                }
            } );

        } ] );