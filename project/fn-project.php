<?php
defined('ABSPATH') || exit;

// add_action('template_redirect', function () {
// 	ob_start();
// });

//////////////////////////////////////////////////////////////////////////////////////////
// Required files
// Acf fields for theme stuff
// require_once 'cpt-register.php';
require_once 'acf-fields-project.php';

if (is_woocommerce_activated()) {
	require_once 'fn-woocommerce.php';
	require_once 'fn-woocommerce-checkout.php';
	require_once 'fn-woocommerce-gettext.php';
}

if (is_facetwp_activated()) {
	// require_once 'facetwp-proximity-primo.php';
	require_once 'fn-facetwp.php';
}

require_once 'fn-restapi.php';
require_once 'fn-wpallimport.php';
require_once 'fn-breadcrumbs.php';

//////////////////////////////////////////////////////////////////////////////////////////


// BACKEND


if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title'    => 'String Translate',
		'menu_title'    => 'String Translate',
		'menu_slug'     => 'string-translate',
		'capability'    => 'edit_posts',
		'redirect'      => false
	));
}


/**
 * modifica il placeholder titolo quando per post type
 *
 * @param [type] $title
 * @return void
 */
function change_default_title($title)
{
	$screen = get_current_screen();

	if ('case-history' == $screen->post_type) {
		$title = 'Aggiungi una Case History';
	}

	if ('sedi' == $screen->post_type) {
		$title = 'Aggiungi una sede';
	}

	if ('macrofamiglia' == $screen->post_type) {
		$title = 'Aggiungi una macro famiglia';
	}

	if ('famiglia' == $screen->post_type) {
		$title = 'Aggiungi una famiglia';
	}

	if ('prodotto' == $screen->post_type) {
		$title = 'Aggiungi un prodotto';
	}

	return $title;
}
add_filter('enter_title_here', 'change_default_title');





// FRONTEND


function product_schema_json_ld()
{

	$logo = canva_get_img([
		'img_id' => get_field('logo_light_mode', 'options')['img'],
		'img_type' => 'url', // img, bg, url
		'thumb_size' => 'full',
	]);

	$json_organization = '<script id="organization-schema-json" type="application/ld+json">
	{
        "@context":"https:\/\/schema.org",
        "@type":"Organization",
        "name":"' . do_shortcode('[company_name]') . '",
        "url":"' . home_url() . '",
		"address": {
			"@type": "PostalAddress",
			"addressLocality": "' . do_shortcode('[company_city]') . '",
			"postalCode": "' . do_shortcode('[company_zippostal_code]') . '",
			"streetAddress": "' . do_shortcode('[company_address]') . '"
		},
        "ContactPoint":{
            "@type":"ContactPoint",
            "contactType":"customer support",
            "telephone":"' . do_shortcode('[company_phone]') . '",
            "email":"' . do_shortcode('[company_email]') . '",
            "areaServed":["IT"],
            "availableLanguage":["Italian"]
        },
        "logo":{
            "@type":"ImageObject",
            "url":"' . $logo . '",
            "width":406,
            "height":324
		},
            "sameAs":[
                "' . get_field('facebook', 'options') . '",
                "' . get_field('instagram', 'options') . '",
                "' . get_field('linkedin', 'options') . '",
                "' . get_field('youtube', 'options') . '"
            ]
	}
	</script>';

	echo $json_organization;

	if (get_post_type() == 'macrofamiglia' || get_post_type() == 'famiglia') {
		$macro_fam_img = canva_get_img([
			'img_id' => get_the_ID(),
			'img_type' => 'url', // img, bg, url
			'thumb_size' => 'full', // img, bg, url
		]);

		$json = '<script id="product-schema-json" type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Product",
			"description": "' . wp_strip_all_tags(get_field('descrizione_principale', get_the_ID())) . '",
			"name": "' . get_the_title(get_the_ID()) . '",
			"image": "' . $macro_fam_img . '",
                        "offers": {
                            "@type": "Offer",
                            "priceCurrency": "EUR",
                            "price": "0.00",
                            "availability": "https://schema.org/InStock",
                            "url": "' . get_permalink(get_the_ID()) . '"
                          }

		  }
                </script>';

		echo $json;
	}
}
add_action('wp_head', 'product_schema_json_ld', PHP_INT_MAX);


