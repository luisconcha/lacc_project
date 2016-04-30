angular.module( 'app.filters' )
    .filter( 'dataBr', [ '$filter', function ( $filter ) {
        return function ( input ) {
            return $filter( 'date' )( input, 'dd/MM/yyyy' );
        };
    } ] );