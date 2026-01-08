<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

if (get_post_type() == 'prodotto') {
	$post_id = get_field('famiglia', $post_id);
}
?>

<?php if (get_field('manuale_pdf', $post_id) || get_field('scheda_tecnica_pdf', $post_id) || get_field('scheda_di_sicurezza_pdf', $post_id) || get_field('certificati_pdf', $post_id)) : ?>
	<div id="<?php echo esc_attr($anchor_name); ?>" class="_documenti _main__section py-0">
		<div class="wp-block-columns border-t border-black py-12">
			<div class="wp-block-column col-span-12">
				<h3 class="">Risorse</h3>
			</div>

			<div class="wp-block-column col-span-12 lg:col-span-10 grid grid-cols-2 lg:grid-cols-4 mt-8">
				<?php if (get_field('manuale_pdf', $post_id)) : ?>
					<a href="<?php echo esc_url(get_field('manuale_pdf', $post_id)); ?>" target="_blank">
						<div>
							<div class="_icon w-10">
								<figure>
									<img src="https://crl.dadostudio.com/wp-content/uploads/2022/11/Manuale.svg" alt="">
								</figure>
							</div>
							<p class="| v-r mt-4 fs-xs text-black">Manuale</p>
						</div>
					</a>
				<?php endif; ?>
				<?php if (get_field('scheda_tecnica_pdf', $post_id)) : ?>
					<a href="<?php echo esc_url(get_field('scheda_tecnica_pdf', $post_id)); ?>" target="_blank">
						<div>
							<div class="_icon w-10">
								<figure>
									<img src="https://www.coral.eu/wp-content/uploads/2024/04/download-pdf-icon.webp" alt="">
								</figure>
							</div>
							<p class="| v-r mt-4 fs-xs text-black">Scheda tecnica</p>
						</div>
					</a>
				<?php endif; ?>
				<?php if (get_field('scheda_di_sicurezza_pdf', $post_id)) : ?>
					<a href="<?php echo esc_url(get_field('scheda_di_sicurezza_pdf', $post_id)); ?>" target="_blank">
						<div>
							<div class="_icon w-10">
								<figure>
									<img src="https://crl.dadostudio.com/wp-content/uploads/2022/11/Scheda-di-sicurezza.svg" alt="">
								</figure>
							</div>
							<p class="| v-r mt-4 fs-xs text-black">Scheda di sicurezza</p>
						</div>
					</a>
				<?php endif; ?>
				<?php if (get_field('certificati_pdf', $post_id)) : ?>
					<a href="<?php echo esc_url(get_field('certificati_pdf', $post_id)); ?>" target="_blank">
						<div>
							<div class="_icon w-10">
								<figure>
									<img src="https://crl.dadostudio.com/wp-content/uploads/2022/11/Certificato-di-conformita.svg" alt="">
								</figure>
							</div>
							<p class="| v-r mt-4 fs-xs text-black">Certificati di conformità</p>
						</div>
					</a>
				<?php endif; ?>
			</div>

		</div>
	</div>
<?php endif; ?>
