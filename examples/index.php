<?php
require_once ('Chart.php');
require_once 'Chart/Dataset.php';
require_once ('Charts/Pie_chart.php');
require_once ('Charts/Pie_chart/Datarow.php');
require_once ('Color.php');
function make_chart() {
    $chart = new PieChart("myChart");
    $chart->set_responsive(false);
    for ($x = rand(1, 5); $x > 0; $x--){
        $dataset = new PieDataSet();
        $max = rand(5, 20);
        for ($y = 1; $y <= $max; $y++) {
            $dataset->add_row(new PieDatarow('label' . "$y", rand(), Color::rand()));
        }
        $chart->add_dataset($dataset);
    }
    $chart->set_label('Label');
    return $chart;
}
echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "<head>\n";
echo "<link rel='stylesheet' href='example.css' />\n";
echo "</head>\n";
echo "<body>\n";
echo "<canvas id='myChart' class='center' width='800' height='800'><p>Hello Fallback World</p></canvas>\n";
echo "<script src='https://cdn.jsdelivr.net/npm/chart.js@2.9.3'></script>\n";
echo make_chart();
echo "<input type='submit' value='generate' class='center' onclick='location.reload()'>\n";
echo "</body>\n";
echo "</html>\n";
?>
