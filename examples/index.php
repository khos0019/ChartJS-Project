<?php
require_once ('Chart.php');
require_once ('Charts/Pie_chart.php');
require_once ('Charts/Pie_chart/Datarow.php');
require_once ('Color.php');
function make_chart() {
    $chart = new PieChart("myChart");
    $chart->set_responsive(false);
    for ($x = rand() % 7 + 3; $x > 0; $x--){
        $chart->add_data(new Datarow("label" . "$x", rand(), Color::rand(), Color::rand()));
    }
    $chart->set_label("lb");
    return $chart;
}
echo "<html>\n";
echo "<body>\n";
echo '<canvas id="myChart" width="400" height="400"><p>Hello Fallback World</p></canvas>' . "\n";
echo '<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3"></script>' . "\n";
echo make_chart();
echo "</body>";
echo "</html>";
?>
