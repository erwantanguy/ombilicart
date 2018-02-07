<?php get_header(); global $post;?>

<div class="container-responsive mt-5">
  <div class="row">

    <div class="col-sm">
      <div id="content" role="main">
        <header class="mb-4 border-bottom">
          <h1>
            <?php /*_e('Category: ', 'b4st');*/ echo single_cat_title(); ?>
          </h1>
            <h2>
                <?php //$image = get_field('image','category_'.$post->ID); print_r($image); ?>
            </h2>
        </header>
          <section class="row">
            <?php //$creations = new WP_Query(['post_type' => 'creation','post_per_page' => 4,]);
          //print_r($creations);
          if(have_posts()):
              while (have_posts()):
              the_post();
          global $woocommerce;
          $currency = get_woocommerce_currency_symbol();
          $price = get_post_meta( get_the_ID(), '_regular_price', true);
          $sale = get_post_meta( get_the_ID(), '_sale_price', true);?>
        <article class="card col-md-3">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
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
      </div><!-- /#content -->
    </div>

    <?php //get_sidebar(); ?>

  </div><!-- /.row -->
</div><!-- /.container-responsive -->

<?php get_footer(); ?>
