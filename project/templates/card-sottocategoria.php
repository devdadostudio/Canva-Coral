<?php
if (!defined('ABSPATH')) { exit; }

/**
 * Card sottocategoria per tassonomie custom (CPT UI)
 * Variabili attese:
 * - $term (WP_Term)
 */

if (!isset($term) || !($term instanceof WP_Term)) {
	return;
}

$term_link = get_term_link($term);
if (is_wp_error($term_link)) {
	return;
}

/**
 * IMMAGINE TERMINE
 * Ordine di ricerca:
 * 1) canva_get_term_featured_img_id($term)  <-- stessa immagine della hero
 * 2) ACF immagine sul termine (chiave configurabile)
 * 3) ACF legacy key "taxonomy_termId" e "term_termId"
 * 4) Term meta candidati (se qualche plugin salva lì l'ID)
 * 5) Placeholder
 */

// 0) nome del campo ACF immagine (se lo usi come fallback)
$acf_image_field_name = 'immagine_categoria';

$img_id = 0;

// 1) helper del tema (hero)
if (function_exists('canva_get_term_featured_img_id')) {
	$maybe = (int) canva_get_term_featured_img_id($term);
	if ($maybe > 0) {
		$img_id = $maybe;
	}
}

// 2) ACF diretto sul termine
if (!$img_id && function_exists('get_field')) {
	$acf_img = get_field($acf_image_field_name, $term);
	if (is_array($acf_img) && !empty($acf_img['ID'])) {
		$img_id = (int) $acf_img['ID'];
	} elseif (is_numeric($acf_img) && (int) $acf_img > 0) {
		$img_id = (int) $acf_img;
	}

	// 3) ACF legacy keys
	if (!$img_id) {
		$acf_img_legacy = get_field($acf_image_field_name, $term->taxonomy . '_' . $term->term_id);
		if (is_array($acf_img_legacy) && !empty($acf_img_legacy['ID'])) {
			$img_id = (int) $acf_img_legacy['ID'];
		} elseif (is_numeric($acf_img_legacy) && (int) $acf_img_legacy > 0) {
			$img_id = (int) $acf_img_legacy;
		}
	}
	if (!$img_id) {
		$acf_img_legacy2 = get_field($acf_image_field_name, 'term_' . $term->term_id);
		if (is_array($acf_img_legacy2) && !empty($acf_img_legacy2['ID'])) {
			$img_id = (int) $acf_img_legacy2['ID'];
		} elseif (is_numeric($acf_img_legacy2) && (int) $acf_img_legacy2 > 0) {
			$img_id = (int) $acf_img_legacy2;
		}
	}
}

// 4) Term meta candidati (numerici o array ACF-like)
if (!$img_id) {
	$meta_candidates = [
		'thumbnail_id',
		'image',
		'term_image',
		'immagine_categoria',
		'featured_image',
		'cover_image',
	];
	foreach ($meta_candidates as $mk) {
		$maybe = get_term_meta($term->term_id, $mk, true);
		if (is_array($maybe) && !empty($maybe['ID'])) {
			$img_id = (int) $maybe['ID'];
			break;
		}
		if (is_numeric($maybe) && (int) $maybe > 0) {
			$img_id = (int) $maybe;
			break;
		}
	}
}

// 5) Placeholder
$fallbackID   = function_exists('canva_get_no_image_id') ? (int) canva_get_no_image_id() : 0;
$final_img_id = $img_id ?: $fallbackID;

/**
 * DESCRIZIONE
 * ACF 'descrizione_principale' (term) -> legacy keys -> description nativa
 */
$desc = '';
if (function_exists('get_field')) {
	$desc = get_field('descrizione_principale', $term);
	if (!$desc) $desc = get_field('descrizione_principale', $term->taxonomy . '_' . $term->term_id);
	if (!$desc) $desc = get_field('descrizione_principale', 'term_' . $term->term_id);
}
if (!$desc && !empty($term->description)) {
	$desc = $term->description;
}

if (function_exists('canva_get_trimmed_content')) {
	$desc_trim = canva_get_trimmed_content($desc, $trim_words = 20, $strip_blocks = false, $strip_shortcode = true);
} else {
	$desc_trim = wp_trim_words(wp_strip_all_tags($desc), 20, '…');
}
?>
<a href="<?php echo esc_url($term_link); ?>">
	<div class="_card _card-macro-famiglia border border-gray-200 group flex md:flex-col">
		<div class="_card-figure w-1/3 md:w-full">
			<div class="relative ratio-1-1 md:ratio-3-2 overflow-hidden bg-gray-50">
				<?php
				if ($final_img_id) {
					echo wp_get_attachment_image(
						$final_img_id,
						'640-free', // coerente con le macrofamiglie; usa 'large' se non esiste
						false,
						[
							'class'    => 'absolute w-full h-full p-4 object-contain object-center transform-gpu a-transition group-hover:scale-105',
							'loading'  => 'lazy',
							'decoding' => 'async',
						]
					);
				} else {
					echo '<span class="absolute inset-0 flex items-center justify-center text-sm opacity-60 px-3">Nessuna immagine</span>';
				}
				?>
			</div>
		</div>

		<div class="_card-info flex-1 p-8 lg:pt-0 lg:px-12">
			<h3 class="_title _no-translate h4 fw-700 mb-4 break-all">
				<?php echo esc_html($term->name); ?>
			</h3>

			<?php if (!empty($desc_trim)) : ?>
				<p class="line-clamp-3 fs-xs mb-4">
					<?php echo esc_html(wp_strip_all_tags($desc_trim)); ?>
				</p>
			<?php endif; ?>

			<span class="v-r fs-xs block md:inline-block mt-2">Scopri</span>
		</div>
	</div>
</a>