function change_string($string)
{
	$string = trim($string);
	$strpos = strpos($string, " ");
	$new_string = "";

	if ($strpos !== false) {
		$new_string = "";
		for ($i = 0; $i < strlen($string); $i++) {
			$new_string .= ($i > 0 && $i < $strpos) ? strtolower($string[$i]) : $string[$i];
		}
	} else {
		$new_string = ucfirst(strtolower($string));
	}
	return $new_string;
}

add_filter('the_title', function ($title, $id) {
	if (!is_admin()) {
		if ('macrofamiglia' == get_post_type($id) || 'famiglia' == get_post_type($id) || 'prodotto' == get_post_type($id)) {
			$title = change_string($title);
			return $title;
		} else {
			return $title;
		}
	} else {
		return $title;
	}
}, 10, 2);


function coral_ajax_term_header()
{

	if (isset($_GET['term_slug']) && ('' != trim($_GET['term_slug']))) {
		$term_slug = esc_attr($_GET['term_slug']);
	} elseif (isset($_POST['term_slug']) && '' != trim($_POST['term_slug'])) {
		$term_slug = esc_attr($_POST['term_slug']);
	} elseif (isset($_REQUEST['term_slug']) && '' != trim($_REQUEST['term_slug'])) {
		$term_slug = esc_attr($_REQUEST['term_slug']);
	}

	if (isset($_GET['taxonomy']) && ('' != trim($_GET['taxonomy']))) {
		$taxonomy = esc_attr($_GET['taxonomy']);
	} elseif (isset($_POST['taxonomy']) && '' != trim($_POST['taxonomy'])) {
		$taxonomy = esc_attr($_POST['taxonomy']);
	} elseif (isset($_REQUEST['taxonomy']) && '' != trim($_REQUEST['taxonomy'])) {
		$taxonomy = esc_attr($_REQUEST['taxonomy']);
	}


	if (isset($term_slug)) {
		$term = get_term_by('slug', $term_slug, $taxonomy);
		echo canva_get_template('ajax-term-description', ['term_id' => $term->term_id]);
	} else {
		echo canva_get_template('ajax-term-description', ['term_id' => ""]);
	}

	wp_die();
}
add_action('wp_ajax_coral_ajax_term_header', 'coral_ajax_term_header');
add_action('wp_ajax_nopriv_coral_ajax_term_header', 'coral_ajax_term_header');


