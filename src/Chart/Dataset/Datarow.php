<?php

abstract class AbsDatarow {
    
    private array $properties = [];
    /**
     *add_property set String value for Label
     *@param String $which $value
     *@return void
     */
    public final function add_property(string $which, $value): void {
        $this->properties[$which] = $value;
    }
    /**
     *with_property add two properties
     *@param String $which $value
     *@return $this itself
     */
    public final function with_property(string $which, $value): Self {
        $this->add_property($which, $value);
        return $this;
    }
    /**
     *return the specified properties
     *@param String $which which properity to return
     *@return object|Null the specificed properties
     */
    public final function get_property(string $which): ?object {
        return $this->properties[$which];
    }
    /**
     *get all properties value
     *@return $this->properties
     */
    public final function get_properties(): array {
        return $this->properties;
    }
    
    /**
     * Evals the given property into string format accrodingly.
     * @param object $obj object to evaluate
     * @return String accroding string representation of the given object
     */
    private static function eval_properity($obj): String {
        if (is_array($obj)) {
            return "['" . implode("','", $obj) . "']";
        }
        else {
            return "$obj";
        }
    }
    /**
     * _toString is print out all value of properties
     *@return String
     */
    public final function __toString(): String {
        $str = "{";
        foreach ($this->properties as $key=>$value) {
            $str = $str . "\n" . "$key: " . Self::eval_properity($value) . ",";
        }
        $str = rtrim($str, ',');
        $str = $str . "\n}\n";
        return $str;
    }
}

final class ArrayOfDatarow extends ArrayObject {
    /**
     *Create a new datarow after eval
     *@param $index, $newval
     *
     */
    public function offsetSet($index, $newval) {
        if ($newval instanceof AbsDatarow) {
            return parent::offsetSet($index, $newval);
        }
        throw new InvalidArgumentException("$newval: not an instance of Datarow");
    }
}

?>
