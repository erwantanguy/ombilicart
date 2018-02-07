<?php
add_image_size( 'logo', 100 );
add_image_size( 'vignette', 150,150, true );
/* Autoriser les fichiers SVG */
function wpc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'wpc_mime_types');

/* MENU */


register_nav_menus(array(
	'home' => 'Menu principale home',
	//'second' => 'Menu principale',
	//'deuxieme' => 'Petit menu optionnel',
	'footer' => 'Menu pied de page',
	//'lieux' => 'Menu des lieux',
	//'oeuvres' => 'Menu pour les oeuvres quand il n\'y a pas d\'Ã©vÃ©nements'
));


/* Pages pour la gestion du thème */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
            'page_title' 	=> 'Réglages généraux du thème',
            'menu_title'	=> 'Ombilicart',
            'menu_slug' 	=> 'ombilicart-reglages',
            'capability'	=> 'edit_posts',
            'redirect'		=> false,
            'icon_url' => 'dashicons-admin-home',
            'position' => 2,
	));
	
	acf_add_options_sub_page(array(
            'page_title' 	=> 'Réglages de la page d\'accueil',
            'menu_title'	=> 'accueil',
            'parent_slug'	=> 'ombilicart-reglages',
	));
	
//	acf_add_options_sub_page(array(
//		'page_title' 	=> 'Theme Footer Settings',
//		'menu_title'	=> 'Footer',
//		'parent_slug'	=> 'ombilicart-reglages',
//	));
	
}

/********* post type *********/

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'creation',
    array(
      'labels' => array(
        'name' => __( 'Créations' ),
        'singular_name' => __( 'Création' ),
        'all_items' => 'Toutes les créations',
      'add_new_item' => 'Ajouter une création',
      'edit_item' => 'Éditer la création',
      'new_item' => 'Nouvelle création',
      'view_item' => 'Voir la création',
      'search_items' => 'Rechercher parmi les créations',
      'not_found' => 'Pas de création trouvée',
      'not_found_in_trash'=> 'Pas de création dans la corbeille'
      ),
      'public' => true,
      'menu_icon' => 'dashicons-format-audio',
      'menu_position' => 3,
      /*'publicly_queryable' => true,
	  'show_ui'            => true,
	  'show_in_menu'       => true,
	  'query_var'          => true,
      'show_in_nav_menus' => true,*/
	  
      /*'show_in_admin_bar' => true,*/
      'supports'=>array('title','editor','thumbnail','excerpt','revisions'),
	  //'taxonomies'=>array('post_tag'),
	  'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
    )
  );
  /*register_post_type( 'reference',
  array(
  'labels' => array(
  'name' => __( 'Références ' ),
  'singular_name' => __( 'Référence ' ),
  'all_items' => 'Toutes les références',
  'add_new_item' => 'Ajouter une référence',
  'edit_item' => 'Éditer la référence',
  'new_item' => 'Nouvelle référence',
  'view_item' => 'Voir la référence',
  'search_items' => 'Rechercher parmi les références',
  'not_found' => 'Pas de référence trouvée',
  'not_found_in_trash'=> 'Pas de référence dans la corbeille'
  		),
  		'public' => true,
  		'supports'=>array('title','editor','thumbnail','excerpt','revisions'),
  		'query_var' => true,
  		'rewrite' => true,
  		'capability_type' => 'post',
  )
  );*/
  /*register_post_type( 'archive',
  array(
  'labels' => array(
  'name' => __( 'Archives ' ),
  'singular_name' => __( 'Archive ' ),
  'all_items' => 'Toutes les archives',
  'add_new_item' => 'Ajouter une archive',
  'edit_item' => 'Éditer la archive',
  'new_item' => 'Nouvelle archive',
  'view_item' => 'Voir la archive',
  'search_items' => 'Rechercher parmi les archives',
  'not_found' => 'Pas de archive trouvée',
  'not_found_in_trash'=> 'Pas de archive dans la corbeille'
  		),
  		'public' => true,
  		'supports'=>array('title','editor','thumbnail','excerpt','revisions'),
  		'query_var' => true,
  		'rewrite' => true,
  		'capability_type' => 'post',
  )
  );*/
  register_taxonomy('type','creation',array( 'hierarchical' => false, 'label' => 'Type de création', 'query_var' => true, 'rewrite' => array( 'slug' => 'type' ) ));
  //register_taxonomy('referece','realisation',array( 'hierarchical' => false, 'label' => 'Type de structures', 'query_var' => true, 'rewrite' => array( 'slug' => 'reference' ) ));
  //register_taxonomy('tagexpo','realisation',array( 'hierarchical' => false, 'label' => 'Références clients', 'query_var' => true, 'rewrite' => array( 'slug' => 'tags' ) ));
  //register_taxonomy('category','reference',array( 'hierarchical' => false, 'label' => 'Catégories', 'query_var' => true, 'rewrite' => array( 'slug' => 'categorie' ) ));
  //register_taxonomy('tag','reference',array( 'hierarchical' => false, 'label' => 'Tags', 'query_var' => true, 'rewrite' => array( 'slug' => 'tags' ) ));
  //register_taxonomy('cat','archive',array( 'hierarchical' => false, 'label' => 'Catégories', 'query_var' => true, 'rewrite' => array( 'slug' => 'categorie' ) ));
  //register_taxonomy('refenrece','archive',array( 'hierarchical' => false, 'label' => 'Références', 'query_var' => true, 'rewrite' => array( 'slug' => 'reference' ) ));
}