function dimensioni_prodotto()
{
	$dimensioni = [
		"superficie_dappoggio_mq" => "Superficie d'appoggio (mq)",
		"superficie_dappoggio_con_parete_frontale_mq" => "Superficie d'appoggio con parete frontale (mq)",
		"diametro_mm" => "Diametro (mm)",
		"lunghezza_mm" => "Lunghezza (mm)",
		"lunghezza_minima_mm" => "Lunghezza minima (mm)",
		"altezza_mm" => "Altezza (mm)",
		"larghezza_mm" => "Larghezza (mm)",
		"profondita_mm" => "Profondità (mm)",
		"altezza_utile_mm" => "Altezza utile (mm)",
		"a1_mm" => "A1 (mm)",
		"a_mm" => "A (mm)",
		"b_mm" => "B (mm)",
		"c_mm" => "C (mm)",
		"d_mm" => "D (mm)",
		"e_mm" => "E (mm)",
		"d_gradi" => "D (gradi)",
		"e_gradi" => "E (gradi)",
		"f_mm" => "F (mm)",
		"g_mm" => "G (mm)",
		"h_mm" => "H (mm)",
		"h1_mm" => "H1 (mm)",
		"h2_mm" => "H2 (mm)",
		"h3_mm" => "H3 (mm)",
		"h4_mm" => "H4 (mm)",
		"i_mm" => "I (mm)",
		"j_mm" => "J (mm)",
		"k_mm" => "K (mm)",
		"l_mm" => "L (mm)",
		"m_mm" => "M (mm)",
		"n_mm" => "N (mm)",
		"o_mm" => "O (mm)",
		"p_mm" => "P (mm)",
		"q_mm" => "Q (mm)",
		"r_mm" => "R (mm)",
		"s_mm" => "S (mm)",
		"t_mm" => "T (mm)",
		"u_mm" => "U (mm)",
		"x_mm" => "X (mm)",
		"y_mm" => "Y (mm)",
		"posizione_lavoro_a_mm" => "Posizione lavoro A (mm)",
		"posizione_lavoro_b_mm" => "Posizione lavoro B (mm)",
		"posizione_lavoro_c_mm" => "Posizione lavoro C (mm)",
		"posizione_lavoro_d" => "Posizione lavoro D (°)",
		"posizione_lavoro_e" => "Posizione lavoro E (°)",
		"braccio_aperto_a_mm" => "Braccio aperto A (mm)",
		"braccio_aperto_b_mm" => "Braccio aperto B (mm)",
		"braccio_aperto_c_mm" => "Braccio aperto C (mm)",
		"braccio_aperto_d" => "Braccio aperto D (°)",
		"braccio_aperto_e" => "Braccio aperto E (°)",
		"braccio_chiuso_a_mm" => "Braccio chiuso A (mm)",
		"braccio_chiuso_b_mm" => "Braccio chiuso B (mm)",
		"braccio_chiuso_c_mm" => "Braccio chiuso C (mm)",
		"braccio_chiuso_d" => "Braccio chiuso D",
		"braccio_chiuso_e" => "Braccio chiuso E",
		"braccio_chiuso_f_mm" => "Braccio chiuso F (mm)",
		"canalizzazione_mm" => "Canalizzazione (mm)",
		"mandata_mm" => "Mandata (mm)",
		"tipologia_misura" => "Tipologia misura",
		"peso_kg" => "Peso (kg)",
		"altezza_filtro_mm" => "Altezza filtro (mm)",
		"diametro_filtro_mm" => "Diametro filtro (mm)",
	];

	return $dimensioni;
}
function caratteristiche_principali()
{
	$caratteristiche_principali = [
		"tipo_filtro" => "Tipo Filtro",
		"versione" => "Versione",
		"moduli" => "Moduli",
		"configurazione" => "Configurazione",
		"pannellato" => "Pannellato",
		"finitura" => "Finitura",
		"classe_di_protezione_ip" => "Classe di protezione (IP)",
		"atex" => "Atex",
		"motore_atex" => "Motore Atex",
		"classificazione_polveri" => "Classificazione polveri",
		"flap_antiritorno" => "Flap antiritorno",
		"sistema_di_sfogo_esplosione" => "Sistema di sfogo esplosione",
		"classificazione_filtro_atex" => "Classificazione filtro Atex",
		"area_di_installazione" => "Area di installazione",
		"stringa_atex" => "Stringa Atex",
		"pannelli_antiscoppio_nr" => "Pannelli antiscoppio (nr.)",
		"pannelli_antiscoppio_mm" => "Pannelli antiscoppio (mm)",
		"cartucce_nr" => "Cartucce (nr)",
		"altezza_cartucce_mm" => "Altezza cartucce (mm)",
		"diametro_cartucce_mm" => "Diametro cartucce (mm)",
		"pieghi_cartucce" => "Pieghi cartucce",
		"maniche_totali_nr" => "Maniche totali (nr)",
		"maniche_nr" => "Maniche (nr)",
		"maniche_ribassate_nr" => "Maniche ribassate (nr)",
		"altezza_maniche_mm" => "Altezza maniche (mm)",
		"altezza_maniche_ribassate_mm" => "Altezza maniche ribassate (mm)",
		"diametro_maniche_mm" => "Diametro maniche (mm)",
		"sacche_nr" => "Sacche (nr)",
		"altezza_sacche_mm" => "Altezza sacche (mm)",
		"diametro_sacche_mm" => "Diametro sacche (mm)",
		"capacita_sacche_m3" => "Capacità sacche (m3)",
		"materiale_filtro" => "Materiale filtro",
		"prefiltro" => "Prefiltro",
		"cartucce_a_carboni_attivi" => "Cartucce a carboni attivi",
		"peso_carboni_attivi_kg" => "Peso carboni attivi (kg)",
		"volume_carboni_attivi_m3" => "Volume carboni attivi (m3)",
		"letti_nr" => "Letti (nr.)",
		"spessore_letto_mm" => "Spessore letto (mm)",
		"superficie_specifica_carboni_attivi_m2g" => "Superficie specifica carboni attivi (m2/g)",
		"separatore_di_gocce" => "Separatore di gocce",
		"classificazione_ifabgia" => "Classificazione IFA/BGIA",
		"filtro_intermedio" => "Filtro intermedio",
		"filtro_assoluto" => "Filtro assoluto",
		"ventilatore" => "Ventilatore",
		"pressione_ventilatore_pa" => "Pressione ventilatore (Pa)",
		"potenza_ventilatore_hp" => "Potenza ventilatore (HP)",
		"potenza_ventilatore_kw" => "Potenza ventilatore (kW)",
		"pompa" => "Pompa",
		"potenza_pompa_hp" => "Potenza pompa (HP)",
		"potenza_pompa_kw" => "Potenza pompa (kW)",
		"efficienza" => "Efficienza (%)",
		"velocita_di_attraversamento_ms" => "Velocità di attraversamento (m/s)",
		"tempo_di_contatto_s" => "Tempo di contatto (s)",
		"pannello_di_comando" => "Pannello di comando",
		"pulizia" => "Pulizia",
		"durata_pulizia_min" => "Durata pulizia (min)",
		"motovibratori_nr" => "Motovibratori (nr.)",
		"potenza_motovibratore_a_50_hz_kw" => "Potenza motovibratore a 50 HZ (kW)",
		"potenza_motovibratore_a_60_hz_kw" => "Potenza motovibratore a 60 HZ (kW)",
		"valvole" => "Valvole",
		"elettrovalvole" => "Elettrovalvole",
		"voltaggio_v" => "Voltaggio (V)",
		"frequenza_hz" => "Frequenza (Hz)",
		"alimentazione_elettrica" => "Alimentazione elettrica",
		"assorbimento_elettrico_a" => "Assorbimento elettrico (A)",
		"energia_elettrostatica_w" => "Energia elettrostatica (W)",
		"capacita_lt" => "Capacità (lt)",
		"valvola_stellare" => "Valvola stellare",
		"portata_valvola_stellare_m3h" => "Portata valvola stellare (m3/h)",
		"capacita_effettiva_valvola_stellare_m3h" => "Capacità effettiva valvola stellare (m3/h)",
		"potenza_valvola_stellare_kw" => "Potenza valvola stellare (kW)",
		"coefficiente_di_riempimento_valvola_stellare" => "Coefficiente di riempimento valvola stellare",
		"dimensioni_valvola_stellare_mm_x_mm" => "Dimensioni valvola stellare (mm x mm)",
		"capacita_scaricamento_valvola_stellare_lh" => "Capacità scaricamento valvola stellare (l/h)",
		"nr_serbatoi" => "Nr. Serbatoi",
		"volume_serbatoi_lt" => "Volume Serbatoi (lt)",
		"pressione_serbatoio_bar" => "Pressione serbatoio (bar)",
		"volume_daria_lt" => "Volume d'aria (lt)",
		"capacita_di_contenimento_m3" => "Capacità di contenimento (m3)",
		"carico_massimo_kgm2" => "Carico massimo (kg/m2)",
		"velocita_di_trasporto_in_tubazione_ms" => "Velocità di trasporto in tubazione (m/s)",
		"velocita_di_trasporto_polveri_metalliche_in_tubazione_ms" => "Velocità di trasporto polveri metalliche in tubazione (m/s)",
		"bricchettatrice" => "Bricchettatrice",
		"potenza_bricchettatrice_kw" => "Potenza bricchettatrice (kW)",
		"diametro_bricchetti_mm" => "Diametro bricchetti (mm)",
		"capacita_di_scaricamento_kgh" => "Capacità di scaricamento (kg/h)",
		"snodi" => "Snodi",
		"cappa" => "Cappa",
		"precamere" => "Precamere",
		"oblo_di_ispezione" => "Oblò di ispezione",
		"porte_di_manutenzione" => "Porte di manutenzione",
		"silenziatore_di_flusso" => "Silenziatore di flusso",
	];

	return $caratteristiche_principali;
}

