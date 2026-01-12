<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

$args = [
	'taxonomy' => 'localita_sede',
	'hide_empty' => true,
	'orderby' => 'term_order',
	'parent' => 0
];

$terms = get_terms($args);
?>

<div class="_sedi-box wp-block-columns">
	<div class="wp-block-column col-span-12">

		<!-- Continenti -->
		<?php foreach ($terms as $term) : ?>
			<div class="_sedi-wrap _accordion _free-mode border-b border-black">

				<div class="_continente-title-wrap _accordion-title-wrap flex items-center group transition-colors">
					<div class="_sedi-title flex-1 py-4">
						<h3 class="fs-h5 fw-700 mb-0 cursor-pointer"><?php echo canva_get_term_name($term->term_id); ?></h3>
					</div>
					<div class="_accordion-icon"></div>
				</div>

				<div class="_sedi-content _accordion-content flex flex-col pl-8" style="display:none;">
					<?php
					$args = [
						'taxonomy' => 'localita_sede',
						'hide_empty' => true,
						'orderby' => 'term_order',
						'parent' => $term->term_id,
					];
					$child_terms = get_terms($args);
					?>

					<!-- Nazioni -->
					<?php foreach ($child_terms as $ch_term) : ?>
						<div class="_sedi-wrap _accordion _free-mode border-t border-black">

							<div class="_nazione-title-wrap _accordion-title-wrap flex items-center group transition-colors">
								<div class="_sedi-title flex-1 py-4">
									<h3 class="fs-h6 fw-700 mb-0 cursor-pointer"><?php echo canva_get_term_name($ch_term->term_id); ?></h3>
									<?php if (canva_get_term_description($ch_term->term_id)) : ?>
										<?php echo canva_get_term_description($ch_term->term_id); ?></h3>
									<?php endif; ?>
								</div>
								<div class="_accordion-icon"></div>
							</div>

							<div class="_sedi-content _accordion-content flex flex-col pl-8" style="display:none;">
								<?php
								$posts = get_posts([
									'post_type' => 'sedi',
									'facetwp' => false,
									'numberposts' => -1,
									'tax_query' => array(
										array(
											'taxonomy' => 'localita_sede',
											'field'    => 'term_id',
											'terms'    => array($ch_term->term_id),
										),
									),
								]);
								?>
								<?php foreach ($posts as $p) : ?>


									<!-- Località -->
									<div class="_sedi-wrap _accordion _free-mode border-t border-black">

										<div class="_localita-title-wrap _accordion-title-wrap flex items-center group transition-colors">
											<div class="_sedi-title flex-1 py-4">
												<h3 class="fs-h7 fw-700 mb-0 cursor-pointer">
													<?php echo get_the_title($p); ?>
													<?php
													echo
													" (" . (get_field("citta", $p) ? get_field("citta", $p) : "") .
														(get_field("provincia", $p) ? ", " . get_field("provincia", $p) : "") . ")"; ?>
												</h3>
											</div>
											<div class="_accordion-icon icon-x"></div>
										</div>

										<div class="_sedi-content _accordion-content fs-xs py-4" style="display:none;">
											<ul>
												<?php if (get_field('indirizzo_completo', $p)) : ?>
													<li class="wp-block-columns">
														<span class="wp-block-column col-span-4 hide md:block">Posizione</span>
														<span class="wp-block-column col-span-8">
															<?php echo get_field('indirizzo_completo', $p) . (get_field("citta", $p) ? ", " . get_field("citta", $p) : "") . (get_field("provincia", $p) ? ", " . get_field("provincia", $p) : "") . ", " . canva_get_term_name($ch_term->term_id); ?>
														</span>
													</li>
												<?php endif; ?>

												<?php if (get_field('telefono', $p)) : ?>
													<li class="wp-block-columns"><span class="wp-block-column col-span-4 hide md:block">Telefono</span><span class="wp-block-column col-span-8"><?php echo get_field('telefono', $p); ?></li>
												<?php endif; ?>

												<?php if (get_field('email', $p)) : ?>
													<li class="wp-block-columns"><span class="wp-block-column col-span-4 hide md:block">Email</span><span class="wp-block-column col-span-8"><?php echo get_field('email', $p); ?></li>
												<?php endif; ?>

												<?php if (get_field('sito_web', $p)) : ?>
													<li class="wp-block-columns"><span class="wp-block-column col-span-4 hide md:block">Sito web</span><span class="wp-block-column col-span-8"><?php echo get_field('sito_web', $p); ?></li>
												<?php endif; ?>
											</ul>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
