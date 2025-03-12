<?php

namespace Noob;

/**
 * Abstract class with polymorphic methods named "Create" . (ucfirst)atts["sliderType"]" . "Slider"
 *
 * The main method, Init, is a callable and must return an html string for front end.
 * $atts is an array of block attributes [sliderType], [directionVertical], [numberSlides]
 * $content is a string (empty)
 * $block is an instance of the WP Block Object
 *
 */
abstract class NoobObject {

    public static $html = "<p>Slider could not be loaded</p>";

    public static function Init($atts, $content, $block) {

        $method = "Create" . ucfirst($atts['sliderType']) . "Slider";
        if((method_exists(self::class, $method))) {
            self::$method($atts, $content, $block);
        }

        return self::$html;

    }

    private static function CreateSpeakersSlider($atts, $content, $block): void
    {
		// Set up posts array
	    $posts = get_posts(['post_type' => 'speaker', 'posts_per_page' => 10]);
		if(!empty($posts)) {
			$posts = self::PostMap($posts);
		}

		// Set vars for slider
        $slider_type = $atts['sliderType'];
        $display = ((bool)$atts['directionVertical'] ? "vertical display" : "horizontal display");

		// Build html - include atts and wp classes in wrapper
	    $html ="<div style='border:6px dashed deeppink;height:200px;text-align:center;padding:40px;Margin:10px;'";
	    $html .= " class='" . get_block_wrapper_attributes() . "'>";
		foreach($posts as $post) {
			$html .= "<div class='slide-single speaker-slide'>";
			$html .= "<img class='speaker-photo' src='" . $post['image'] . "' alt='" . $post['title'] . ", " . $post['position'] . " at " . $post['company'] . "' />";
			$html .= "<div class='slide-single-content'>";
			$html .= "<p>" . $post['title'] . "</p>";
			$html .= "<p>" . $post['position'] . "</p>";
			$html .= "<img src='" . $post['logo'] . "' alt='Company logo of " . $post['company'] . "' />";
			$html .= "</div>";
			$html .= "</div>";
		}
		$html .= "</div>";

        //$html .= "Our display type is $display And our slider type is: $slider_type - rejoice!";
        //$html .= "</div>";

        self::$html = $html;

    }


	private static function PostMap(array $posts): array
	{

		if(empty($posts)) {
			return [];
		}

		return array_map( static function ($post) {
			return [
				'id' => $post->ID,
				'title' => $post->post_title,
				'image' => wp_get_attachment_image_url( (int) $post->speaker_photo, 'large'),
				'position' => $post->position,
				'company' => get_the_title( (int) $post->my_company),
				'logo' => wp_get_attachment_image_url( get_post_meta( (int) $post->my_company, 'company_logo', true), 'large'),
			];
		}, $posts);

	}



}