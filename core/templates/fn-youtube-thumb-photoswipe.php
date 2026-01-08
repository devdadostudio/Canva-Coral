<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (true == strpos($url, 'watch')) {
	$youtube_url = str_replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/', $url);
	$youtube_thumb_url = str_replace('https://www.youtube.com/watch?v=', 'https://i3.ytimg.com/vi/',  $url) . '/maxresdefault.jpg';
} else if (true == strpos($url, 'youtu.be')) {
	$youtube_url = str_replace('https://youtu.be/',  'https://www.youtube.com/embed/', $url);
	$youtube_thumb_url = str_replace('https://youtu.be/', 'https://i3.ytimg.com/vi/',  $url) . '/maxresdefault.jpg';
}
?>

<figure class="photoswipe-item relative ratio-1-1 group gallery-item gallery-item-<?php echo $gallery_item; ?>" data-type="youtube" data-size="327x327" width="327" height="327" data-pswp-uid="6">
	<img class="absolute object-cover transform-gpu w-full w-3/4" src="<?php echo esc_url($youtube_thumb_url); ?>" alt="<?php _e('Guarda il video', 'canva-frontend'); ?>" width="327" height="327" />
	<div class="_video-youtube hidden">
		<div class="_photoswipe-video m-0 m-auto">
			<div class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio">
				<iframe class="pswp__video" width="560" height="315" src="<?php echo esc_url($youtube_url); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</figure>
