</main>
<section class="top-footer">
    <img src="<?php echo get_template_directory_uri(); ?>/img/wave.png">
</section>
<footer>
    <div class="container wow fadeIn">
        <div class="footer-widget">
            <div class="row">

                <?php if (is_active_sidebar('footer-widget')) : ?>
                    <?php dynamic_sidebar('footer-widget'); ?>
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