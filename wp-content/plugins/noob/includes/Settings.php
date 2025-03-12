<?php

namespace noob;


class Settings
{
	public $fields = [];

	public function __construct(array $block = null)
	{
		if(!$block || null === $block) return;

		$block_id = $block['uniqueId'];

		$this->fields = [
			"slider_selector_id" => $block_id,
			//"pagination" => get_field('enable_pagination' ?? false),
			//"navigation" => get_field('enable_nav') ?? false,
			//"scrollbar" => get_field('enable_scrollbar') ?? false,
			"slides" => $block['numberSlides'] ?? [],
		];
	}
}