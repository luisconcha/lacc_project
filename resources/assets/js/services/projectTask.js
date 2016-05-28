angular.module( 'app.services' )
    .service( 'ProjectTask',
    [ '$resource', '$filter', 'appConfig',
        function ( $resource, $filter, appConfig ) {

            function trasformData( data ) {
                var dt = angular.copy( data );
                if ( angular.isObject( data ) ) {
                    if ( data.hasOwnProperty( 'start_date' ) ) {
                        dt.start_date = $filter( 'date' )( data.start_date, 'yyyy-MM-dd' );
                    }
                    if ( data.hasOwnProperty( 'due_date' ) ) {
                        dt.due_date = $filter( 'date' )( data.due_date, 'yyyy-MM-dd' );
                    }
                    return appConfig.utils.transformRequest( dt );
                }

                return data;
            }

            return $resource( appConfig.baseUrl + '/projects/:id/task/:idTask', {
                id: '@id',
                idTask: '@idTask'
            }, {
                get: {
                    method: 'GET',
                    transformResponse: function ( data, headers ) {
                        var o = appConfig.utils.transformResponse( data, headers );

                        if ( angular.isObject( o ) ) {
                            if ( o.hasOwnProperty( 'start_date' ) && o.start_date ) {
                                var arrDate  = o.start_date.split( '-' ),
                                    month    = parseInt( arrDate[ 1 ] ) - 1;
                                o.start_date = new Date( arrDate[ 0 ], month, arrDate[ 2 ] );
                            }
                            if ( o.hasOwnProperty( 'due_date' ) && o.due_date ) {
                                var arrDate = o.due_date.split( '-' ),
                                    month   = parseInt( arrDate[ 1 ] ) - 1;
                                o.due_date  = new Date( arrDate[ 0 ], month, arrDate[ 2 ] );
                            }
                        }
                        return o;
                    }
                },

                query: {
                    isArray: false
                },

                save: {
                    method: 'POST',
                    transformRequest: trasformData
                },

                update: {
                    method: 'PUT',
                    transformRequest: trasformData
                },

                remove: {
                    method: 'DELETE',
                    transformRequest: trasformData
                }

            } );
        } ] );