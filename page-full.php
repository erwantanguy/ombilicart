<?php /*
Template Name: Full width
*/
get_header(); ?>

<div class="container-responsive mt-5">
  <div class="row">
    <div class="col-sm-12">
      <div id="content" role="main">
        <?php get_template_part('loops/page-content'); ?>
      </div><!-- /#content -->
    </div>
      <figure class="col">
          <?php the_post_thumbnail('medium'); ?>
      </figure>
  </div><!-- /.row -->
</div><!-- /.container-responsive -->

<?php get_footer(); ?>
