<?php

abstract class Chart {
    
    private String   $chart_id;
    private ?String  $fallback_message;
    protected ?bool  $is_responsive;
    protected ?int   $responsive_animation_duration;
    protected ?bool  $maintain_aspect_ratio;
    
    /**
     *
     * @param String $chart_id
     */
    public function __construct(String $chart_id) {
        $this->chart_id = $chart_id;
    }
    
    /**
     *
     * @return String
     */
    public function get_id(): String {
        return $this->chart_id;
    }
    
    /**
     * Add data row into the chart
     * @param AbsDatarow $row
     */
    public abstract function add_row(AbsDatarow $row): void;
    
    /**
     *
     */
    public function destory(): void {
        echo "$this->chart_var_name" + '.destory();';
    }
    
    /**
     *
     */
    public function update(): void {
        $this->update_with(NULL, NULL, NULL);
    }
    
    /**
     * Triggers an update of the chart. This can be safely called after updating the data object.
     * This will update all scales, legends, and then re-render the chart.
     *
     * @param int $duration
     * @param bool $lazy
     * @param String $easing
     */
    public function update_with(?int $duration, ?bool $lazy, ?String $easing) :void {
        echo "$this->chart_var_name" + '.update({'
            + is_null($duration) ? 'duration: ' + "$duration" : ""
            + is_null($lazy)     ? ', lazy: '   + "$lazy"     : ""
            + is_null($easing)   ? ', easing: ' + "$easing"   : ""
            + '});';
    }
    
    /**
     * Reset the chart to it's state before the initial animation. A new animation can then be triggered using update.
     */
    public function reset(): void {
        echo "$this->chart_var_name" + '.reset();';
    }
    
    /**
     * Triggers a redraw of all chart elements. Note, this does not update elements for new data. Use .update() in that case.
     */
    public function render(): void {
        $this->render_with(NULL, NULL, NULL);
    }
    
    /**
     * Triggers a redraw of all chart elements. Note, this does not update elements for new data. Use .update() in that case.
     *
     * @param int $duration
     * @param bool $lazy
     * @param String $easing
     */
    public function render_with(?int $duration, ?bool $lazy, ?String $easing): void {
        echo "$this->chart_var_name" + '.render({'
            + is_null($duration) ? 'duration: ' + "$duration" : ""
            + is_null($lazy)     ? ', lazy: '   + "$lazy"     : ""
            + is_null($easing)   ? ', easing: ' + "$easing"   : ""
            + '});';
    }
    
    /**
     * Use this to stop any current animation loop.
     * This will pause the chart during any current animation frame. Call .render() to re-animate.
     */
    public function stop(): void {
        echo "$this->chart_var_name" + '.stop();';
    }
    
    /**
     * Use this to manually resize the canvas element.
     * This is run each time the canvas container is resized, but you can call this method manually if you change the size of the canvas nodes container element.
     */
    public function resize(): void {
        echo "$this->chart_var_name" + '.resize()';
    }
    
    /**
     * Will clear the chart canvas. Used extensively internally between animation frames, but you might find it useful.
     */
    public function clear(): void {
        echo "$this->chart_var_name" + '.clear();';
    }
    
    /**
     *
     * @param String $message
     */
    public function set_fallback_message(String $message): void {
        $this->fallback_message = message;
    }
    
    /**
     *
     * @param String $message
     * @return Chart
     */
    public function with_fallback_message(String $message): Chart {
        $this->set_fallback_message($message);
        return $this;
    }
    
    /**
     *
     * @return String|NULL
     */
    public function get_fallback_message(): ?String {
        return $this->fallback_message;
    }
    
    /**
     *
     * @param bool $responsive
     */
    public function set_responsive(bool $responsive): void {
        $this->is_responsive = $responsive;
    }
    
    /**
     *
     * @param bool $responsive
     * @return Chart
     */
    public function with_responsive(bool $responsive): Chart {
        $this->set_responsive($responsive);
        return $this;
    }
    
    /**
     *
     * @return bool
     */
    public function get_responsive(): ?bool {
        return $this->is_responsive;
    }
    
    /**
     *
     * @param int $milli
     */
    public function set_responsive_animation_duration(int $milli): void {
        $this->responsive_animation_duration = $milli;
    }
    
    /**
     *
     * @param int $milli
     * @return Chart
     */
    public function with_responsive_animation_duration(int $milli): Chart {
        $this->set_responsive_animation_duration($milli);
        return $this;
    }
    
    /**
     *
     * @return int|NULL
     */
    public function get_responsive_animation_duration(): ?int {
        return $this->responsive_animation_duration;
    }
    
    /**
     *
     * @param bool $maintain_ar
     */
    public function set_maintain_aspect_ratio(bool $maintain_ar): void {
        $this->maintain_aspect_ratio = $maintain_ar;
    }
    
    /**
     *
     * @param bool $maintain_ar
     * @return Chart
     */
    public function with_maintain_aspect_ratio(bool $maintain_ar): Chart {
        $this->set_maintain_aspect_ratio($maintain_ar);
        return $this;
    }
    
    /**
     *
     * @return bool|NULL
     */
    public function get_matain_aspect_ratio(): ?bool {
        return $this->maintain_aspect_ratio;
    }
    
    /**
     *
     * @return String|NULL
     */
    abstract public function __toString(): ?String;
    
}

?>
