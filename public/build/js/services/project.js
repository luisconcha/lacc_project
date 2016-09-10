angular.module( 'app.services' )
    .service( 'Project',
    [ '$resource', '$filter', '$httpParamSerializer', 'appConfig',
        function ( $resource, $filter, $httpParamSerializer, appConfig ) {

            //Faz um parse na data para o formatdo do BD
            function trasformData( data ) {
                if ( angular.isObject( data ) && data.hasOwnProperty( 'due_date' ) ) {
                    //Fazemos a cópia do objeto para não dar erro na data
                    var dataCopy      = angular.copy( data );
                    dataCopy.due_date = $filter( 'date' )( data.due_date, 'yyyy-MM-dd' );
                    return appConfig.utils.transformRequest( dataCopy );
                }
                return data;
            }

            return $resource( appConfig.baseUrl + '/projects/:id', { id: '@id' }, {
                get: {
                    method: 'GET',
                    transformResponse: function ( data, headers ) {
                        var o = appConfig.utils.transformResponse( data, headers );
                        //Esta transformação da data é por que se esta utilizando html5 e campo do tipo date
                        if ( angular.isObject( o ) && o.hasOwnProperty( 'due_date' ) ) {
                            var arrDate = o.due_date.split( '-' ),
                                month   = parseInt( arrDate[ 1 ] ) - 1;
                            o.due_date  = new Date( arrDate[ 0 ], month, arrDate[ 2 ] );

                        }
                        return o;
                    }
                },

                //Este metodo é chamando na listagem, para não dar conflito com o metodo GET ao fazer a edição
                getProject: {
                    method: 'GET',
                    url: '/projects',
                    isArray: false
                },

                getProjectById:{
                    method: 'GET',
                    url: '/projects/:id'
                },

                getDetailPdf:{
                    method: 'GET',
                    url: '/projects/:id/detail-pdf',
                    transformRequest: trasformData
                },

                save: {
                    method: 'POST',
                    url: '/projects',
                    transformRequest: trasformData
                },

                update: {
                    method: 'PUT',
                    url: '/projects/:id',
                    transformRequest: trasformData
                },

                remove: {
                    method: 'DELETE',
                    url: '/projects/:id'
                }

            } );
        } ] );