/************* breadcrumbs *********/
add_filter('wpseo_breadcrumb_links','options_filariane');
function options_filariane($links) {
  global $post;
  
  if(is_singular('creation')){
      $breadcrumb[]= array(
        'url' => get_page_link(36),
        'text' => get_the_title(36),
      );
      array_splice($links, 1, -2, $breadcrumb);
  }
  if(is_tax('type') || is_singular('produit')){
        $breadcrumb[] = array(
            'url' => get_page_link( 36 ),
            'text' => get_the_title(36),
        );

        array_splice( $links, 1, -2, $breadcrumb );
    }
  if(is_shop() || is_product_category()){
        $breadcrumb[] = array(
            'url' => get_page_link( 36 ),
            'text' => get_the_title(36),
        );

        array_splice( $links, 1, -2, $breadcrumb );
  }
  if(is_product()){
      $breadcrumb[0] = array(
            'url' => get_page_link( 36 ),
            'text' => get_the_title(36),
          );
      $breadcrumb[1] = array(
            'url' => get_page_link( 99 ),
            'text' => get_the_title(99),
        );
      array_splice( $links, 1, -2, $breadcrumb );
  }
  return $links;
}






add_filter( 'wpseo_breadcrumb_output', 'breadcrumb_output', 1 );
function breadcrumb_output($output){
    global $post;
    $output = preg_replace("/^\<span xmlns\:v=\"http\:\/\/rdf\.data\-vocabulary\.org\/#\"\>/", "", $output);
    $output = preg_replace("/^\<span typeof=\"v\:Breadcrumb\"\>/", "<li class=\"breadcrumb-item\" itemprop=\"itemListElement\" itemscope itemtype=\"http://schema.org/ListItem\">", $output);
    $output = preg_replace("<span rel=\"v:child\" typeof=\"v:Breadcrumb\">","<li class=\"breadcrumb-item\" itemprop=\"itemListElement\" itemscope itemtype=\"http://schema.org/ListItem\">", $output);
    $output = preg_replace("<span class=\"breadcrumb_last\">","<li class=\"breadcrumb-item active\" itemprop=\"itemListElement\" itemscope itemtype=\"http://schema.org/ListItem\">", $output);
    $output = preg_replace("/\<\/span\>$/", "", $output);
    $output = str_replace(" <", '', $output);
    $output = str_replace(">>", '>', $output);
    $output = str_replace(">&gt;", '>', $output);
    //$output = preg_replace('#<a(.*)href="([^"]*)"(.*)rel="(.*)"(.*)property="(.*)">(.*)</a>#','<a$1href="$2"$3rel="$4"$5property="$6" itemprop="item"><span itemprop="name">$7</span></a>', $output);
    $output = preg_replace('/<a href="([^"]*)" rel="([^"]*)" property="([^"]*)">([^"]*)<\/a>/m','<a href="$1" rel="$2" property="$3" itemprop="item"><span itemprop="name">$4</span></a>', $output);
    $output = preg_replace('/<\/span><\/span><\/span><\/span>/','</li>',$output);
    //$output = preg_replace('/<a(.*)href="([^"]*)"(.*)rel="(.*)"(.*)property="(.*)">(.*)<\/a>/m','<a$1href="$2"$3rel="$4"$5property="$6" itemprop="item"><span itemprop="name">$7</span></a>', $output);
    //$output = preg_replace('/<a(.*)href="([^"]*)"(.*)rel="(.*)"(.*)property="(.*)">(.*)<\/a>/g','<a$1href="$2"$3rel="$4"$5property="$6" itemprop="item"><span itemprop="name">$7</span></a>', $output);
    //$output = preg_replace('/<li class="breadcrumb-item active" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">([^"]*)</li>/m','<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="item name">$1</span></li>', $output);
    return $output;
}


/********* woocommerce ****/

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}






/************ JS et CSS ***************/

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 200 );
function theme_enqueue_styles() {
if( !is_admin() ) :
    //wp_deregister_script('popper.min.js','https://cdnjs.cloudflare.com/ajax/libs/');
    //wp_deregister_script('jquery');
    wp_register_script('functions', get_stylesheet_directory_uri().'/bundle.js','',false,true);
    wp_enqueue_script( 'functions' );
    wp_enqueue_style('child-style', get_stylesheet_directory_uri().'/app.css', array(), time());
endif;
}
//add_action( 'wp_footer', 'wpse_262301_wp_footer', 11 );
function wpse_262301_wp_footer() { 
  wp_dequeue_script( 'popper' );
}