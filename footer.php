</main>
<section class="top-footer">
    <img src="<?php echo get_template_directory_uri(); ?>/img/footer-wave.png">
</section>
<footer>
    <div class="container wow fadeIn">
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


    </div>
</footer>




<script>
    new WOW().init();
</script>

<?php wp_footer(); ?>
</body>
</html>