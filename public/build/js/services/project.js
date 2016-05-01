angular.module( 'app.services' )
    .service( 'Project',
    [ '$resource', '$filter', '$httpParamSerializer', 'appConfig',
        function ( $resource, $filter, $httpParamSerializer, appConfig ) {
        return $resource( appConfig.baseUrl + 'projects/:id', { id: '@id' }, {
            //Este metodo é chamando na listagem, para não dar conflito com o metodo GET ao fazer a edição
            getProject: {
                method: 'GET',
                url: '/projects'
            },
            save: {
                method: 'POST',
                url: '/project',
                transformRequest: function ( data ) {
                    console.log( 'Dados', data );
                    if ( angular.isObject( data ) && data.hasOwnProperty( 'due_date' ) ) {
                        data.due_date = $filter( 'date' )( data.due_date, 'yyyy-MM-dd' );
                        console.log( 'Dara serializada: ', data.due_date );
                        return $httpParamSerializer( data );
                    }
                    return data;
                }
            }

        } );
    } ] );