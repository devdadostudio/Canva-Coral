<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$rel_attr = ' rel="noopener noreferrer nofollow"';

if (is_admin()) {

	// defaults per evitare notice in admin
	$id = '';
	$className = '';
	$target_link = '';

	// filtro che permette di sovrascrivere l'icona di questo blocco
	$default_icon = apply_filters('action_link_icon', canva_get_svg_icon('fontawesome/regular/link'));

	$action_link = get_field('action_link');

	// ✅ Aggiungiamo sempre rel nofollow
	if (!empty($action_link)) {
		if (!empty($action_link['target']) && '_blank' === $action_link['target']) {
			$target_link = ' target="' . esc_attr($action_link['target']) . '"' . $rel_attr;
		} else {
			$target_link = $rel_attr; // anche senza target="_blank"
		}
	}
	?>
	<div class="canva-wp-block">
		<div class="canva-flex ">
			<div class="_info canva-width-16 canva-p-2 canva-bg-grey-lightest">
				<span class="title canva-block canva-mb-2 canva-fs-xxsmall canva-font-system canva-lh-10">Action Link</span>
				<figure class="canva-width-8 canva-m-0">
					<?php echo $default_icon; ?>
				</figure>
			</div>

			<div class="_content canva-flex-1 canva-p-4 canva-bg-white">
				<?php if (!empty($action_link) && !empty($action_link['url']) && !empty($action_link['title'])) { ?>
					<a id="<?php echo esc_attr($id); ?>"
					   class="button block canva-fs-h4 <?php echo esc_attr(is_string($className) ? $className : ''); ?>"
					   href="<?php echo esc_url($action_link['url']); ?>"<?php echo $target_link; ?>>
					   <?php echo esc_html($action_link['title']); ?>
					</a>
				<?php } else { ?>
					<span class="canva-block canva-fs-xsmall canva-lh-11">
						<?php _e('Imposta il pulsante cliccando sull\'icona della matita', 'canva-backend'); ?>
					</span>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php
} else {

	$id = $block['id'] ?? '';
	if (!empty($block['anchor'])) {
		$id = $block['anchor'];
	}

	$className = $block['className'] ?? '';
	$parent_className = '';
	$child_className  = '';

	if (!empty($className)) {
		if (false !== strpos($className, '|')) {
			$tmp = explode('|', $className);
			$parent_className = $tmp[0] ?? '';
			$child_className  = $tmp[1] ?? '';
		} else {
			$parent_className = $className;
		}
	}

	$alignment = '';
	if (!empty($block['align_text'])) {
		$alignment = 'text-' . sanitize_html_class($block['align_text']);
	}

	$action_link = get_field('action_link');

	// ✅ anche qui aggiungiamo sempre rel nofollow
	$target_link = '';
	if (!empty($action_link)) {
		if (!empty($action_link['target']) && '_blank' === $action_link['target']) {
			$target_link = ' target="' . esc_attr($action_link['target']) . '"' . $rel_attr;
		} else {
			$target_link = $rel_attr;
		}
	}

	$button_mode = get_field('button_mode');
	$button = (isset($button_mode) && !$button_mode) ? '' : 'button';

	$hollow = get_field('hollow_mode') ? 'hollow' : '';
	$full_width_mode = get_field('full_width_mode') ? 'w-full' : '';

	if (!empty($action_link) && !empty($action_link['url']) && !empty($action_link['title'])) :
		?>
		<div id="<?php echo esc_attr($id); ?>"
			 class="_action-link <?php echo esc_attr($parent_className); ?> <?php echo esc_attr($alignment); ?>">

			<?php
			echo canva_get_action_link([
				'url'                   => esc_url($action_link['url']),
				'target'                => $target_link, // contiene già rel
				'button'                => esc_attr(trim($button . ' ' . $hollow . ' ' . $full_width_mode . ' ' . $child_className)),
				'icon'                  => intval(get_field('icon')),
				'icon_css_classes'      => esc_attr(get_field('icon_css_classes')),
				'icon_right'            => (bool) get_field('icon_right'),
				'toptitle'              => get_field('toptitle'),
				'toptitle_css_classes'  => esc_attr(get_field('toptitle_css_classes')),
				'title'                 => esc_html($action_link['title']),
				'title_css_classes'     => esc_attr(get_field('title_css_classes')),
				'subtitle'              => esc_html(get_field('subtitle')),
				'subtitle_css_classes'  => esc_attr(get_field('subtitle_css_classes')),
			]);
			?>
		</div>
		<?php
	endif;
}
