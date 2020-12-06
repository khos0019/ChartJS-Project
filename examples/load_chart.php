<?php
require_once 'DatasetDAO.php';
require_once 'Chart.php';
require_once 'Charts/Pie_chart.php';
require_once 'Charts/Bar_chart.php';

DatasetDAO::register_datarow_type('pie', function ($label, $data, $color) { return new PieDatarow($label, $data, Color::hex($color)); });
DatasetDAO::register_dataset_type('pie', function () { return new PieDataset(); });
DatasetDAO::register_datarow_type('bar', function ($label, $data, $color) { return new BarDatarow($label, $data, Color::hex($color)); });
DatasetDAO::register_dataset_type('bar', function () { return new BarDataset(); });

$conn = new DatasetDAO("localhost", "root", "");
$dataset = $conn->get_dataset('Number of Corona Cases Per Country');

if ($dataset != null) {
  if ($dataset->get_type() == 'pie') {
    $chart = new PieChart("myChart");
  }
  else {
    $chart = new BarChart('myChart');
  }
  $chart->set_responsive(false);
  $chart->add_dataset($dataset);
  $chart->set_label("Number of Corona Cases Per Country");
  session_start();
  $_SESSION['chart'] = $chart;
}

header('Location: index.php');
exit();

?>