function gruppi_aspiranti()
{
	$gruppi_aspiranti = [
		"superficie_filtrante_mq" => "Superficie filtrante (mq)",
		"portata_massima_m3h" => "Portata massima (m3/h)",
		"portata_massima_cfm" => "Portata massima (cfm)",
		"portata_nominale_m3h" => "Portata nominale (m3/h)",
		"portata_nominale_cfm" => "Portata nominale (cfm)",
		"portata_massima_polveri_metalliche_e_fumi_m3h" => "Portata massima polveri metalliche e fumi (m3/h)",
		"portata_massima_polveri_metalliche_e_fumi_cfm" => "Portata massima polveri metalliche e fumi (cfm)",
		"portata_massima_levigatura_e_polveri_fini_m3h" => "Portata massima levigatura e polveri fini (m3/h)",
		"portata_massima_levigatura_e_polveri_fini_cfm" => "Portata massima levigatura e polveri fini (cfm)",
		"portata_massima_segatura_e_trucioli_m3h" => "Portata massima segatura e trucioli (m3/h)",
		"portata_massima_segatura_e_trucioli_cfm" => "Portata massima segatura e trucioli (cfm)",
		"giri_rpm" => "Giri (rpm)",
		"potenza_kw" => "Potenza (kW)",
		"potenza_hp" => "Potenza (HP)",
		"potenza_db" => "Potenza sonora (HP)",
		"poli" => "Poli",
		"pressione_totale_mmh2o" => "Pressione totale (mmH2O)",
		"pressione_totale_pt_pa" => "Pressione totale (PT Pa)",
		"pressione_di_esercizio_bar" => "Pressione di esercizio (bar)",
		"depressione_massima_mbar" => "Depressione massima (mBar)",
		"pressione_statica_nominale_pa" => "Pressione statica nominale (Pa)",
		"pressione_aria_cilindri_atm" => "Pressione aria cilindri (atm)",
		"pressione_soffiaggio_filtri_atm" => "Pressione soffiaggio filtri (atm)",
		"perdita_di_carico_pa" => "Perdita di carico (Pa)",
		"perdita_utile_statica_mmh2o" => "Perdita utile statica (mmH2O)",
		"perdita_utile_statica_-_polveri_metalliche_mmh2o" => "Perdita utile statica - polveri metalliche (mmH2O)",
		"prevalenza_mbar" => "Prevalenza (mBar)",
		"prevalenza_massima_mmh2o" => "Prevalenza massima (mmH2O)",
		"prevalenza_a_800_m3h_mmh2o" => "Prevalenza a 800 m3/h (mmH2O)",
		"rumorosita_dba" => "Rumorosità (db(A))",
		"rumorosita_con_plenum_insonorizzato_dba" => "Rumorosità con plenum insonorizzato (db(A))",
		"nr_ingressi" => "Nr. ingressi",
		"ingresso_mm" => "Ingresso (mm)",
		"diametro_raccordo_mm" => "Diametro raccordo (mm)",
		"diametro_raccordo_polveri_metalliche_mm" => "Diametro raccordo polveri metalliche (mm)",
		"nr_uscite" => "Nr. uscite",
		"uscita_mm" => "Uscita (mm)",
		"bracci_ammessi" => "Bracci ammessi",
		"bracci_ammessi_polveri_metalliche" => "Bracci ammessi (polveri metalliche)",
		"diametro_bracci_mm" => "Diametro bracci (mm)",
		"portata_massima_bracci_m3h" => "Portata massima bracci (m3/h)",
		"portata_massima_bracci_cfm" => "Portata massima bracci (cfm)",
		"temperatura_di_esercizio_c" => "Temperatura di esercizio (C°)",
		"potenza_termica_dt_40c_kw" => "Potenza termica DT 40°C (kW)",
		"potenza_termica_dt_40c_kcalh" => "Potenza termica DT 40°C (Kcal/h)",
		"potenza_termica_dt_30c_kw" => "Potenza termica DT 30°C (kW)",
		"potenza_termica_dt_30c_kcalh" => "Potenza termica DT 30°C (Kcal/h)",
		"potenza_termica_dt_20c_kw" => "Potenza termica DT 20°C (kW)",
		"potenza_termica_dt_20c_kcalh" => "Potenza termica DT 20°C (Kcal/h)",
		"dt_h2o_c" => "DT H2O (°C)",
		"portata_h2o_dt_40c_m3h" => "Portata H2O DT 40°C (m3/h)",
		"portata_h2o_dt_30c_m3h" => "Portata H2O DT 30°C (m3/h)",
		"portata_h2o_dt_20c_m3h" => "Portata H2O DT 20°C (m3/h)",
		"attacchi_batteria_dt_40c" => "Attacchi batteria DT 40°C",
		"attacchi_batteria_dt_30c" => "Attacchi batteria DT 30°C",
		"attacchi_batteria_dt_20c" => "Attacchi batteria DT 20°C",
		"perdite_di_carico_batteria_dt_40c" => "Perdite di carico batteria DT 40°C",
		"perdite_di_carico_batteria_dt_30c" => "Perdite di carico batteria DT 30°C",
		"perdite_di_carico_batteria_dt_20c" => "Perdite di carico batteria DT 20°C",
	];

	return $gruppi_aspiranti;
}
### Redirect da vecchio sito ###
function redirect_from_old_site($lang_path = "")
{
	// HTTP status code
	$http_code = 301;

	// Requested base url
	if (strpos($_SERVER["REQUEST_URI"], "?") !== false) {
		// If has query params
		$request_uri = substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], "?"));
	} else {
		// If has not query params
		$request_uri = $_SERVER["REQUEST_URI"];
	}

	// Explode url in array with paths
	$path_exploded = explode("/", $request_uri);
	if (empty($path_exploded[0])) {
		unset($path_exploded[0]);
		$path_exploded = array_values($path_exploded);
	}

	// Last path exploded (assuming is permalink)
	$term_exploded = get_words_from_slug($path_exploded[count($path_exploded) - 1], "-");
	$term_exploded = str_replace(".asp", "", $term_exploded);

	// Requested query string
	if (!empty($_GET)) {
		// Decode each param
		foreach ($_GET as $key => $value) {
			$decoded = urldecode($value);
			$decoded = get_words_from_slug($decoded, " ");
			// Append to terms array
			$term_exploded = array_merge($term_exploded, $decoded);
		}
	}
	// Remove numbers
	$term_exploded = array_values(array_unique($term_exploded));
	for ($i = 0; $i < count($term_exploded); $i++) {
		$term_exploded[$i] = preg_replace('/[0-9]+/', '', $term_exploded[$i]);
	}
	// Add singular/plural versions of every word
	$plurals = [];
	for ($i = 0; $i < count($term_exploded); $i++) {
		$plurals = array_merge($plurals, get_plurals($term_exploded[$i]));
	}
	$singulars = [];
	for ($i = 0; $i < count($term_exploded); $i++) {
		$singulars = array_merge($singulars, get_singulars($term_exploded[$i]));
	}
	$term_exploded = array_merge($term_exploded, $plurals);
	$term_exploded = array_merge($term_exploded, $singulars);

	// Post object array
	$words = [];
	$post_types = ['categoria', 'inquinante', 'applicazione'];

	for ($k = 0; $k < count($post_types); $k++) {
		$type = get_terms(array(
			'taxonomy' => $post_types,
			'hide_empty' => false,
		));
		foreach ($type as $term) {
			$words[] = set_redirect_array_items($term);
		}
	}

	// Set the counter
	for ($i = 0; $i < count($words); $i++) {
		for ($j = 0; $j < count($term_exploded); $j++) {
			if (in_array($term_exploded[$j], $words[$i]["terms"])) {
				$words[$i]["counter"] = $words[$i]["counter"] + 1;
			}
		}
	}

	// Get the max counter
	$current_max_counter = 0;
	$matching_keys = [];
	for ($k = 0; $k < count($words); $k++) {
		if ($words[$k]["counter"] > $current_max_counter) {
			$current_max_counter = $words[$k]["counter"];
		}
	}

	// Get posts with max counter
	for ($k = 0; $k < count($words); $k++) {
		if ($words[$k]["counter"] === $current_max_counter && $current_max_counter > 0) {
			$matching_keys[$k] = count($words[$k]["terms"]);
		}
	}

	if (!empty($matching_keys)) {
		$min = min($matching_keys);
		$key = array_search($min, $matching_keys);
		$redirect_url = home_url() . "/$lang_path" . $words[$key]["link"];
	} else {
		$redirect_url = home_url() . "/$lang_path/prodotti/";
	}
	wp_redirect($redirect_url, $http_code);
}
function get_plurals($word)
{
	$words = [];
	$strings = [
		"scia" => ["sce"],
		"cia"  => ["cie", "ce"],
		"gia"  => ["gie", "ge"],
		"ca"   => ["chi", "che"],
		"ga"   => ["ghi", "ghe"],
		"co"   => ["ci", "chi"],
		"go"   => ["gi", "ghi"],
		"io"   => ["ii", "i"],
		"ìo"   => ["ii", "i"],
		"a"    => ["i", "e"],
		"e"    => ["i"],
		"o"    => ["i"]
	];
	foreach ($strings as $key => $value) {
		if (substr($word, -strlen($key)) === $key) {
			for ($i = 0; $i < count($value); $i++) {
				$words[] = substr($word, 0, strlen($word) - strlen($key)) . $value[$i];
			}
		}
	}
	return $words;
}

