var app = angular.module( 'app',
    [
        'ngRoute', 'angular-oauth2', 'app.controllers', 'app.services', 'app.filters', 'app.directives',
        'ui.bootstrap.typeahead', 'ui.bootstrap.datepicker', 'ui.bootstrap.tpls', 'ui.bootstrap.modal',
        'ngFileUpload', 'http-auth-interceptor', 'angularUtils.directives.dirPagination',
        'mgcrea.ngStrap.navbar', 'ui.bootstrap.dropdown'
    ] );

angular.module( 'app.controllers', [ 'ngMessages', 'ngAnimate' ] );
angular.module( 'app.filters', [] );
angular.module( 'app.directives', [] );

/**
 * Modulo para serviços RestFull
 */
angular.module( 'app.services', [ 'ngResource' ] );

/**
 * Serviço que fornece a URL do projeto
 */
app.provider( 'appConfig', [ '$httpParamSerializerProvider', function ( $httpParamSerializerProvider ) {
    var config = {
        baseUrl: 'http://project.dev',
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

app.config( [
    '$routeProvider', '$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider',
    function ( $routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider ) {

        $httpProvider.defaults.headers.post[ 'Content-Type' ] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.put[ 'Content-Type' ]  = 'application/x-www-form-urlencoded;charset=utf-8';

        $httpProvider.defaults.transformRequest  = appConfigProvider.config.utils.transformRequest;
        $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;
        //Removendo os interceptors para ficar só com: oauthFixInterceptor
        $httpProvider.interceptors.splice( 0, 1 );
        $httpProvider.interceptors.splice( 0, 1 );
        $httpProvider.interceptors.push( 'oauthFixInterceptor' );

        $routeProvider
        /********* Rota Login *********/
            .when( '/login', {
                templateUrl: 'build/views/login.html',
                controller: 'LoginController'
            } )
        /********* Rota Logout *********/
            .when( '/logout', {
                resolve: {
                    logout: [ '$location', 'OAuthToken', function ( $location, OAuthToken ) {
                        OAuthToken.removeToken();
                        return $location.path( '/login' );
                    } ]
                }
            } )
        /********* Rota Home *********/
            .when( '/home', {
                templateUrl: 'build/views/home.html',
                controller: 'HomeController'
            } )

        /********* Rota Clients *********/
            .when( '/clients', {
                templateUrl: 'build/views/client/list.html',
                controller: 'ClientListController'
            } )
            .when( '/clients/new', {
                templateUrl: 'build/views/client/new.html',
                controller: 'ClientNewController'
            } )
            .when( '/clients/:id/show', {
                templateUrl: 'build/views/client/show.html',
                controller: 'ClientShowController'
            } )
            .when( '/clients/:id/edit', {
                templateUrl: 'build/views/client/edit.html',
                controller: 'ClientEditController'
            } )
            .when( '/clients/:id/remove', {
                templateUrl: 'build/views/client/remove.html',
                controller: 'ClientRemoveController'
            } )

        /********* Rota Projects *********/
            .when( '/projects', {
                templateUrl: 'build/views/project/list.html',
                controller: 'ProjectListController'
            } )
            .when( '/projects/new', {
                templateUrl: 'build/views/project/new.html',
                controller: 'ProjectNewController'
            } )
            .when( '/projects/:id/edit', {
                templateUrl: 'build/views/project/edit.html',
                controller: 'ProjectEditController'
            } )
            .when( '/projects/:id/remove', {
                templateUrl: 'build/views/project/remove.html',
                controller: 'ProjectRemoveController'
            } )

        /********* Rota Projects Notes *********/
            .when( '/projects/:id/notes', {
                templateUrl: 'build/views/project-note/list.html',
                controller: 'ProjectNoteListController'
            } )
            .when( '/project/:id/notes/new', {
                templateUrl: 'build/views/project-note/new.html',
                controller: 'ProjectNoteNewController'
            } )
            .when( '/project/:id/notes/:idNote/show', {
                templateUrl: 'build/views/project-note/show.html',
                controller: 'ProjectNoteShowController'
            } )
            .when( '/project/:id/notes/:idNote/edit', {
                templateUrl: 'build/views/project-note/edit.html',
                controller: 'ProjectNoteEditController'
            } )
            .when( '/project/:id/notes/:idNote/remove', {
                templateUrl: 'build/views/project-note/remove.html',
                controller: 'ProjectNoteRemoveController'
            } )

        /********* Rota Projects Tasks *********/
            .when( '/project/:id/tasks', {
                templateUrl: 'build/views/project-task/list.html',
                controller: 'ProjectTaskListController'
            } )
            .when( '/project/:id/task/new', {
                templateUrl: 'build/views/project-task/new.html',
                controller: 'ProjectTaskNewController'
            } )
            .when( '/project/:id/task/:idTask/edit', {
                templateUrl: 'build/views/project-task/edit.html',
                controller: 'ProjectTaskEditController'
            } )
            .when( '/project/:id/task/:idTask/remove', {
                templateUrl: 'build/views/project-task/remove.html',
                controller: 'ProjectTaskRemoveController'
            } )

        /********* Rota Projects Members *********/
            .when( '/project/:id/members', {
                templateUrl: 'build/views/project-member/list.html',
                controller: 'ProjectMemberListController'
            } )
            .when( '/project/:id/member/:idProjectMmeber/remove', {
                templateUrl: 'build/views/project-member/list.html',
                controller: 'ProjectMemberListController'
            } )

        /********* Rota Projects File *********/
            .when( '/projects/:id/files', {
                templateUrl: 'build/views/project-file/list.html',
                controller: 'ProjectFileListController'
            } )
            .when( '/projects/:id/files/new', {
                templateUrl: 'build/views/project-file/new.html',
                controller: 'ProjectFileNewController'
            } )
            .when( '/projects/:id/files/:fileId/edit', {
                templateUrl: 'build/views/project-file/edit.html',
                controller: 'ProjectFileEditController'
            } )
            .when( '/projects/:id/files/:fileId/remove', {
                templateUrl: 'build/views/project-file/remove.html',
                controller: 'ProjectFileRemoveController'
            } );

        OAuthProvider.configure( {
            baseUrl: appConfigProvider.config.baseUrl,
            clientId: 'appid1',
            clientSecret: 'secret',
            grantPath: 'oauth/access_token'
        } );

        /**
         * Remover este trecho de código quando for para produção
         * Caso o server não tiver https
         */
        OAuthTokenProvider.configure( {
            name: 'token',
            options: {
                secure: false //caso o servidor estiver com https trocar para TRUE
            }
        } );
    } ] );

app.run( [ '$rootScope', '$location', '$http', '$uibModal', 'httpBuffer', 'OAuth',
    function ( $rootScope, $location, $http, $uibModal, httpBuffer, OAuth ) {

        //Verifica o camportamento das rotas da app
        $rootScope.$on( '$routeChangeStart', function ( event, next, current ) {
            if ( next.$$route.originalPath != '/login' ) {
                //Verifica nos cookies do angular se existe o token
                if ( !OAuth.isAuthenticated() ) {
                    $location.path( '/login' );
                }
            }
        } );

        $rootScope.$on( 'oauth:error', function ( event, data ) {
            // Ignore `invalid_grant` error - should be catched on `LoginController`.
            if ( 'invalid_grant' === data.rejection.data.error ) {
                return;
            }

            // Refresh token when a `invalid_token` error occurs.
            if ( 'access_denied' === data.rejection.data.error ) {

                //Captura cadas reqquisição de acces_denied para acressentar para o cantainer
                //do httpBuffer da biblioteca angular-http-auth
                httpBuffer.append( data.rejection.config, data.deferred );

                if ( !$rootScope.loginModalOpened ) {
                    var modalInstance = $uibModal.open( {
                        templateUrl: 'build/views/templates/loginModal.html',
                        controller: 'LoginModalController'
                    } );

                    $rootScope.loginModalOpened = true;
                }
                return;
            }

            return $location.path( 'login' );
        } );
    } ] );