<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header( 'shop' );?>
<div class="container-responsive mt-5">
  <div class="row">
<?php /**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );
?>
<header class="woocommerce-products-header col-12">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
      </div>
<?php
if ( have_posts() ) {
	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked wc_print_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */?>
    <nav class="row">
	<?php do_action( 'woocommerce_before_shop_loop' );?>
    </nav>
	<?php //woocommerce_product_loop_start();
	if ( wc_get_loop_prop( 'total' ) ) {?>
       <section class="row">
		<?php while ( have_posts() ) {
			the_post();
			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			//do_action( 'woocommerce_shop_loop' );
			//wc_get_template_part( 'content', 'product' );
                        global $woocommerce;
                        $currency = get_woocommerce_currency_symbol();
                        $price = get_post_meta( get_the_ID(), '_regular_price', true);
                        $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                        //print_r($sale);          echo '<hr>';
                        //print_r($price);          echo '<hr>';
                        //print_r($currency);          echo '<hr>';
                        //print_r($woocommerce);          echo '<hr>';
                        ?>
                  <article class="card col-md-3">
                      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                      <?php $terms = get_the_terms( get_the_ID(), 'product_cat' );//print_r($terms);
                      if($terms):?>
                      <nav>
                      <?php foreach($terms as $term){?>
                          <a class="btn term" href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a>
                      <?php }?>
                      </nav>
                      <?php endif; ?>
                      <div class="card-body">
                        <h1 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <p class="card-text"><?php echo get_the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn"><?php if($sale):echo '<del>'.$price.' '.$currency.'</del> '.$sale;else:echo $price;endif;echo ' '.$currency; ?></a>
                      </div>
                  </article>
          <?php }?>
       </section>
	<?php }
	//woocommerce_product_loop_end();
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );?>
  </div>
<?php get_footer( 'shop' );