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
                controller: 'HomeController',
                title: "Dashboard"
            } )

        /********* Rota Clients *********/
            .when( '/clients/dashboard', {
                templateUrl: 'build/views/client/dashboard.html',
                controller: 'ClientDashboardController',
                title: "Dashboard Clients"
            } )
            .when( '/clients', {
                templateUrl: 'build/views/client/list.html',
                controller: 'ClientListController',
                title: "Module Clients"
            } )
            .when( '/clients/new', {
                templateUrl: 'build/views/client/new.html',
                controller: 'ClientNewController',
                title: "New Client"
            } )
            .when( '/clients/:id/show', {
                templateUrl: 'build/views/client/show.html',
                controller: 'ClientShowController',
                title: "View Client"
            } )
            .when( '/clients/:id/edit', {
                templateUrl: 'build/views/client/edit.html',
                controller: 'ClientEditController',
                title: "Edit Client"
            } )
            .when( '/clients/:id/remove', {
                templateUrl: 'build/views/client/remove.html',
                controller: 'ClientRemoveController',
                title: "Remove Client"
            } )

        /********* Rota Projects *********/
            .when( '/projects/dashboard', {
                templateUrl: 'build/views/project/dashboard.html',
                controller: 'ProjectDashboardController',
                title: "Dashboard Projects"
            } )
            .when( '/projects', {
                templateUrl: 'build/views/project/list.html',
                controller: 'ProjectListController',
                title: "Module Projects"
            } )
            .when( '/projects/:id/detail-pdf', {
                templateUrl: 'build/views/project/list.html',
                controller: 'ProjectListController',
                title: "Module Projects"
            } )
            .when( '/projects/new', {
                templateUrl: 'build/views/project/new.html',
                controller: 'ProjectNewController',
                title: "New Project"
            } )
            .when( '/projects/:id/edit', {
                templateUrl: 'build/views/project/edit.html',
                controller: 'ProjectEditController',
                title: "Edit Project"
            } )
            .when( '/projects/:id/remove', {
                templateUrl: 'build/views/project/remove.html',
                controller: 'ProjectRemoveController',
                title: "Remove Project"
            } )

        /********* Rota Projects Notes *********/
            .when( '/projects/:id/notes', {
                templateUrl: 'build/views/project-note/list.html',
                controller: 'ProjectNoteListController',
                title: "Module Notes Project"
            } )
            .when( '/project/:id/notes/new', {
                templateUrl: 'build/views/project-note/new.html',
                controller: 'ProjectNoteNewController',
                title: "New Notes Project"
            } )
            .when( '/project/:id/notes/:idNote/show', {
                templateUrl: 'build/views/project-note/show.html',
                controller: 'ProjectNoteShowController',
                title: "View Notes Project"
            } )
            .when( '/project/:id/notes/:idNote/edit', {
                templateUrl: 'build/views/project-note/edit.html',
                controller: 'ProjectNoteEditController',
                title: "Edit Notes Project"
            } )
            .when( '/project/:id/notes/:idNote/remove', {
                templateUrl: 'build/views/project-note/remove.html',
                controller: 'ProjectNoteRemoveController',
                title: "Remove Notes Project"
            } )

        /********* Rota Projects Tasks *********/
            .when( '/project/:id/tasks', {
                templateUrl: 'build/views/project-task/list.html',
                controller: 'ProjectTaskListController',
                title: "Module Task Project"
            } )
            .when( '/project/:id/task/new', {
                templateUrl: 'build/views/project-task/new.html',
                controller: 'ProjectTaskNewController'
            } )
            .when( '/project/:id/task/:idTask/edit', {
                templateUrl: 'build/views/project-task/edit.html',
                controller: 'ProjectTaskEditController',
                title: "Edit Task Project"
            } )
            .when( '/project/:id/task/:idTask/remove', {
                templateUrl: 'build/views/project-task/remove.html',
                controller: 'ProjectTaskRemoveController',
                title: "Remove Task Project"
            } )

        /********* Rota Projects Members *********/
            .when( '/project/:id/members-home', {
                templateUrl: 'build/views/project-member/home.html',
                controller: 'ProjectMemberListController',
            } )
            .when( '/project/:id/members', {
                templateUrl: 'build/views/project-member/list.html',
                controller: 'ProjectMemberListController',
                title: "Module Members Project"
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
