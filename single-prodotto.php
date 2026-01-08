<?php
get_header();

$post_id = get_the_ID();

//Inclusion: MT Page Header
echo canva_get_template('page-header', ['post_id' => $post_id, 'nav_magellan' => ['Panoramica', 'Tabella modelli', 'Documenti', 'Caratteristiche Generali'], 'no_translate' => '_no-translate']);

//Inclusion: MT Hero
echo canva_get_template('hero-prodotto', ['post_id' => $post_id]);


//Inclusion: MT Gallery Tabella Modelli
echo canva_get_template('gallery-tabella-modelli', ['post_id' => get_field('famiglia', $post_id), 'anchor_name' => 'tabella-modelli']);

//Inclusion: MT Tabella Prodotti
echo canva_get_template('single-prodotto-tabella-caratteristiche-tecniche-principali', ['post_id' => $post_id]);
echo canva_get_template('single-prodotto-tabella-caratteristiche-gruppo-aspirante', ['post_id' => $post_id]);
echo canva_get_template('single-prodotto-tabella-dimensioni-prodotto', ['post_id' => $post_id]);

//Inclusion: MT Lista Acessori
echo canva_get_template('facetwp-lista-acessori', ['post_id' => $post_id]);

//Inclusion: MT Lista Optional
echo canva_get_template('facetwp-lista-optional', ['post_id' => $post_id]);

//Inclusion: MT Risorse
echo canva_get_template('risorse-pdf', ['post_id' => $post_id,  'anchor_name' => 'documenti']);

//Inclusion: MT tabs
echo canva_get_template('tabs-prodotto', ['post_id' => $post_id]);

//MT form prodotto inclusion
echo canva_get_template('form-prodotto', ['post_id' => $post_id]);

get_footer();
