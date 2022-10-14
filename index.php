<?php
require "./bootstrap.php";
?>
<!DOCTYPE HTML>
<html>

<head>
    <script>
        function generateChart() {
            CanvasJS.addColorSet("blueShades",
                [
                    "#2899E1",
                    "#0969A6",
                    "#097BC4",
                    "#0B8CDF",
                    "#187CBC"
                ]);
            var chart = new CanvasJS.Chart("chartContainer", {
                colorSet: "blueShades",
                animationEnabled: false,
                theme: "light2",
                title: {
                    text: "IOT PHP Project"
                },
                axisX: {
                    interval: 0.5,
                    labelAngle: -30
                },
                dataPointWidth: 30,
                axisY: {
                    includeZero: true
                },
                data: [{
                    type: "column",
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
        window.onload = generateChart

    </script>
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <div class="chart-holder">
        <div id="chartContainer"></div>
    </div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>