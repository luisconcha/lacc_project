angular.module( 'app.controllers' )
    .controller( 'ReportsController', [ '$scope', 'Reports', function ( $scope, Reports ) {

        // $scope.projectResultPie = [];
        // $scope.pieData =  Reports.getProjects( {}, function () {} );
        // $scope.pieData.$promise.then(function ( result ) {
        //     angular.forEach( result, function ( value, key ) {
        //         $scope.projectResultPie.push( {
        //             name: value.name,
        //             y: value.progress
        //         } );
        //     } );
        // });

        $scope.projectResultPie = [];
        $scope.categories       = [];
        Reports.getProjects( {
            id: {}
        }, function ( data ) {
            /**
             * Percorre os valores para montar o grafico
             */
            angular.forEach( data, function ( value, key ) {
                $scope.projectResultPie.push( {
                    name: value.name,
                    y: value.progress
                } );
            } );
            /**
             * Percorre os valores para montar a coluna com os titulos do projeto
             */
            angular.forEach( data, function ( value ) {
                $scope.categories.push( value.name );
            } );
        } );

        $scope.chartProject = {
            options: {
                chart: {
                    type: 'bar'
                }
            },
            series: [ {
                data: $scope.projectResultPie
            } ],
            title: {
                text: 'Project Report'
            },
            xAxis: {
                categories: $scope.categories,
                title: {
                    text: 'Nome do Projeto'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Projects measured in percentages(%)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' percentual avançado'
            },
            credits: {
                enabled: false
            },
            loading: false
        };

    } ] );