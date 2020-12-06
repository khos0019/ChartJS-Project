<?php
use PHPUnit\Framework\TestCase;
require_once ('Chart.php');
require_once 'Chart/Dataset.php';
require_once ('Charts/Pie_chart.php');
require_once ('Charts/Pie_chart/Datarow.php');
require_once ('Color.php');
require_once ('Charts/Bar_chart.php');
require_once ('Charts/Bar_chart/Datarow.php');
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
    public function test1_ValueInput()
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
    public function test2_LabelInput()
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
    
}

