<?php

final class Color {
    private int $r, $g, $b;
    private float $a;
    
    private function __construct($r, $g, $b, $a) {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->a = $a;
    }
    
    /**
     *
     * @param int $r
     * @param int $g
     * @param int $b
     * @param int $a
     * @return Color
     */
    public static function rgba(int $r, int $g, int $b, float $a): Color {
        return new Color($r, $g, $b, $a);
    }
    
    public static function rand() {
        return self::rgba(rand(0, 255), rand(0, 255), rand(0, 255), rand(0, 100)/100);
    }
    
    /**
     *
     * @return String
     */
    public function __toString(): String {
        return "rgba($this->r, $this->g, $this->b, $this->a)";
    }
    
}

?>
