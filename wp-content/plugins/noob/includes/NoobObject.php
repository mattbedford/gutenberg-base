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

    public static function Init($atts, $content, $block): string {

	    // Register helper classes
	    include_once 'Settings.php';
	    include_once 'JavascriptConfig.php';

	    $settings_object = new Settings($atts);


        $method = "Create" . ucfirst($atts['sliderType']) . "Slider";
        if((method_exists(self::class, $method))) {
            self::$method($atts, $content, $block);
        }

		self::$html .= JavascriptConfig::CreateSettings($atts);
        return self::$html;

    }

    private static function CreateFeaturedSlider($atts, $content, $block): void
    {
		// Set up posts array
	    $posts = get_posts(['post_type' => 'project', 'posts_per_page' => 6]);
		if(!empty($posts)) {
			$posts = self::PostMap($posts);
		}

		// Set vars for slider
        $slider_type = $atts['sliderType'];
        $display = ((bool)$atts['directionVertical'] ? "vertical display" : "horizontal display");

		// Build html - include atts and wp classes in wrapper
	    $html ="<div ";
	    $html .= "id='" . $atts['uniqueId'] . "' ";
	    $html .= "data-class='swiper-instance'";
		$html .= get_block_wrapper_attributes() . "'>";
		$html .= "<div class='swiper-wrapper'>";

		foreach($posts as $post) {
			$html .= "<div class='slide-single project-slide swiper-slide'>";
			$html .= "<img class='project-photo' src='" . $post['image'] . "' alt='" . $post['title'] . "' />";
			$html .= "<div class='slide-single-content'>";
			$html .= "<p>" . $post['title'] . "</p>";
			$html .= "<img src='" . $post['logo'] . " alt='Imagine del nostro progetto' />";
			$html .= "<p>" . $post['luogo'] . "</p>";
			$html .= "<a href='" . $post['link'] . "'>Scopri il progetto</a>";
			$html .= "</div>";
			$html .= "</div>";
		}
		$html .= "</div>";
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
				'luogo' => get_the_title( (int) $post->luogo),
				'image' => wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'large' ),
				'link'  => get_the_permalink( $post->ID ),
			];
		}, $posts);

	}

	private static function PrintJavascript($settings): void
	{

		JavascriptConfig::CreateSettings($settings);
	}

}