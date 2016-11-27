angular.module( 'app.services' )
    .service( 'Reports', [ '$resource', 'appConfig', '$q', function ( $resource, appConfig, $q ) {
         var url = appConfig.baseUrl + '/reports/:idProject';

        return $resource( appConfig.baseUrl + '/reports/:idProject', { id: '@idProject' }, {
            getProjects: {
                method: 'GET',
                isArray: true
            }
        } );

    } ] );