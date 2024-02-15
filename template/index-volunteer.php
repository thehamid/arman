<section class="volunteer">
    <?php
    global $wp;
    $url=home_url( $wp->request );
    $key='en';
    if (strpos($url, $key) == false) {?>


    <div class="container">
        <div class="vol-item">
            <div class="img-vol">
                <img src="<?php echo get_template_directory_uri(); ?>/img/vol1.png" alt="">
            </div>

            <div class="content-vol wow fadeInLeft">
                <h3>شما هم عضوی از خانواده بزرگ خانه آرمان شوید</h3>

                <a href="<?php echo home_url(); ?>\vol-register" class="btn btn-theme">عضویت داوطلبانه</a>
            </div>
        </div>
    </div>
        <?php
    }
    else {
    ?>

        <div class="container">
            <div class="vol-item">
                <div class="content-vol wow fadeInLeft">
                    <h3>You become a member of Arman's big family</h3>

                    <a href="<?php echo home_url(); ?>\vol-register" class="btn btn-theme">Voluntary membership</a>
                </div>
                <div class="img-vol">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/vol1.png" alt="">
                </div>


            </div>
        </div>

        <?php
    }
    ?>
</section>