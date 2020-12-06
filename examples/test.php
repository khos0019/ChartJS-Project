<?php
require_once 'DatasetDAO.php';
require_once 'Charts/Pie_chart.php';
require_once 'Charts/Bar_chart.php';

DatasetDAO::register_datarow_type('pie', function ($label, $data, $color) { return new PieDatarow($label, $data, Color::hex($color)); });
DatasetDAO::register_dataset_type('pie', function () { return new PieDataset(); });
DatasetDAO::register_datarow_type('bar', function ($label, $data, $color) { return new BarDatarow($label, $data, Color::hex($color)); });
DatasetDAO::register_dataset_type('bar', function () { return new BarDataset(); });

$conn = new DatasetDAO("localhost", "root", "");

$dataset = new BarDataSet();

$datarow = new BarDatarow('Canada', 50.0, Color::rand());
$datarow2 = new BarDatarow('US', 400.0, Color::rand());

$dataset->set_label("Corona Cases");
$dataset->add_row($datarow);
$dataset->add_row($datarow2);

$conn->add_dataset("bar", $dataset);

$dataset = $conn->get_dataset("Corona Cases");

$chart = new BarChart("myChart");
$chart->set_responsive(false);
$dataset->set_label("Number of Corona Cases Per Country");
$chart->add_dataset($dataset);
$chart->set_label("Number of Corona Cases Per Country");

echo "<canvas id='myChart' class='center' width='800' height='800'><p>Hello Fallback World</p></canvas>\n";
echo "<script src='https://cdn.jsdelivr.net/npm/chart.js@2.9.3'></script>\n";
echo $chart
?>
