<?php
/**
 *
 * @author Apurva
 * The class below extends the abstract class dataset and its methods
 * This class represents the dataset for the bar chart
 */
require_once 'Chart/Dataset.php';



final class BarDataset extends Dataset {
    
    
    /**
     * Initial constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
      
    
    /**
     * toString method
     */
    public function __toString(): String
    {
        
    }
    
}

?>