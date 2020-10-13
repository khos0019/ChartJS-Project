<?php
require_once 'Chart.php';
require_once 'Charts/Pie_chart/Dataset.php';
require_once 'Charts/Pie_chart/Datarow.php';
?>
<?php

/*
* @author Apurva Patel
*
* This class inherits from superclass Chart.
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
    
	// Adds one additional dataset
    public function add_dataset(PieDataSet $dataset): void {
        $this->dataset->append($dataset);
    }
    
	/**
     * 
	 *
     * @param $dataset
     */
    public function with_dataset(PieDataset $dataset): Self {
        $this->add_dataset($dataset);
        return $this;
    }
    
    /**
     * A set label
	 *
     * @param String $label
     */
    public function set_label(String $label): void {
        $this->label = $label;
    }
    
    /**
     *  
	 *
     * @param String $label
     * @return PieChart
     */
    public function with_label(String $label): PieChart {
		// invokes the add_data
        $this->set_label($label);
        return $this;
    }
    
    /**
     * returns 	string label. 
	 *
     * @return String|NULL
     */
    public function get_label(): ?String {
        return $this->label;
    }
    
    /**
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
        '                    beginAtZero: true' . "\n" .
        '                }' . "\n" .
        '            }]' . "\n" .
        '        }' . "\n" .
        '    }' . "\n" .
        '});' . "\n" .
        '</script>' . "\n";
    }

}

?>
