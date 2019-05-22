<?php
/*
 * Copyright (c) 2019 António 'Tó' Godinho <to@isec.pt>.
 * This program is free software; Distributed under the terms of the GNU GPL v3.
 */
require './top.php';


?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>OSSEC WUI</title>
    <?php
    include "page_refresh.php";
    ?>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet" type="text/css"/>
    <link href="./css/sticky-footer.css" rel="stylesheet">
    <script src="./js/amcharts.js" type="text/javascript"></script>
    <script src="./js/serial.js" type="text/javascript"></script>
    <script src="./js/themes/light.js" type="text/javascript"></script>

    <script type="text/javascript">
        <?php
        include './php/massmonitoring_grouptime.php';
        include './php/massmonitoring_locationtime.php';
        include './php/massmonitoring_hostsubstr.php';
        ?>

        var chart = AmCharts.makeChart("chartDiv", {
            type: 'serial',
            theme: 'light',
            dataProvider: chartData,
            categoryField: 'date',
            fontFamily: 'Open Sans',
            addClassNames: true,
            categoryAxis: {
                gridAlpha: 0.15,
                parseDates: true,
                minPeriod: 'hh',
                dashLength: 1,
                axisColor: "#DADADA"
            },
            valueAxes: [
                {
                    axisColor : "#DADADA",
                    logarithmic: <?php echo $glb_indexgraphlogarithmic;  ?>,
                    dashLength: 1
                }
            ],
            legend: {
                markerType: 'circle'
            },
            chartCursor: {
                cursorPosition: 'mouse'
            }
        });

        var chart2 = AmCharts.makeChart("chartDiv2", {
            type: 'serial',
            theme: 'light',
            dataProvider: chartData2,
            categoryField: 'date',
            fontFamily: 'Open Sans',
            addClassNames: true,
            categoryAxis: {
                gridAlpha: 0.15,
                parseDates: true,
                minPeriod: 'hh',
                dashLength: 1,
                axisColor: "#DADADA"
            },
            valueAxes: [
                {
                    axisColor : "#DADADA",
                    dashLength: 1,
                    minimum: 0
                }
            ],
            legend: {
                markerType: 'circle'
            },
            chartCursor: {
                cursorPosition: 'mouse'
            }
        });

        var chart3 = AmCharts.makeChart("chartDiv3", {
            type: 'serial',
            theme: 'light',
            dataProvider: chartData3,
            categoryField: 'date',
            fontFamily: 'Open Sans',
            addClassNames: true,
            categoryAxis: {
                gridAlpha: 0.15,
                parseDates: true,
                minPeriod: 'hh',
                dashLength: 1,
                axisColor: "#DADADA"
            },
            valueAxes: [
                {
                    axisColor : "#DADADA",
                    dashLength: 1,
                    minimum: 0
                }
            ],
            legend: {
                markerType: 'circle'
            },
            chartCursor: {
                cursorPosition: 'mouse'
            }
        });
        chart.validateNow();
        chart2.validateNow();
        chart3.validateNow();

        // GRAPH
        <?php echo $graphstring; ?>
        // GRAPH
        var graph2 = new AmCharts.AmGraph();
        graph2.type = "smoothedLine";
        graph2.bulletColor = "#FFFFFF";
        graph2.bulletBorderColor = "#00BBCC";
        graph2.bulletBorderThickness = 2;
        graph2.bulletSize = 7;
        graph2.title = "Price";
        graph2.valueField = "location";
        graph2.lineThickness = 2;
        graph2.lineColor = "#00BBCC";
        chart2.addGraph(graph2);

        <?php echo $graphsubstr ?>
    </script>

</head>

<body onload="">
<?php include './header.php'; ?>
<div class="container-fluid" style="padding-top: 80px;">

    <div class='clr'></div>

    <div class="row">
        <div class="col-lg-8">
            <div>
                <ul class="nav nav-pills" role="tablist" style="width: 100%;">
                    <li role="presentation" class="active" style="width: 100%;"><a href="#" style="font-weight: 800">Groups
                            Activity Over Time <span class="badge"><?php echo $glb_mass_days ?> days)</span></a></li>
                </ul>
            </div>
            <span style='font-size:9px;'>* For interesting curves I recommend go back to index.php and search for that group specificily </span>
            <?php echo $grouptimedebugstring; ?>
            <div id="chartDiv" class="fleft" style="height:800px; width:100%"></div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div>
                    <ul class="nav nav-pills" role="tablist" style="width: 100%;">
                        <li role="presentation" class="active" style="width: 100%;"><a href="#"
                                                                                       style="font-weight: 800">Reporting
                                Locations <span class="badge">(<?php echo $glb_mass_days ?> days)</span></a></li>
                    </ul>
                </div>
                <?php echo $locationtimedebugstring; ?>
                <div id="chartDiv2" class="" style="height:300px; width:100%"></div>
            </div>
            <div class="row">
                <div>
                    <ul class="nav nav-pills" role="tablist" style="width: 100%;">
                        <li role="presentation" class="active" style="width: 100%;"><a href="#"
                                                                                       style="font-weight: 800">Actvity
                                per Host Substring <span class="badge">(<?php echo $glb_mass_days ?> days)</span></a>
                        </li>
                    </ul>
                </div>
                <?php echo $hostsubstrdebugstring; ?>
                <div id="chartDiv3" class="" style="height:300px; width:100%"></div>
            </div>
        </div>
    </div>
    <div class='row'></div>
    <?php
    include 'footer.php';
    ?>
