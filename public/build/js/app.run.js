app.run( [
    '$rootScope', '$location', '$http', '$uibModal', '$cookies', '$pusher', 'httpBuffer', 'OAuth', 'appConfig', 'Notification',
    function ( $rootScope, $location, $http, $uibModal, $cookies, $pusher, httpBuffer, OAuth, appConfig, Notification ) {

        //Função que verifica eventos do sistema para fazer determinada tarefa
        $rootScope.$on( 'pusher-build', function ( event, data ) {
            if ( data.next.$$route.originalPath != '/login' ) {
                if ( OAuth.isAuthenticated() ) {
                    if ( !window.client ) {
                        // Transformando variavel client para  global, para verificar se existe,
                        // caso contrario chama o serviço do pusher e cria o objeto
                        window.client = new Pusher( appConfig.pusherKey );
                        var pusher    = $pusher( window.client );
                        var channel   = pusher.subscribe( 'user.' + $cookies.getObject( 'user' ).user_id );
                        channel.bind( 'LACC\\Events\\TaskWasIncluded',
                            function ( data ) {
                                var name     = data.task.name;
                                var createAt = data.task.created_at;
                                Notification.success( {
                                    message: 'Tarefa: <b>' + name + '</b> foi inclida em: ' + createAt,
                                    title: 'LACC-Project',
                                    positionY: 'bottom',
                                    positionX: 'right',
                                    delay: 2000
                                } );
                            }
                        );
                    }
                }
            }
        } );

        //Função para desconectar e detruir o pusher caso o usuario estiver na pagina de login
        $rootScope.$on( 'pusher-destroy', function ( event, data ) {
            if ( data.next.$$route.originalPath == '/login' ) {
                if ( window.client ) {
                    window.client.disconnect();
                    window.client = null;
                }
            }
        } );

        //Verifica o camportamento das rotas da app
        $rootScope.$on( '$routeChangeStart', function ( event, next, current ) {
            if ( next.$$route.originalPath != '/login' ) {
                //Verifica nos cookies do angular se existe o token
                if ( !OAuth.isAuthenticated() ) {
                    $location.path( '/login' );
                }
            }

            $rootScope.$emit( 'pusher-build', { next: next } );
            $rootScope.$emit( 'pusher-destroy', { next: next } );
        } );

        //Captura a pagina atual, $$ pega variaves configuradas nas rotas
        $rootScope.$on( '$routeChangeSuccess', function ( event, current, previous ) {
            $rootScope.pageTitle = current.$$route.title;
        } );

        $rootScope.$on( 'oauth:error', function ( event, data ) {
            // Ignore `invalid_grant` error - should be catched on `LoginController`.
            if ( 'invalid_grant' === data.rejection.data.error ) {
                return;
            }

            // Refresh token when a `invalid_token` error occurs.
            if ( 'access_denied' === data.rejection.data.error ) {

                //Captura cada reqquisição de acces_denied para acressentar para o container
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