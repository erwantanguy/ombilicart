<footer class="mt-5 bg-light">

  <div class="container-responsive">

    <?php if(is_active_sidebar('footer-widget-area')): ?>
    <div class="row border-bottom pt-5 pb-4" id="footer" role="navigation">
      <?php dynamic_sidebar('footer-widget-area'); ?>
    </div>
    <?php endif; ?>

    <div class="row pt-3">
      <div class="col">
        <p>Tous droits réservés <?php echo date('Y'); ?> - <a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></p>
      </div>
        <div class="col">
            <?php
                wp_nav_menu( array(
                  'theme_location'  => 'footer',
                  'container'       => false,
                  'menu_class'      => '',
                  'fallback_cb'     => '__return_false',
                  'items_wrap'      => '<ul id="%1$s" class="nav">%3$s</ul>',
                  'depth'           => 2,
                  'walker'          => new b4st_walker_nav_menu()
                ) );
              ?>
        </div>
    </div>

  </div>

</footer>


<?php wp_footer(); ?>
</body>
</html>
