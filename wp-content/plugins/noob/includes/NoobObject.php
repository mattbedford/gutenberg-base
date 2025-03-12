<?php

namespace Noob;

abstract class NoobObject {

    public static $html = "<p>Slider could not be loaded</p>";
    // REMEMBER TO RETURN, NOT ECHO STUFF....

    public static function Init($atts, $content, $block) {

        $method = "Create" . ucfirst($atts['sliderType']) . "Slider";
        if((method_exists(self::class, $method))) {
            self::$method($atts, $content, $block);
        }

        return self::$html;

    }

    private static function CreateSpeakersSlider($atts, $content, $block): void
    {

        $slider_type = $atts['sliderType'];
        $display = ((bool)$atts['directionVertical'] ? "vertical display" : "horizontal display");
        $html ="<div style='border:6px dashed deeppink;height:200px;text-align:center;padding:40px;Margin:10px;'";
        $html .= " class='" . get_block_wrapper_attributes() . "'>";
        $html .= "Our display type is $display And our slider type is: $slider_type - rejoice!";
        $html .= "</div>";

        self::$html = $html;

    }



}