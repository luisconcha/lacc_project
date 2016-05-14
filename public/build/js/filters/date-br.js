angular.module( 'app.filters' )
    .filter( 'dataBr', [ '$filter', function ( $filter ) {
        return function ( input ) {
            return $filter( 'date' )( input, 'dd/MM/yyyy' );
        };
    } ] )

    .filter( 'dataBrExtend', [ '$filter', function ( $filter ) {
        return function ( input ) {
            var dateFormatted = input.replace( /(.+) (.+)/, "$1T$2Z" );
            return $filter( 'date' )( dateFormatted, 'dd/MM/yyyy HH:mm:ss' );
        };
    } ] );