function get_singulars($word)
{
	$words = [];
	$strings = [
		"sce" => ["scia"],
		"cie" => ["cia"],
		"gie" => ["gia"],
		"chi" => ["ca", "co"],
		"che" => ["ca"],
		"ghi" => ["go", "ga"],
		"ghe" => ["ga"],
		"ci"  => ["co"],
		"ge"  => ["gia"],
		"ce"  => ["cia"],
		"gi"  => ["go"],
		"ii"  => ["io", "ìo"],
		"i"   => ["io", "ìo", "a", "e", "o"],
		"e"   => ["a"]
	];
	foreach ($strings as $key => $value) {
		if (substr($word, -strlen($key)) === $key) {
			for ($i = 0; $i < count($value); $i++) {
				$words[] = substr($word, 0, strlen($word) - strlen($key)) . $value[$i];
			}
		}
	}
	return $words;
}

if (is_request_from_old_site($_SERVER["REQUEST_URI"])) {
	$arg = get_old_site_lang($_SERVER["REQUEST_URI"]);
	add_action("wp_head", function () use ($arg) {
		redirect_from_old_site($arg);
	});
}

/*
 Return associative array with post infos
*/
function set_redirect_array_items($term)
{
	return [
		"link" => str_replace(home_url(), '', get_term_link($term->term_id)),
		"terms" => get_words_from_slug($term->slug, "-"),
		"counter" => 0
	];
}
/*
 Return exploded slug exluding short terms
*/
function get_words_from_slug($term_name, $separator)
{
	// Explode
	$words = explode($separator, $term_name);
	// Exclude short terms
	$words = array_filter($words, function ($word) {
		return strlen($word) > 3;
	});
	// Convert to lowercase
	$words = array_map(function ($word) {
		return strtolower($word);
	}, $words);
	// Remove duplicates
	$words = array_values(array_unique($words));
	return $words;
}

