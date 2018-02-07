<?php get_header(); ?>

<div class="container-responsive mt-5">
  <div class="row">
    <div class="col-sm-8">
        <header>
            <h1><?php the_title(); ?></h1>
        </header>
      <main id="content" role="main">
        <?php the_content(); ?>
      </main><!-- /#content -->
    </div>
      <figure class="col">
          <?php the_post_thumbnail('medium'); ?>
      </figure>
  </div><!-- /.row -->
</div><!-- /.container-responsive -->

<?php get_footer(); ?>
