<?php
echo $this->Html->css('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
echo $this->Html->script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
?>
<section class="content-header">
    <h1> <?php echo __("Dashboard") ?> <small>Version 1.0</small></h1>
    <ol class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">
            <?php echo __("Dashboard") ?>
        </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Info boxes -->

    <?php
    //debug($this->Session->read("Auth.User")) 
    //debug($activityDetails)
    //debug($rankingPoints)
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo __('') ?></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-center">
                                <strong><?php echo __('Ranking of the classe') ?></strong>
                            </p>

                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <!--<canvas id="areaChart" style="height: 180px;"></canvas>-->
                                <!--<div id="bar-chart" style="height: 300px;"></div>-->
                                <canvas id="barChart" style="height:230px"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>Goal Completion</strong>
                            </p>

                            <div class="progress-group">
                                <span class="progress-text"><?php echo __('Activities') ?></span>
                                <span class="progress-number"><b><?php echo $activityDetails['Activities']['CountActivitySucess'] ?></b>/<?php echo $activityDetails['Activities']['CountTotal'] ?></span>

                                <div class="progress sm progress progress-xs progress-striped active">
                                    <div class="progress-bar progress-bar-aqua progress-striped active" style="width: <?php echo $activityDetails['Activities']['Percentage'] ?>%"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text"><?php echo __('Challenge') ?></span>
                                <span class="progress-number"><b><?php echo $activityDetails['ActivitiesChallenge']['CountActivitySucess'] ?></b>/<?php echo $activityDetails['ActivitiesChallenge']['CountTotal'] ?></span>

                                <div class="progress sm progress progress-xs progress-striped active">
                                    <div class="progress-bar progress-bar-red" style="width: <?php echo $activityDetails['ActivitiesChallenge']['Percentage'] ?>%"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text"><?php echo __('Activity For Team') ?></span>
                                <span class="progress-number"><b><?php echo $activityDetails['ActivitiesForTeam']['CountActivitySucess'] ?></b>/<?php echo $activityDetails['ActivitiesForTeam']['CountTotal'] ?></span>

                                <div class="progress sm progress progress-xs progress-striped active">
                                    <div class="progress-bar progress-bar-green" style="width: <?php echo $activityDetails['ActivitiesForTeam']['Percentage'] ?>%"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text"><?php echo __('Challenge For Team') ?></span>
                                <span class="progress-number"><b><?php echo $activityDetails['ChallengeForTeam']['CountActivitySucess'] ?></b>/<?php echo $activityDetails['ChallengeForTeam']['CountTotal'] ?></span>

                                <div class="progress sm progress-striped active">
                                    <div class="progress-bar progress-bar-yellow" style="width: <?php echo $activityDetails['ChallengeForTeam']['Percentage'] ?>%"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage "> <?php echo $activityDetails['Activities']['Percentage'] ?>%</span>
                                <h5 class="description-header">(XP) <?php echo $activityDetails['Activities']['Points'] ?></h5>
                                <span class="description-text"><?php echo __('TOTAL ACTIVITIES') ?></span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage "> <?php echo $activityDetails['ActivitiesChallenge']['Percentage'] ?>%</span>
                                <h5 class="description-header">(XP) <?php echo $activityDetails['ActivitiesChallenge']['Points'] ?></h5>
                                <span class="description-text"><?php echo __('TOTAL CHALLENGE') ?></span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <span class="description-percentage "> <?php echo $activityDetails['ActivitiesForTeam']['Percentage'] ?>%</span>
                                <h5 class="description-header">(XP) <?php echo $activityDetails['ActivitiesForTeam']['Points'] ?></h5>
                                <span class="description-text"><?php echo __('TOTAL ACTIVITIES FOT TEAM') ?></span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block">
                                <span class="description-percentage"> <?php echo $activityDetails['ChallengeForTeam']['Percentage'] ?>%</span>
                                <h5 class="description-header">(XP) <?php echo $activityDetails['ChallengeForTeam']['Points'] ?></h5>
                                <span class="description-text"><?php echo __('TOTAL CHALLENGE FOR TEAM') ?></span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section><!-- /.content -->
<script>
    $(function () {


        //-------------
        //- BAR CHART -
        //-------------

        var areaChartData = {
            labels: [
<?php
for ($i = 0; $i < count($rankingPoints); $i++) {
    echo "'" . $rankingPoints[$i]['Student']['nm_student'] . "',";
}
?>
            ],
            datasets: [
                {
                    label: "Electronics",
                    fillColor: "rgba(210, 214, 222, 1)",
                    strokeColor: "rgba(210, 214, 222, 1)",
                    pointColor: "rgba(210, 214, 222, 1)",
                    pointStrokeColor: "#c1c7d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [
<?php
for ($i = 0; $i < count($rankingPoints); $i++) {
    echo "'" . $rankingPoints[$i][0]['total_points'] . "',";
}
?>
                    ]
                },
                {
                    label: "Digital Goods",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [
<?php
for ($i = 0; $i < count($rankingPoints); $i++) {
    echo "'" . $rankingPoints[$i][0]['total_points'] . "',";
}
?>
                    ]
                }
            ]
        };

        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth: 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);


    });
</script>