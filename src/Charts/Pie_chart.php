<?php
require_once 'Chart.php';
require_once 'Charts/Pie_chart/Dataset.php';
require_once 'Charts/Pie_chart/Datarow.php';
?>
<?php

/*
*  @author Apurva Patel
*
*  This class inherits from superclass Chart.
*/

// The class inherits from Chart
final class PieChart extends Chart {
    
	// A variable called dataset which would hold the array object
    private ?ArrayObject $dataset;
	// A variable called label which would hold a string
    private ?String $label;

	// Constructor
    public function __construct(String $chart_id) {
        parent::__construct($chart_id);
        $this->dataset = new ArrayOfDataset();
    }
    
    /**
     * 
     * @param AbsDatarow $row
     * @return $this-> dataset
     */
    public function add_row(AbsDatarow $row): void {
        $this->dataset[0]->add_row($row);
    }
    
	// Adds one additional dataset
    public function add_dataset(PieDataSet $dataset): void {
        $this->dataset->append($dataset);
    }
    
	/**
     * The function calls add_dataset method to add new dataset through chain linking of methods
	 *
     * @param ArrayObject $dataset
     */
    public function with_dataset(PieDataset $dataset): Self {
        $this->add_dataset($dataset);
        return $this;
    }
    
    /**
     * The function sets the label for the chart
	 *
     * @param String $label
     */
    public function set_label(String $label): void {
        $this->label = $label;
    }
    
    /**
     * The function sets the label for the chart and then dataset itself
	 *
     * @param String $label
     * @return PieChart
     */
    public function with_label(String $label): PieChart {
        //This invokes the set_label
        $this->set_label($label);
        return $this;
    }
    
    /**
     * A function which returns the string. 
	 *
     * @return String|NULL
     */
    public function get_label(): ?String {
        return $this->label;
    }
    
    /**
     * The fuction prints out the contents of the pie chart, the values, and the labels
     * 
     * {@inheritDoc}
     * @see Chart::to_string()
     */
    public function __toString(): ?String {
        return
        '<script>' . "\n" .
        "var ctx = document.getElementById('" . $this->get_id() . "').getContext('2d');" . "\n" .
        'var ' . $this->get_id() . ' = new Chart(ctx, {' . "\n" .
        "    type: 'pie'," . "\n" .
        "    label: '" . "$this->label" . "'," . "\n" .
        '    data: {' . "\n" .
        "        labels: " . $this->dataset[0]->get_labels() . ",\n" .
        '        datasets: ' . "$this->dataset" .
        '    },' . "\n" .
        '    options: {' . "\n" .
        (is_null($this->get_responsive()) ? "" : '        responsive: ' . ($this->get_responsive() ? 'true' : 'false') .',' . "\n") .
        '        scales: {' . "\n" .
        '            yAxes: [{' . "\n" .
	    '                ticks: {' . "\n" .
	    '                    display: false,' .
        '                    beginAtZero: true' . "\n" .
        '                },' . "\n" .
	    '		        gridLines: {' . "\n" .
	    '                    display: false,' . "\n" .
        '                }' . "\n" .
        '            }]' . "\n" .
        '        }' . "\n" .
        '    }' . "\n" .
        '});' . "\n" .
        '</script>' . "\n";
    }

}

?>
