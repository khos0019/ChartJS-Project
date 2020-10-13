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
    
    //LABEL static property intialized with value ="label"
    public const LABEL = "label";  
    
    //DATA static property intialized with value ="data"
    public const DATA  = "data";    
    
    //BACKGROUND_COLOR static property intialized with value ="backgroundColor"
    public const BACKGROUND_COLOR = "backgroundColor";
    
    //BORDER_COLOR static property intialized with value ="borderColor"
    public const BORDER_COLOR = "borderColor";
    
    //BORDER_ALIGN  static property intialized with value ="borderAlign"
    public const BORDER_ALIGN = "borderAlign";
    
    //BORDER_WIDTH static property intialized with value ="borderWidth"
    public const BORDER_WIDTH = "borderWidth";
    
    //HOVER_BACKGROUND_COLOR static property intialized with value ="hoverBackgroundColor"
    public const HOVER_BACKGROUND_COLOR = "hoverBackgroundColor";
    
    //HOVER_BORDER_COLOR static property intialized with value ="hoverBorderColor"
    public const HOVER_BORDER_COLOR = "hoverBorderColor";
    
    //HOVER_BORDER_WIDTH static property intialized with value ="hoverBorderWidth"
    public const HOVER_BORDER_WIDTH = "hoverBorderWidth";
    
    //WEIGHTstatic property intialized with value ="weight"
    public const WEIGHT = "weight";
    
    
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
    public function __construct(String $label, int $data, Color $background_color) {
        
        // set label property
        $this->add_property(Self::LABEL, $label); 
        
        // set data property
        $this->add_property(Self::DATA, $data); 
       
        // set background_ colour property
        $this->add_property(Self::BACKGROUND_COLOR, $background_color); 
        
        
    }

}

?>
