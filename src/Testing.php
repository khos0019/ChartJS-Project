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
    
    
}

