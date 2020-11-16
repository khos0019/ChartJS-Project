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
    public const LABEL = "label";
    public const DATA  = "data";
    public const BACKGROUND_COLOR = "backgroundColor";
    public const BORDER_COLOR = "borderColor";
    public const BORDER_ALIGN = "borderAlign";
    public const BORDER_WIDTH = "borderWidth";
    public const HOVER_BACKGROUND_COLOR = "hoverBackgroundColor";
    public const HOVER_BORDER_COLOR = "hoverBorderColor";
    public const HOVER_BORDER_WIDTH = "hoverBorderWidth";
    public const WEIGHT = "weight";
    
    
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
