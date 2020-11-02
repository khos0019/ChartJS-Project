<?php
require_once 'Chart.php';
require_once 'Charts/Bar_chart/Dataset.php';
require_once 'Charts/Bar_chart/Datarow.php';
?>
<?php

final class BarChart extends Chart {
    
    private ?ArrayObject $dataset;
    
    public function __construct(String $chart_id) {
        parent::__construct($chart_id);
        $this->dataset = new ArrayOfDataset();
    }
 
    
    
    
    
}
?>