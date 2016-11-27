var app = angular.module( 'app',
    [
        'ngRoute', 'angular-oauth2', 'app.controllers', 'app.services', 'app.filters', 'app.directives',
        'ui.bootstrap.typeahead', 'ui.bootstrap.datepicker', 'ui.bootstrap.tpls', 'ui.bootstrap.modal',
        'ngFileUpload', 'http-auth-interceptor', 'angularUtils.directives.dirPagination',
        'ui.bootstrap.dropdown', 'pusher-angular', 'ui-notification', 'ngAnimate', 'highcharts-ng'
    ] );

angular.module( 'app.controllers', [ 'ngMessages' ] );
angular.module( 'app.filters', [] );
angular.module( 'app.directives', [] );

/**
 * Modulo para serviços RestFull
 */
angular.module( 'app.services', [ 'ngResource' ] );

/**
 * Modulo de configuração para routes, providers etc
 */
angular.module( 'app.config', [] );

/**
 * Modulo de inicialização
 */
angular.module( 'app.run', [] );

/**
 * Serviço que fornece a URL do projeto
 */
app.provider( 'appConfig', [ '$httpParamSerializerProvider', function ( $httpParamSerializerProvider ) {
    var config = {
        baseUrl: 'http://project.dev',
        pusherKey: '50e50f0a2a81ad152d35',
        project: {
            status: [
                { value: '0', label: 'Não iniciado' },
                { value: '1', label: 'Iniciado' },
                { value: '2', label: 'Finalizado' },
                { value: '3', label: 'Cancelado' }
            ]
        },
        projectTask: {
            status: [
                { value: '0', label: 'Incompleta' },
                { value: '1', label: 'Completa' }
            ]
        },
        urls: {
            projectFile: '/projects/{{id}}/file/{{fileId}}'
        },
        utils: {
            //Funções Globals que poderam ser acessíveis tanto configprovideros, serviços, controller
            transformResponse: function ( data, headers ) {
                $( '#load-div' ).hide();
                var headersGetter = headers();
                if ( headersGetter[ 'content-type' ] == 'application/json' ||
                    headersGetter[ 'content-type' ] == 'text/json' ) {

                    var dataJson = JSON.parse( data );
                    if ( dataJson.hasOwnProperty( 'data' ) && Object.keys( dataJson ).length == 1 ) {
                        dataJson = dataJson.data;
                    }
                    return dataJson;
                }

                return data;
            },
            transformRequest: function ( data ) {
                $( '#load-div' ).show();
                if ( angular.isObject( data ) ) {
                    return $httpParamSerializerProvider.$get()( data );
                }
                return data;
            }
        }
    };

    return {
        config: config,
        $get: function () {
            return config;
        }
    }
} ] );