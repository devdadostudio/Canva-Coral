<?php
?>
<div class="wp-block-columns border-t border-black pt-6">

  <div class="wp-block-column col-span-12 lg:col-span-4">
    <p><strong>Coral Engineering srl</strong></p>
    <p><strong>Progettazione</strong></p>
  </div>

  <div class="wp-block-column col-span-12 lg:col-span-8">

    <?php
    $sedi = [
      [
        'titolo' => 'Coral Torino',
        'indirizzo' => 'Corso Europa, 597 10088',
        'citta' => 'Volpiano',
        'provincia' => 'Torino',
        'telefono' => '+39 011 99 80 141',
      ],
      [
        'titolo' => 'Coral Milano',
        'indirizzo' => 'Via Venezia, 4/6 20060',
        'citta' => 'Trezzano Rosa',
        'provincia' => 'Milano',
        'telefono' => '+39 02 95301003',
      ],
      [
        'titolo' => 'Coral Vicenza',
        'indirizzo' => 'Via Retrone 66/6 36077',
        'citta' => 'Altavilla Vicentina',
        'provincia' => 'Vicenza',
        'telefono' => '+39 0444 349398',
      ],
      [
        'titolo' => 'Coral Bologna',
        'indirizzo' => 'Via Enzo Ferrari, 2/1 40064',
        'citta' => 'Ozzano dell’Emilia',
        'provincia' => 'Bologna',
        'telefono' => '+39 051 6926335',
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
