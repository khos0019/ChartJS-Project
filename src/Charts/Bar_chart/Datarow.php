<?php
require_once ('Color.php');
require_once ('Chart/Dataset/Datarow.php');
?>
<?php

/** 
 * @author Po
 * 
 * Datarow for BarChart.
 * Each row represents a single value of a Dataset.
 * 
 */
final class BarDatarow extends AbsDatarow {
    /**
     * @author Po
     *
     */
    public function __construct(String $label, float $data, Color $background_color) {
        $this->add_property(Self::LABEL, $label);
        $this->add_property(Self::DATA, $data);
        $this->add_property(Self::BACKGROUND_COLOR, $background_color);
    }
}

?>