function get_langs()
{
	return [
		"italiano" => "",
		"inglese" => "en",
		"tedesco/td" => "de",
		"francese" => "fr",
		"spagnolo" => "es",
		"russo" => "en"
	];
}

/*
 Check if the url contains lang path and .asp extension
*/
function is_request_from_old_site($url)
{
	$allowed_lang = array_keys(get_langs());
	$is_from_old_site = false;

	for ($i = 0; $i < count($allowed_lang); $i++) {
		$is_from_old_site = $is_from_old_site || (strpos($url, "/" . $allowed_lang[$i] . "/") !== false);
	}

	$is_from_old_site = $is_from_old_site && (strpos($url, ".asp") !== false);
	return $is_from_old_site;
}

/*
 Get the old site language
*/
function get_old_site_lang($url)
{
	$allowed_lang = array_keys(get_langs());

	for ($i = 0; $i < count($allowed_lang); $i++) {
		if (strpos($url, "/" . $allowed_lang[$i] . "/") !== false) {
			return get_langs()[$allowed_lang[$i]];
		}
	}
	return "";
}
### Fine Redirect da vecchio sito ###

/**
 *
 *
 *
 */

if (is_wpml_activated()) {
	add_action('desktop_navigation_before', function () {
		echo canva_get_template('language-switcher', ['plugin' => 'wpml']);
	}, 1, 1);
	add_action('mobile_navigation_before', function () {
		echo canva_get_template('language-switcher', ['plugin' => 'wpml']);
	}, 1, 1);
} elseif (is_weglot_activated()) {
	add_action('desktop_navigation_before', function () {
		echo canva_get_template('language-switcher', ['plugin' => 'weglot']);
	}, 1, 1);
	add_action('mobile_navigation_before', function () {
		echo canva_get_template('language-switcher', ['plugin' => 'weglot']);
	}, 1, 1);
}
