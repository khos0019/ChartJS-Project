<?php
use PHPUnit\Framework\TestCase;
require_once ('Chart.php');
require_once 'Chart/Dataset.php';
require_once ('Charts/Pie_chart.php');
require_once ('Charts/Pie_chart/Datarow.php');
require_once ('Color.php');
require_once ('Charts/Bar_chart.php');
require_once ('Charts/Bar_chart/Datarow.php');
require_once 'DatasetDAO.php';
/**
 * 
 * @author Keyurkumar Patel
 * @author Apurva Patel
 *  Test cases for Bar Chart and Pie Chart
 */
class Testing extends TestCase
{

    /**
     * This test case verifies that the value entered by the user is displayed
     * in the bar data chart
     */
    public function test1_barchart_ValueInput()
    {
      $chart = new BarChart("myChart");
      $chart->set_responsive(false);
      $dataset = new BarDataSet();
      $dataset->add_row(new BarDatarow("USA", 200, Color::rand()));
      $dataset->set_label("Number of Corona Cases Per Country");
      $chart->add_dataset($dataset);
      $chart->set_label("Number of Corona Cases Per Country");
      $this->assertEquals(200, $dataset->get_row(0)->get_property("data"));
    }
    /**
     * This test case verifies that the label entered by the user is displayed
     * in the pie chart
     */
    public function test2_piechart_LabelInput()
    {
        $chart = new PieChart("myChart");
        $chart->set_responsive(false);
        $dataset = new PieDataSet();
        $dataset->add_row(new PieDatarow("Canada", 1000, Color::rand()));
        $dataset->set_label("Number of Corona Cases Per Country");
        $chart->add_dataset($dataset);
        $chart->set_label("Number of Corona Cases Per Country");
        $this->assertEquals("Canada", $dataset->get_row(0)->get_property("label"));
    }
    
    /**
     * This test case verifies that the label entered by the user is displayed
     * in the Bar Chart
     * 
     */
    
    public function test3_barchart_LabelInput()
    {
        $chart = new BarChart("myChart");
        $chart->set_responsive(false);
        $dataset = new BarDataset();
        $dataset->add_row(new BarDatarow("Russia", 3000, Color::rand()));
        $dataset->set_label("Number of Corona Cases Per Country");
        $chart->add_dataset($dataset);
        $chart->set_label("Number of Corona Cases Per Country");
        $this->assertEquals("Russia", $dataset->get_row(0)->get_property("label"));
    }
    
    /**
     *
     *This test case verifies that the value entered by the user is displayed
     * in the Pie data chart
     *
     */
    
    public function test4_piechart_ValueInput()
    {
        $chart = new PieChart("myChart");
        $chart->set_responsive(false);
        $dataset = new PieDataSet();
        $dataset->add_row(new PieDatarow("Canada", 300, Color::rand()));
        $dataset->set_label("Number of Corona Cases Per Country");
        $chart->add_dataset($dataset);
        $chart->set_label("Number of Corona Cases Per Country");
        $this->assertEquals(300, $dataset->get_row(0)->get_property("data"));
    }
    
    /**
     * A test to check if the records were actually added to the database.
     */
    public function test5_database_size() {
        
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
        
        $db_dataset = $conn->get_dataset("Corona Cases");
        
        $this->assertEquals(2, sizeof($db_dataset->get_rows()));
        
    }
    
}

