angular.module( 'app.services' )
    .service( 'Project', [ '$resource', 'appConfig', function ( $resource, appConfig ) {
        return $resource( appConfig.baseUrl + 'projects/:id', { id: '@id' }, {
            //Este metodo é chamando na listagem, para não dar conflito com o metodo GET ao fazer a edição
            getProject: {
                method: 'GET',
                url: '/projects'
            }

        } );
    } ] );