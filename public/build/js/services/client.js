angular.module( 'app.services' )
    .service( 'Client', [ '$resource', '$httpParamSerializer', 'appConfig', function ( $resource, $httpParamSerializer, appConfig ) {
        return $resource( appConfig.baseUrl + '/clients/:id', { id: '@id' }, {
            update: {
                method: 'PUT',
                transformRequest: function ( data ) {
                    return $httpParamSerializer( data );
                }
            },
            save: {
                method: 'POST',
                url: '/clients',
                transformRequest: function ( data ) {
                    return $httpParamSerializer( data );
                }
            },
            remove: {
                method: 'DELETE'
            }
        } );
    } ] );