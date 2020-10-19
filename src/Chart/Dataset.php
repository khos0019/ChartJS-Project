<?php
require_once ('Chart/Dataset/Datarow.php');
?>
<?php

/*
 * @author Navraj Khosla
 * 
 * Abstract class that will be overwritten by other subclasses.
 * Adds the rows and labels.
 * Returns the desired output.
 * 
 */
abstract class Dataset {
    
    //Rows variable with Data type of ArrayOfDatarow which is found in the abstract datarow class.
    private ArrayOfDatarow $rows;
    
    //Default constructor that creates a new instance of ArrayOfDatarow.
    public function __construct() {
        $this->rows = new ArrayOfDatarow();
    }
    
    //Adds a new row.
    public function add_row(AbsDatarow $row): void {
        
        try {
            $this->rows->append($row);
        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }
    
    //This function is a like a builder pattern and chains with the add_row function above.
    public function with_row(AbsDatarow $row): Self {
        $this->add_row($row);
        return $this;
    }
    
    //Gets the rows.
    public function get_rows(): ArrayOfDatarow {
        return $this->rows;
    }
    
    //Gets the rows with an index.
    public function get_row(int $index): ?AbsDatarow {
        return $this->rows[$index];
    }
    
    //Maps the information about each row.
    public function map($f): void {
        $this->rows = $f($this->rows);
    }
    
    //Returns the desired output.
    public abstract function __toString(): String;
    
}

final class ArrayOfDataset extends ArrayObject {
    
    //Checks that the $newval is an instance of Dataset.
    public function offsetSet($index, $newval) {
        
        if ($newval instanceof Dataset) {
            return parent::offsetSet($index, $newval);
        }
        throw new InvalidArgumentException("$newval: not an instance of Dataset");
    }
    
    //Joins the array elements with a string.
    public function __toString(): String {
        return '[' . implode(',', (array)$this) . ']';
    }
}

?>
