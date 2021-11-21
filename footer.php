</main>
<section class="top-footer">
    <img src="<?php echo get_template_directory_uri(); ?>/img/wave.png">
</section>
<footer>
    <div class="container">
        <div class="footer-widget">
            <div class="row">

                <?php if (is_active_sidebar('footer-widget')) : ?>
                    <?php dynamic_sidebar('footer-widget'); ?>
                <?php endif; ?>


            </div>

        </div>


        <div class="footer-copyright">
            ARMANHOME.ORG 2021 &copy;کلیه حقوق متعلق به خانه آرمان است
        </div>


    </div>
</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>


<?php wp_footer(); ?>
</body>
</html>