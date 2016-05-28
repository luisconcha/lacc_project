angular.module( 'app.controllers' )
    .controller( 'LoginModalController',
    [ '$rootScope', '$scope', '$location', '$cookies', '$uibModalInstance', 'authService', 'User', 'OAuth', 'OAuthToken',
        function ( $rootScope, $scope, $location, $cookies, $uibModalInstance, authService, User, OAuth, OAuthToken ) {
            $scope.user = {
                username: '',
                password: ''
            };

            $scope.error = {
                message: '',
                error: false
            };

            /**
             * Fecha o modal
             * @see: event:auth-loginConfirmed da função loginConfirmed da biblioteca angular-http-auth
             */
            $scope.$on( 'event:auth-loginConfirmed', function () {
                $rootScope.loginModalOpened = false;
                $uibModalInstance.close();
            } );

            /**
             * outra forma de fechar o modal,
             */
            $scope.$on( '$routeChangeStart', function () {
                $rootScope.loginModalOpened = false;
                $uibModalInstance.dismiss( 'cancel' );
            } );

            /**
             * Quando clicar no btn cancelar do modal remove todos os tokens
             */
            $scope.$on( 'event:auth-loginCancelled', function () {
                OAuthToken.removeToken();
            } );

            $scope.login = function () {
                if ( $scope.form.$valid ) {
                    OAuth.getAccessToken( $scope.user ).then( function () {

                        User.authenticated( {}, {}, function ( data ) {
                            $cookies.putObject( 'user', data );
                            //chama a função da biblioteca angular-http-auth
                            authService.loginConfirmed();
                        } );

                    }, function ( data ) {
                        $scope.error.error   = true;
                        $scope.error.message = data.data.error_description
                    } );
                }
            };

            /**
             * Cancela todas as requisições
             *  @see: loginCancelled função da biblioteca angular-http-auth
             */
            $scope.cancel = function () {
                authService.loginCancelled();
                $location.path( 'login' );
            };
        } ] );