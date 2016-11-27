angular.module( 'app.controllers' )
    .controller( 'ReportsController', [ '$scope', 'Reports', function ( $scope, Reports ) {

        $scope.projectResultPie = [];
        $scope.pieData =  Reports.getProjects( {}, function () {} );
        $scope.pieData.$promise.then(function ( result ) {
            angular.forEach( result, function ( value, key ) {
                $scope.projectResultPie.push( {
                    name: value.name,
                    y: value.progress
                } );
            } );
        });


        $scope.chartProject = {
            options: {
                chart: {
                    type: 'bar'
                }
            },
            series: [{
                data: $scope.projectResultPie
            }],
            title: {
                text: 'Project Report'
            },
            xAxis: {
                categories: ['1', '2', '3', '4', '5'],
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