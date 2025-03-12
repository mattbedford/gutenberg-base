<?php

namespace noob;


abstract class JavascriptConfig
{

	public static function CreateSettings($args): string {

		$unique_id = trim($args['uniqueId']);

        ob_start();
        ?>

		<script defer>
            let <?php echo $unique_id; ?> = new Swiper('#<?php echo $unique_id;?>', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                breakpoints: {
					<?php
					if (isset($args['breakpoints'])) {

						foreach ($args['breakpoints'] as $breakpoint => $breakpoint_args) {
							echo $breakpoint . ": {";
							echo "slidesPerView: " . $breakpoint_args['slides_per_view'] . ",";
							echo "spaceBetween: " . $breakpoint_args['space_between'] . ",";
							if (self::isNavigationEnabled($breakpoint_args)) {
								echo "navigation: {";
								echo "enabled: true";
								echo "},";
							} else {
								echo "navigation: {";
								echo "enabled: false";
								echo "},";
							}
							echo "},";
						}
					} ?>
                },
				<?php if(isset($args['pagination'])) { ?>
                pagination: {
                    el: '.swiper-pagination<?php echo $unique_id; ?>',
                    clickable: true,
                },
				<?php } ?>

				<?php if(isset($args['navigation'])) { ?>
                navigation: {
                    nextEl: '.swiper-button-next<?php echo $unique_id; ?>',
                    prevEl: '.swiper-button-prev<?php echo $unique_id; ?>',
                }
				<?php } ?>

				<?php if(isset($args['scrollbar'])) { ?>
                scrollbar: {
                    el: '.swiper-scrollbar<?php echo $unique_id; ?>',
                }
				<?php } ?>
            });
		</script>

	<?php
        return ob_get_clean();
    }


	public static function isNavigationEnabled(array $navigationSettings): bool
	{
		return !empty($navigationSettings['navigation']['enabled']) && boolval($navigationSettings['navigation']['enabled']) === true;
	}

}