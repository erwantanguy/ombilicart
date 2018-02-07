<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta name="description" content="<?php if ( is_single() ) {
      single_post_title('', true);
    } else {
      bloginfo('name'); echo " - "; bloginfo('description');
    }
  ?>" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container-responsive">

    <a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>">
        <?php 
        $image = get_field('logo', 'option');
        //print_r(wp_get_attachment_image( $image, $size ));
        $size = 'logo'; // (thumbnail, medium, large, full or custom size)
        if( $image ) {
                echo wp_get_attachment_image( $image, $size );
        }else{bloginfo('name'); }?>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarDropdown" aria-controls="navbarDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarDropdown">
      <?php
      if(is_home()){$menu = "home";}else{$menu = "navbar";}
        wp_nav_menu( array(
          'theme_location'  => $menu,
          'container'       => false,
          'menu_class'      => '',
          'fallback_cb'     => '__return_false',
          'items_wrap'      => '<ul id="%1$s" class="navbar-nav mr-auto mt-2 mt-lg-0 %2$s">%3$s</ul>',
          'depth'           => 2,
          'walker'          => new b4st_walker_nav_menu()
        ) );
      ?>

      <form class="form-inline ml-auto pt-2 pt-md-0" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input class="form-control mr-sm-1" type="text" value="<?php echo get_search_query(); ?>" placeholder="Search..." name="s" id="s">
        <button type="submit" id="searchsubmit" value="<?php esc_attr_x('Search', 'b4st') ?>" class="btn btn-outline-secondary my-2 my-sm-0">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>

  </div>
</nav>
    <nav aria-label="breadcrumb" class="container-responsive mt-5">
<?php if(!is_home()){
if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('
<ol id="breadcrumbs" class="breadcrumb" itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">','</ol>
');
}
}?>
</nav>