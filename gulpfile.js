var elixir     = require( 'laravel-elixir' ),
    liveReload = require( 'gulp-livereload' ),
    clean      = require( 'rimraf' ),
    gulp       = require( 'gulp' );

var config = {
    assets_path: "./resources/assets",
    build_path: "./public/build"
};

/**************************************************
 *                                                *
 *    Configurações para os scripts JS da APP     *
 *                                                *
 **************************************************/
config.bower_path           = config.assets_path + '/../bower_components';
config.build_path_js        = config.build_path + '/js';
config.build_vendor_path_js = config.build_path_js + '/vendor';

config.vendor_path_js = [
    config.bower_path + '/jquery/dist/jquery.min.js',
    config.bower_path + '/bootstrap/dist/js/bootstrap.min.js',
    config.bower_path + '/angular/angular.min.js',
    config.bower_path + '/angular-route/angular-route.min.js',
    config.bower_path + '/angular-resource/angular-resource.min.js',
    config.bower_path + '/angular-animate/angular-animate.min.js',
    config.bower_path + '/angular-messages/angular-messages.min.js',
    config.bower_path + '/angular-bootstrap/ui-bootstrap-tpls.min.js',
    config.bower_path + '/angular-strap/dist/modules/navbar.min.js',
    config.bower_path + '/angular-cookies/angular-cookies.min.js',
    config.bower_path + '/query-string/query-string.js',
    config.bower_path + '/angular-oauth2/dist/angular-oauth2.min.js',
    config.bower_path + '/bootstrap-sweetalert/lib/sweet-alert.min.js'
];

/**************************************************
 *                                                *
 *    Configurações para os stylos CSS da APP     *
 *                                                *
 **************************************************/
config.build_path_css        = config.build_path + '/css';
config.build_vendor_path_css = config.build_path_css + '/vendor';
config.build_style_path_css  = config.build_path_css + '/style';

config.vendor_path_css       = [
    config.bower_path + '/bootstrap/dist/css/bootstrap.min.css',
    config.bower_path + '/bootstrap/dist/css/bootstrap-theme.min.css',
    config.bower_path + '/bootstrap-sweetalert/lib/sweet-alert.css',
];

config.style_path_css       = [
    config.build_path_css + '/style.css',
];


/**************************************************
 *                                                *
 *    Configurações para as FONTS da APP          *
 *                                                *
 **************************************************/

config.build_path_fonts        = config.build_path + '/fonts';
config.build_style_path_fonts  = config.build_path_fonts + '/fonts';

gulp.task( 'copy-fonts', function () {
    gulp.src( [
        config.assets_path + '/fonts/*.*'
    ] )
        .pipe( gulp.dest( config.build_path_fonts ) )
        .pipe( liveReload() );
} );


/***********************************************************
 *                                                         *
 *    TAREFAS para copiar html, css, js, fonts da app      *
 *                                                         *
 ***********************************************************/
config.build_path_html = config.build_path + '/views';

gulp.task( 'copy-html', function () {
    gulp.src( [
        config.assets_path + '/js/views/**/*.html'
    ] )
        .pipe( gulp.dest( config.build_path_html ) )
        .pipe( liveReload() );
} );

gulp.task( 'copy-styles', function () {
    gulp.src( [
        config.assets_path + '/css/**/*.css'
    ] )
        .pipe( gulp.dest( config.build_path_css ) )
        .pipe( liveReload() );

    gulp.src( config.vendor_path_css )
        .pipe( gulp.dest( config.build_vendor_path_css ) )
        .pipe( liveReload() );

    gulp.src( config.style_path_css )
       .pipe( gulp.dest( config.build_style_path_css ) )
       .pipe( liveReload() );
} );

gulp.task( 'copy-scripts', function () {
    gulp.src( [
        config.assets_path + '/js/**/*.js'
    ] )
        .pipe( gulp.dest( config.build_path_js ) )
        .pipe( liveReload() );

    gulp.src( config.vendor_path_js )
        .pipe( gulp.dest( config.build_vendor_path_js ) )
        .pipe( liveReload() );
} );

/***********************************************************
 *                                                         *
 *    Limpa a pasta build                                  *
 *                                                         *
 *********************************************************/

gulp.task( 'clear-build-folder', function () {
    clean.sync( config.build_path );
} );


/***********************************************************
 *                                                         *
 *    Executa as tarefas pre-definidas                     *
 *                                                         *
 ***********************************************************/

gulp.task( 'default', [ 'clear-build-folder' ], function () {
    gulp.start( 'copy-html' );
    elixir( function ( mix ) {
        mix.styles( config.vendor_path_css.concat( [ config.assets_path + '/css/**/*.css' ] ), 'public/css/all.css', config.assets_path );
        mix.scripts( config.vendor_path_js.concat( [ config.assets_path + '/js/**/*.js' ] ), 'public/js/all.js', config.assets_path );
        mix.version( [ 'js/all.js', 'css/all.css' ] );
    } );
} );

gulp.task( 'watch-dev', [ 'clear-build-folder' ], function () {
    liveReload.listen();
    gulp.start( 'copy-styles', 'copy-scripts', 'copy-html', 'copy-fonts' );
    gulp.watch( config.assets_path + '/**', [ 'copy-styles', 'copy-scripts', 'copy-html', 'copy-fonts' ] );
} );
