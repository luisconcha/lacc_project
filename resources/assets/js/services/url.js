angular.module( 'app.services' )
    .service( 'Url', [ '$interpolate', function ( $interpolate ) {
        return {

            getUrlFromUrlSymbol: function ( url, params ) {

                //Exemplo de URL: projects/{{id}}/file/{{idFile}}
                //.replace( /\/\//g, '/' ) --> troca as // em toda a string passada por /
                //.replace( /\/$/, '' ) --> Verifica na ultma barra da expression
                var urlMod = $interpolate( url )( params );

                return urlMod.replace( /\/\//g, '/' )
                    .replace( /\/$/, '' );
            },
            getUrlResource: function ( url ) {

                //DE:   /projects/{{id}}/file/{{idFile}}
                //PARA: /projects/:id/file/:idFile
                return url.replace( new RegExp( '{{', 'g' ), ':' )
                    .replace( new RegExp( '}}', 'g' ), '' )
            }
        };
    } ] );