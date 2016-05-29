angular.module( 'app.directives' )
    .directive( 'projectFileDownload',
    [ '$timeout', 'appConfig', 'ProjectFile', function ( $timeout, appConfig, ProjectFile ) {

        return {
            restrict: 'E',
            templateUrl: appConfig.baseUrl + '/build/views/templates/projectFileDownload.html',
            link: function ( $scope, element, attr ) {
                //Pega os filho da directiva <project-file-download>
                var anchor = element.children()[ 0 ];

                $scope.$on( 'trata-btn-download', function () {
                    $( anchor ).addClass( 'disabled' );
                    $( anchor ).text( 'Loading...' );
                } );

                $scope.$on( 'salvar-arquivo', function ( event, data ) {
                    $( anchor ).removeClass( 'disabled' );
                    $( anchor ).text( 'Save File?' );
                    //Faz download
                    $( anchor ).attr( {
                        href: 'data:application-octet-stream;base64,' + data.file,
                        download: data.name
                    } );
                    //Força o download no primeiro click
                    $timeout( function () {
                        //Função vazia para não permitir loop infinito.
                        $scope.downloadFile = function () {
                        };
                        $( anchor )[ 0 ].click();
                    } );
                } );

            },
            controller: [ '$scope', '$element', '$attrs', function ( $scope, $element, $attrs ) {

                $scope.downloadFile = function () {
                    $scope.$emit( 'trata-btn-download' );
                    ProjectFile.download( { id: $attrs.projectId, fileId: $attrs.fileId }, function ( data ) {
                        $scope.$emit( 'salvar-arquivo', data );
                    } );
                };
            } ]
        };
    } ] );