</main>
<section class="top-footer">
    <img src="<?php echo get_template_directory_uri(); ?>/img/wave.png">
</section>
<footer>
    <div class="footer-widgets">
        <div class="right">
            <?php if (is_active_sidebar('footer-right')) : ?>
                <?php dynamic_sidebar('footer-right'); ?>
            <?php endif; ?>
        </div>


        <div class="center">
            <?php if (is_active_sidebar('footer-center')) : ?>
                <?php dynamic_sidebar('footer-center'); ?>
            <?php endif; ?>
        </div>


        <div class="left">
            <?php if (is_active_sidebar('footer-left')) : ?>
                <?php dynamic_sidebar('footer-left'); ?>
            <?php endif; ?>
        </div>


    </div>

    <div class="footer-copyright">
        کلیه حقوق تعلق ب خانه ارمان است
    </div>

</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>


<?php wp_footer(); ?>
</body>
</html>