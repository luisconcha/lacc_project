/**
 * Diretiva que carrega modulos após usuário estiver autenticado
 * Exemplo: modulo de menu, rodape, siderbar etc
 * <load-template url="build/views/templates/template-para-ser-carregado.html"></load-template>
 */
angular.module( 'app.directives' )
    .directive( 'loadTemplate',
    [ 'OAuth', '$http', '$compile', function ( OAuth, $http, $compile ) {

        return {
            restrict: 'E',
            link: function ( $scope, element, attr ) {

                /**
                 * Evento que verifica mudanças de rota
                 */
                $scope.$on( '$routeChangeStart', function ( event, next, current ) {
                    //Verifica se esta autenticado
                    if ( OAuth.isAuthenticated() ) {
                        //E se for diferente de login e logout
                        if ( next.$$route.originalPath != '/login' && next.$$route.originalPath != '/logout' ) {

                            if ( !$scope.isTemplateLoad ) {
                                $scope.isTemplateLoad = true;
                                //Carrego o template e atribui o elmento html
                                $http.get( attr.url ).then( function ( response ) {
                                    element.html( response.data );

                                    //Como os elementos html teram Controllers, scope etc precisamos compilar
                                    $compile( element.contents() )( $scope );
                                } );
                            }
                            return;
                        }
                    }

                    resetTemplate();

                    function resetTemplate() {
                        $scope.isTemplateLoad = false;
                        element.html( "" );
                    }
                } );
            }
        };
    } ] );