<?php
/**
 *
 * @author Apurva
 * @author Keyurkumar Patel
 * The class below extends the abstract class dataset and its methods
 * This class represents the dataset for the bar chart
 */
require_once 'Chart/Dataset.php';



final class BarDataset extends Dataset {
    
    // cache variable represents the values
    private ?string $cache;
    
    // labels_cache for labels of numbers
    private ?string $labels_cache;
    
    /**
     * Initial constructor
     */
    
    /**
     * Initial constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     *
     * @param invalidate_cache()
     * In the add_row function Accepts a datarow and calls the method in the abstract class to execute it and add the row
     * Invalidates existing info if there is any to ensure its adding to a null datarow
     */
    public function add_row(AbsDatarow $row): void
    {
        // calls add_row from superclass
        parent::add_row($row);
        $this->invalidate_cache();
    }
    
    /**
     * in the function of with_row, Calls the add_row method,
     *
     * @param $row
     * @return add_row($row)
     */
    public function with_row(AbsDatarow $row): Self
    {
        // calls add row method from this class
        $this->add_row($row);
        return $this;
    }
    /**
     * This print_object function accepts an array of label values
     *
     * @param $arr
     * @return $str
     */
    private static function print_object(array $arr): string
    {
        $str = "{";
        // for each value from datarow, prints it into the string
        foreach ($arr as $key => $values) {
            $str = $str . "\n$key: ['" . implode("','", (array) $values) . "'],";
        }
        $str = rtrim($str, ',');
        $str = $str . "\n}\n";
        return $str;
    }
    
    /**
     * This print_array function accepts an array of datarow values
     *
     * @param $arr
     * @return $arr
     */
    private static function print_array(array $arr): string
    {
        // returns the array contents in string format
        return "['" . implode("','", $arr) . "']";
    }
    
    /**
     * This arrange function takes the data arraya and arranges it in order
     *
     * @param $data
     * @return $dataset
     */
    private static function arrange(array $data): array
    {
        // creates a local array
        $dataset = [];
        foreach ($data as $row) {
            // using using entered array, gets the values and arranges it
            foreach ($row->get_properties() as $key => $value) {
                if (array_key_exists($key, $dataset)) {
                    array_push($dataset[$key], $value);
                } else {
                    $dataset[$key] = [
                        $value
                    ];
                }
            }
        }
        // returns arranged values
        return $dataset;
    }
    
    /**
     * This invalidate_cache function sets the datarows and labels to null
     */
    private function invalidate_cache(): void
    {
        // sets datarow values to null
        $this->cache = null;
        // sets label values to null
        $this->labels_cache = null;
    }
    
    /**
     * build_cache method for cache(datarows of Barchart) and labels, calls two other methods
     * from this class print_object and print_array to complete build
     */
    private function build_cache(): void
    {
        // gets the values for the datarows
        $dataset = Self::arrange((array) $this->get_rows());
        // sets the labels
        $labels = $dataset[BarDatarow::LABEL];
        unset($dataset[BarDatarow::LABEL]);
        // initializes cache with datarow values
        $this->cache = Self::print_object($dataset);
        // initializes label variable with label values
        $this->labels_cache = Self::print_array($labels);
    }
    
    /**
     * This function get_lable will be gatter methods for this class
     *
     * @return $this->labels_cache
     */
    public function get_labels(): string
    {
        // if label is null call builder method
        if (is_null($this->labels_cache)) {
            $this->build_cache();
        }
        // return label values
        return $this->labels_cache;
    }
    
    /**
     *
     * toString method for the datarows values
     *
     * @return $cache
     */
    public function __toString(): String
    {
        if (is_null($this->cache)) {
            $this->build_cache();
        }
        // returns datarow values
        return $this->cache;
    }
    
}

?>