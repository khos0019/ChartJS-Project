<?php
require_once 'Chart.php';
require_once 'Charts/Bar_chart/Dataset.php';
require_once 'Charts/Bar_chart/Datarow.php';
?>
<?php

/**
 * Description: This class controls everything that will be used for 
 * creating a bar chart. Also, this class inherits stuff from the superclass,
 * Chart.
 * 
 * @author Navraj, Omar and Limin.
 *
 */
final class BarChart extends Chart {
    
    /**
     * An ArrayObject called dataset. 
     */
    private ?ArrayObject $dataset;
    
    /**
     * A String called label.
     */
    private ?String $label;
    
    /**
     * Description: A single-arg constructor.
     * 
     * @param String $chart_id
     */
    public function __construct(String $chart_id) {
        parent::__construct($chart_id);
        $this->dataset = new ArrayOfDataset();
    }
    
    /**
     * Sets the label of the bar chart
     * @param String $label
     */
    public function set_label(String $label) {
        $this->label = $label;
    }
    
    /**
     * Adds the dataset to the chart
     * @param BarDataset $dataset
     */
    public function add_dataset(BarDataset $dataset) {
        $this->dataset->append($dataset);
    }
    
    /**
     *
     * @param AbsDatarow $row
     * @return $this-> dataset
     */
    public function add_row(AbsDatarow $row): void {
        $this->dataset[0]->add_row($row);
    }
    
    /**
     * The fuction prints out the contents of the bar chart, the values, and the labels
     *
     * {@inheritDoc}
     * @see Chart::to_string()
     */
    public function __toString(): ?String {
        return
        '<script>' . "\n" .
        "var ctx = document.getElementById('" . $this->get_id() . "').getContext('2d');" . "\n" .
        'var ' . $this->get_id() . ' = new Chart(ctx, {' . "\n" .
        "    type: 'bar'," . "\n" .
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