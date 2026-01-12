<?php
get_header();

if (!$post_id) {
	$post_id = get_the_ID();
}

//Inclusion: MT Page Header
echo canva_get_template('page-header', ['post_id' => $post_id, 'nav_magellan' => ['Panoramica', 'Caratteristiche generali', 'Tabella modelli', 'Accessori', 'Optional', 'Risorse'], 'no_translate' => '_no-translate']);

//Inclusion: MT Hero
echo canva_get_template('hero-famiglia', ['post_id' => $post_id]);

//Inclusion: MT tabs
echo canva_get_template('tabs-famiglia', ['post_id' => $post_id]);

//Inclusion: MT Gallery Tabella Modelli
echo canva_get_template('gallery-tabella-modelli', ['post_id' => $post_id, 'anchor_name' => 'tabella-modelli']);

//Inclusion: MT Tabella Prodotti
// echo canva_get_template('single-famiglia-tabs-tabelle-prodotti', ['post_id' => $post_id, 'tab_items' => ['dimensioni-prodotto' => 'Dimensioni prodotto', 'caratteristiche-tecniche-principali'=>'Caratteristiche tecniche principali', 'caratteristiche-gruppo-aspirante'=>'Caratteristiche gruppo aspirante']]);
echo canva_get_template('single-famiglia-tabs-tabelle-prodotti', ['post_id' => $post_id, 'tab_items' => ['caratteristiche-tecniche-principali' => 'Caratteristiche tecniche principali', 'caratteristiche-gruppo-aspirante' => 'Caratteristiche prodotto', 'dimensioni-prodotto' => 'Dimensioni prodotto']]);

//Inclusion: MT Lista Acessori
// echo canva_get_template('facetwp-lista-acessori', ['post_id' => $post_id]);

//Inclusion: MT Lista Optional
// echo canva_get_template('facetwp-lista-optional', ['post_id' => $post_id]);

//Inclusion: MT Risorse
echo canva_get_template('risorse-pdf', ['post_id' => $post_id,  'anchor_name' => 'risorse']);

//MT form famiglie inclusion
echo canva_get_template('form-famiglie', ['post_id' => $post_id]);

get_footer();
