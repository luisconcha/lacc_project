angular.module( 'app.controllers' )
    .controller( 'ReportsController', [ '$scope', 'Reports', function ( $scope, Reports ) {

        // $scope.projectResultBarResult = [];
        // $scope.pieData =  Reports.getProjects( {}, function () {} );
        // $scope.pieData.$promise.then(function ( result ) {
        //     angular.forEach( result, function ( value, key ) {
        //         $scope.projectResultBarResult.push( {
        //             name: value.name,
        //             y: value.progress
        //         } );
        //     } );
        // });

        $scope.chartColumnProjectResult = [];
        $scope.projectResultBarResult   = [];
        $scope.projectResultPieResult   = [];
        $scope.nameColumnCtegories      = [];

        Reports.getProjects( {
            id: {}
        }, function ( data ) {
            /**
             * Percorre os valores para montar o grafico
             */
            angular.forEach( data, function ( value, key ) {
                $scope.projectResultBarResult.push( {
                    name: value.name,
                    y: value.progress
                } );
                $scope.projectResultPieResult.push( {
                    name: value.name,
                    y: value.progress
                } );
            } );
            /**
             * Percorre os valores para montar a coluna com os titulos do projeto
             */
            angular.forEach( data, function ( value ) {
                $scope.nameColumnCtegories.push( value.name );
                $scope.chartColumnProjectResult.push( value.progress );
            } );
        } );

        $scope.chartPieProject = {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Report in circle format'
            },
            subtitle: {
                "text": "LACC"
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: 'silver'
                    }
                }
            },
            series: [ {
                name: 'Percentual avançado %',
                data: $scope.projectResultPieResult,
                type: "pie",
                id: "series-0"
            } ],
            credits: {
                enabled: false
            },
            loading: false
        };

        $scope.chartColumnProject = {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Report in column format'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                series: {
                    "stacking": ""
                }
            },
            series: [
                {
                    "name": "Some data",
                    "data": $scope.chartColumnProjectResult,
                    "id": "series-0",
                    "connectNulls": false,
                    "type": "column"
                },
                {
                    "name": "Some data 2",
                    "data": $scope.chartColumnProjectResult,
                    "type": "column",
                    "id": "series-2"
                }
            ],
            credits: {
                enabled: false
            },
            loading: false
        };

        $scope.chartBarProject = {
            options: {
                chart: {
                    type: 'bar'
                }
            },
            series: [
                {
                    name: 'Modelo 01',
                    data: $scope.projectResultBarResult
                },
                {
                    name: "Modelo 02",
                    data: $scope.projectResultBarResult,
                    dashStyle: "ShortDash"
                }
            ],
            title: {
                text: 'Project Report'
            },
            xAxis: {
                categories: $scope.nameColumnCtegories,
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

        $scope.areasplineProject = {
            options: {
                chart: {
                    type: 'areaspline'
                }
            },
            series: [
                {
                    name: 'Modelo 01',
                    data: $scope.projectResultBarResult
                }
            ],
            title: {
                text: 'Project Report 02'
            },
            xAxis: {
                categories: $scope.nameColumnCtegories,
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