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
                url: '/projects/:id/note/:idNote',
            },

            save: {
                method: 'POST',
                url: '/projects/:id/note',
                transformRequest: function ( data ) {
                    return $httpParamSerializer( data );
                }
            },

            update: {
                method: 'PUT',
                url: '/projects/:id/note/:idNote',
                transformRequest: function ( data ) {
                    return $httpParamSerializer( data );
                }
            },
            remove: {
                method: 'DELETE',
                url: '/projects/:id/note/:idNote',
            }
        } );

    } ] );