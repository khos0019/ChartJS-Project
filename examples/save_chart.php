<?php
require_once 'DatasetDAO.php';
require_once 'Chart.php';
require_once 'Charts/Pie_chart.php';
require_once 'Charts/Bar_chart.php';

session_start();

if (isset($_SESSION['chart'])) {
  $conn = new DatasetDAO("localhost", "root", "");
  $chart = $_SESSION['chart'];
  $datasets = $chart->get_datasets();

  foreach ($datasets as &$dataset) {
    echo $dataset;
    $conn->add_dataset($chart->get_type(), $dataset);
  }
}

header('Location: index.php');
exit();
?>
