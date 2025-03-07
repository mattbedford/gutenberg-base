<?php

namespace Noob;

abstract class NoobObject {

    // REMEMBER TO RETURN, NOT ECHO STUFF....
    public static function SomeCallable($atts, $content, $block) {
        if(!isset($atts['sliderType'])) return "<div>No slider type provided.</div>";
        $slider_type = $atts['sliderType'];
        $display = (boolval($atts['directionVertical']) ? "vertical display" : "horizontal display");
        $html ="<div style='border:6px dashed deeppink;height:200px;text-align:center;padding:40px;Margin:10px;'";
        $html .= " class='" . get_block_wrapper_attributes() . "'>";
        $html .= "Our display type is $display And our slider type is: $slider_type - rejoice!";
        $html .= "</div>";

        return $html;
    }



}