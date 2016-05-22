angular.module( 'app.services' )
    .service( 'ProjectMember',
    [ '$resource', '$filter', 'appConfig', '$httpParamSerializer',
        function ( $resource, $filter, appConfig, $httpParamSerializer ) {

            return $resource( appConfig.baseUrl + '/projects/:id/member/:idUser', {
                id: '@id',
                idUser: '@idUser'
            }, {

                save: {
                    method: 'POST',
                    url: '/projects/:id/member',
                    transformRequest: function ( data ) {
                        return $httpParamSerializer( data );
                    }
                },

                update: {
                    method: 'PUT'
                },

                remove: {
                    method: 'DELETE'
                }

            } );
        } ] );