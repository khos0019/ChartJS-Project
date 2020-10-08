<?php
require_once ('Color.php');
?>
<?php

class Datarow {
    public String $label;
    public int    $data;
    public Color  $background_color;
    public Color  $border_color;
    public function __construct(String $label, int $data, Color $background_color, Color $border_color) {
        $this->label = $label;
        $this->data  = $data;
        $this->background_color = $background_color;
        $this->border_color = $border_color;
    }
}

?>
