<?php
require_once ('Color.php');
require_once ('Chart/Dataset/Datarow.php');
?>
<?php

/** 
 * @author keyurkumar Patel
 * 
 *Childclass PieDatarow extending to Parent class AbsDatarow,
 *
 *Piedatarow will use some method and properties  from parents class AbsDatarow.
 *
 */
final class PieDatarow extends AbsDatarow {
    /**
     * @author Keyurkumar Patel
     *
     * @param lable , data , background_colour 
     * 
     * Constructor. Setting properties 
     *
     * of label, data and background_color 
     *
     * using superclass's add_property method
     *
     */
    public function __construct(String $label, float $data, Color $background_color) {
        
        // set label property
        $this->add_property(Self::LABEL, $label);
        
        // set data property
        $this->add_property(Self::DATA, $data);
       
        // set background_ colour property
        $this->add_property(Self::BACKGROUND_COLOR, $background_color);
    }
}

?>
