angular.module( 'app.controllers' )
    .controller( 'HomeController', [ '$scope', '$cookies', 'Project', function ( $scope, $cookies, Project ) {

        $scope.user_name = $cookies.getObject( 'user' ).user_name;

        Project.get( {
            orderBy: 'created_at',
            sortedBy: 'desc',
            limit: 5
        }, function ( data ) {
            console.log( 'Obj:: ', data );
            $scope.projects = data.data;
        } );

        $scope.alterViewProjects = function ( typeView ) {
            if ( typeView == 'viewList' ) {
                $('.div-list-project' ).removeClass('col-sm-4' ).addClass('col-sm-12');
            } else if ( typeView == 'viewPanel' ) {
                $('.div-list-project' ).removeClass('col-sm-12' ).addClass('col-sm-4');
            }
        };

    } ] );