<?php
?>
<div class="wp-block-columns border-t border-black pt-6">

  <div class="wp-block-column col-span-12 lg:col-span-4">
    <p><strong>Coral France</strong></p>
    <p><strong>Progettazione</strong></p>
    <p><strong>Vendita</strong></p>
    <p><strong>Assistenza</strong></p>
  </div>

  <div class="wp-block-column col-span-12 lg:col-span-8">

    <?php
    $sedi = [
      [
        'titolo' => 'Coral SA Paris',
        'indirizzo' => '3 Rue Henri Dunant – ZA Des Bordes 91070',
        'citta' => 'Bondoufle',
        'provincia' => 'Paris',
        'telefono' => '+33 1 60 86 80 69',
      ],
      [
        'titolo' => 'Coral SA Lyon',
        'indirizzo' => '75, Rue De Malacombe 38070',
        'citta' => 'Saint Quentin Fallavier',
        'provincia' => 'Lyon',
        'telefono' => '+33 4 74 944 562',
      ],
      [
        'titolo' => 'Coral SA Poitiers',
        'indirizzo' => '20 Bis Rue des Entrepreneurs, 86000',
        'citta' => 'Poitiers',
        'provincia' => 'Poitiers',
        'telefono' => '+33 5 49 379 596',
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
