<?php
require_once 'Chart.php';
require_once 'Charts/Bar_chart/Dataset.php';
require_once 'Charts/Bar_chart/Datarow.php';
?>
<?php

final class BarChart extends Chart {
    
    private ?ArrayObject $dataset;
    private ?String $label;
    
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
        $this->dataset = $dataset;
    }
    
    /**
     *
     * @param AbsDatarow $row
     * @return $this-> dataset
     */
    public function add_row(AbsDatarow $row): void {
        $this->dataset[0]->add_row($row);
    }
    
    
}
?>