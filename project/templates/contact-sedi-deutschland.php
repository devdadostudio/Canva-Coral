<?php
?>
<div class="wp-block-columns border-t border-black pt-6">

  <div class="wp-block-column col-span-12 lg:col-span-4">
    <p><strong>Coral GmbH</strong></p>
    <p><strong>Progettazione</strong></p>
    <p><strong>Vendita</strong></p>
    <p><strong>Assistenza</strong></p>
  </div>

  <div class="wp-block-column col-span-12 lg:col-span-8">

    <?php
    $sedi = [
      [
        'titolo' => 'Coral GmbH',
        'indirizzo' => 'Am Alten Schafstall 3-5',
        'citta' => 'Leverkusen',
        'provincia' => '51373',
        'telefono' => '+49.214.312.663.20',
      ],
    ];
    ?>

    <?php foreach ($sedi as $sede): ?>
      <div class="wp-block-columns mt-4 pb-4 border-b border-gray-200">
        <ul class="wp-block-column menu-v col-span-12 md:col-span-7">
          <li class="fw-700"><?php echo esc_html($sede['titolo']); ?></li>
          <li><?php echo esc_html($sede['indirizzo']); ?></li>
        </ul>
        <ul class="wp-block-column menu-v col-span-12 md:col-span-5">
          <li>
            <?php echo esc_html($sede['citta']); ?>
            (<?php echo esc_html($sede['provincia']); ?>)
          </li>
          <li>
            <a href="tel:<?php echo esc_attr($sede['telefono']); ?>">
              <?php echo esc_html($sede['telefono']); ?>
            </a>
          </li>
        </ul>
      </div>
    <?php endforeach; ?>

  </div>
</div>
