angular.module( 'app.services' )
    .service( 'ProjectNote', [ '$resource', 'appConfig', function ( $resource, appConfig ) {

        return $resource( appConfig.baseUrl + '/project/:id/notes/:idNote', { id: '@id', idNote: '@idNote' }, {
            //Este metodo é chamando na listagem, para não dar conflito com o metodo GET ao fazer a edição
            getProjectNote: {
                method: 'GET',
                isArray: false
            },
            get: {
                method: 'GET',
                url: '/project/notes/:idNote',
            },
            save: {
                method: 'POST',
                url: '/project/notes/:id',
            },
            update: {
                method: 'PUT',
                url: '/project/notes/:id/notes/:idNote',
                isArray: true
            },
            remove: {
                method: 'DELETE',
                url: '/project/notes/:id/notes/:idNote',
            }
        } );

    } ] );