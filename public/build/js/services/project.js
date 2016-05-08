angular.module( 'app.services' )
    .service( 'Project',
    [ '$resource', '$filter', '$httpParamSerializer', 'appConfig',
        function ( $resource, $filter, $httpParamSerializer, appConfig ) {

            //Faz um parse na data para o formatdo do BD
            function trasformData( data ) {
                if ( angular.isObject( data ) && data.hasOwnProperty( 'due_date' ) ) {
                    data.due_date = $filter( 'date' )( data.due_date, 'yyyy-MM-dd' );
                    return $httpParamSerializer( data );
                }
                console.log( 'Fil: ', data.due_date );
                return data;
            }

            return $resource( appConfig.baseUrl + '/projects/:id', { id: '@id' }, {
                get: {
                    method: 'GET',
                    transformResponse: function ( data, headers ) {
                        var o = appConfig.utils.transformResponse( data, headers );
                        //Esta transformação da data é por que se esta utilizando html5 e campo do tipo date
                        if ( angular.isObject( o ) && o.hasOwnProperty( 'due_date' ) ) {
                            var arrDate = o.due_date.split( '-' );
                            o.due_date  = new Date( arrDate[ 0 ], arrDate[ 1 ], arrDate[ 2 ] );

                        }
                        return o;
                    }
                },

                //Este metodo é chamando na listagem, para não dar conflito com o metodo GET ao fazer a edição
                getProject: {
                    method: 'GET',
                    url: '/projects'
                },

                save: {
                    method: 'POST',
                    url: '/projects',
                    transformRequest: trasformData
                },

                update: {
                    method: 'PUT',
                    url: '/projects/:id',
                    //transformRequest: trasformData
                    transformRequest: function ( data ) {
                        var d         = new Date( data.due_date );
                        data.due_date = new Date( data.due_date );
                        return $httpParamSerializer( data );
                    }
                },

                remove: {
                    method: 'DELETE',
                    url: '/projects/:id'
                }

            } );
        } ] );