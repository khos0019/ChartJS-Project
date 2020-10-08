<?php
require_once ('Chart.php');
require_once ('Charts/Pie_chart/Datarow.php');
?>
<?php

class PieChart extends Chart {
    
    private ?String $label;
    private ?array  $labels = [];
    private ?array  $dataset = [];
    private ?array  $background_colors = [];
    private ?array  $border_colors = [];
    private ?int    $border_width;

    public function __construct(String $chart_id) {
        parent::__construct($chart_id);

    }
    
    /**
     * 
     * @param Datarow $datarow
     */
    public function add_data(Datarow $datarow): void {
        array_push($this->labels, $datarow->label);
        array_push($this->dataset, $datarow->data);
        array_push($this->background_colors, $datarow->background_color);
        array_push($this->border_colors, $datarow->border_color);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see Chart::with_data()
     */
    public function with_data(Datarow $datarow): PieChart {
        $this->add_data($datarow);
        return $this;
    }
    
    /**
     * 
     * @param String $label
     */
    public function set_label(String $label): void {
        $this->label = $label;
    }
    
    /**
     * 
     * @param String $label
     * @return PieChart
     */
    public function with_label(String $label): PieChart {
        $this->set_label($label);
        return $this;
    }
    
    /**
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
        "        labels: ['" . implode("','", $this->labels) . "']," . "\n" .
        '        datasets: [{' . "\n" .
        '            data: [' . implode(',', $this->dataset) . '],' . "\n" .
        "            backgroundColor: ['" . implode("','", $this->background_colors) . "']," . "\n" .
        "            borderColor: ['" . implode("','", $this->border_colors) . "']," . "\n" .
        '            borderWidth: 1' . "\n" .
        '        }]' . "\n" .
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
