<?php /*
Template Name: Nos créations
*/
get_header(); ?>

<div class="container-responsive mt-5">
  <div class="row">
    <div class="col-12">
      <header id="content" role="main">
          <h1>Commandez nos projets en ligne !</h1>
      </header><!-- /#content -->
    </div>
  </div><!-- /.row -->
  <section class="row">
    <?php //$creations = new WP_Query(['post_type' => 'creation',]);
      //print_r($creations);
      if(have_posts()):
          while (have_posts()):
          the_post();//print_r($post);
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
          <?php endwhile;
      endif;
    ?>
  </section>
</div><!-- /.container-responsive -->

<?php get_footer(); ?>
