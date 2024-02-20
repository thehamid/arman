</main>
<section class="top-footer">
    <img src="<?php echo get_template_directory_uri(); ?>/img/footer-wave.png">
</section>
<footer>
    <div class="container wow fadeIn">
        <?php
        global $wp;
        $url=home_url( $wp->request );
        $key='en';
        if (strpos($url, $key) == false) {?>

        <div class="footer-widget">
            <div class="f-box">
                <?php if (is_active_sidebar('arman_footer_one')) : ?>
                    <?php dynamic_sidebar('arman_footer_one'); ?>
                <?php endif; ?>
            </div>

            <div class="f-box">
                <?php if (is_active_sidebar('arman_footer_two')) : ?>
                    <?php dynamic_sidebar('arman_footer_two'); ?>
                <?php endif; ?>
            </div>

            <div class="f-box">
                <?php if (is_active_sidebar('arman_footer_three')) : ?>
                    <?php dynamic_sidebar('arman_footer_three'); ?>
                <?php endif; ?>
            </div>



        </div>


        <div class="footer-copyright">
            ARMANHOME.ORG  &copy;تمامی حقوق برای خانه آرمان محفوظ است
        </div>
        <?php }
        else {?>

            <div class="footer-widget">
                <div class="f-box">
                    <?php if (is_active_sidebar('arman_footer_one')) : ?>
                        <?php dynamic_sidebar('arman_footer_one'); ?>
                    <?php endif; ?>
                </div>

                <div class="f-box">
                    <?php if (is_active_sidebar('arman_footer_two')) : ?>
                        <?php dynamic_sidebar('arman_footer_two'); ?>
                    <?php endif; ?>
                </div>

                <div class="f-box">
                    <?php if (is_active_sidebar('arman_footer_three')) : ?>
                        <?php dynamic_sidebar('arman_footer_three'); ?>
                    <?php endif; ?>
                </div>



            </div>


            <div class="footer-copyright">
                ARMANHOME.ORG  &copy; All Right Reserved
            </div>

            <?php
        }
        ?>

    </div>

    <div class="mobile_menu">
        <?php
        global $wp;
        $url=home_url( $wp->request );
        $key='en';
        if (strpos($url, $key) == false) {?>
            <nav class="mobile-bottom-nav">
                <div class="mobile-bottom-nav__item">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="mobile-bottom-nav__item-content">
                            <i class="fal fa-home-blank"></i>
                            خانه
                        </div>
                    </a>
                </div>
                <div class="mobile-bottom-nav__item">
                    <a>
                        <div class="mobile-bottom-nav__item-content">
                            <i class="fal fa-user"></i>
                        </div>
                        <?php echo do_shortcode('[dm-modal]');?></a>
                </div>
                <div class="mobile-bottom-nav__item">
                    <a href="<?php echo home_url(); ?>/cart" >
                        <div class="mobile-bottom-nav__item-content">
                            <i class="mini-cart fal fa-cart-shopping"> <span id="mini-cart-count"></span></i>
                            سبد خرید
                        </div>
                    </a>
                </div>
                <div class="mobile-bottom-nav__item ">
                    <div  id="slide_menu">
                        <div class="mobile-bottom-nav__item-content">
                            <i class="fal fa-bars"></i>
                            فهرست
                        </div>
                    </div>
                </div>

            </nav>


       <?php }
        else {?>
          <nav class="mobile-bottom-nav">
            <div class="mobile-bottom-nav__item">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="mobile-bottom-nav__item-content">
                        <i class="fal fa-home-blank"></i>
                        Home
                    </div>
                </a>
            </div>

    <div class="mobile-bottom-nav__item">
        <a href="<?php echo home_url(); ?>/donation-arman" >
            <div class="mobile-bottom-nav__item-content">
                <i class="fal fa-heart"></i>
                Donate
            </div>
        </a>
    </div>
    <div class="mobile-bottom-nav__item ">
        <div  id="slide_menu">
            <div class="mobile-bottom-nav__item-content">
                <i class="fal fa-bars"></i>
                Menu
            </div>
        </div>
    </div>

    </nav>
        <?php
        }
        ?>





    </div>
</footer>




<script>
    new WOW().init();
</script>

<?php wp_footer(); ?>
</body>
</html>