angular.module( 'app.services' )
    .service( 'ProjectNote', [ '$resource', '$httpParamSerializer', 'appConfig', function ( $resource, $httpParamSerializer, appConfig ) {

        return $resource( appConfig.baseUrl + '/projects/:id/notes/:idNote', { id: '@id', idNote: '@idNote' }, {
            //Este metodo é chamando na listagem, para não dar conflito com o metodo GET ao fazer a edição
            getProjectNote: {
                method: 'GET',
                isArray: true
            },
            get: {
                method: 'GET',
                url: '/projects/notes/:idNote',
            },
            save: {
                method: 'POST',
                url: '/projects/notes/:id',
                transformRequest: function ( data ) {
                    return $httpParamSerializer( data );
                }
            },
            update: {
                method: 'PUT',
                url: '/projects/notes/:id/notes/:idNote',
                transformRequest: function ( data ) {
                    return $httpParamSerializer( data );
                }
            },
            remove: {
                method: 'DELETE',
                url: '/projects/notes/:id/notes/:idNote',
            }
        } );

    } ] );