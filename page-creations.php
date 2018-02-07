<?php /*
Template Name: Nos créations
*/
get_header(); ?>

<div class="container-responsive mt-5">
  <div class="row">
    <div class="col-sm-8">
      <div id="content" role="main">
          <?php get_template_part('loops/page-content'); ?>
      </div><!-- /#content -->
    </div>
      <figure class="col">
          <?php the_post_thumbnail('medium'); ?>
      </figure>
  </div><!-- /.row -->
  <section class="row">
    <?php $creations = new WP_Query(['post_type' => 'creation',]);
      //print_r($creations);
      if($creations->have_posts()):
          while ($creations->have_posts()):
          $creations->the_post();?>
    <article class="card col-md-3">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
        <?php $terms = get_the_terms( get_the_ID(), 'type' );//print_r($terms);
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
          <a href="<?php the_permalink(); ?>" class="btn">Plus d'informations</a>
        </div>
    </article>
          <?php endwhile;
      endif;
    ?>
  </section>
</div><!-- /.container-responsive -->

<?php get_footer(); ?>
