<section class="events">

    <?php
    global $wp;
    $url=home_url( $wp->request );
    $key='en';
    if (strpos($url, $key) == false) {?>

        <div class="container">

        <div class="row">

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="img-events wow fadeInLeft">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/e2.png" alt="">
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4 ">
                <div class="items-events">
                    <a href="<?php echo home_url(); ?>/memories" class="e-item wow fadeInRight">
                        <i class="fad fa-home-heart fa-beat"></i>
                        <h4>خاطرات خانه</h4>
                    </a>
                    <a href="<?php echo home_url(); ?>/events" class="e-item wow fadeInLeft">
                        <i class="fad fa-calendar-alt fa-shake"></i>
                        <h4>رویداد‌های خانه</h4>
                    </a>
                    <a href="<?php echo home_url(); ?>/successes" class="e-item wow fadeInRight">
                        <i class="fad fa-star fa-spin"></i>
                        <h4>موفقیت‌های خانه</h4>
                    </a>

                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="img-events wow fadeInLeft">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/e1.png" alt="">
                </div>
            </div>


        </div>


    </div>
        <?php
    }
    else {
    ?>

        <div class="container">
            <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="img-events wow fadeInLeft">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/e1.png" alt="">
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4 ">
                    <div class="items-events">
                        <a href="<?php echo home_url(); ?>/memories" class="e-item wow fadeInRight">
                            <i class="fad fa-home-heart fa-beat"></i>
                            <h4>Home Memories</h4>
                        </a>
                        <a href="<?php echo home_url(); ?>/events" class="e-item wow fadeInLeft">
                            <i class="fad fa-calendar-alt fa-shake"></i>
                            <h4>Home Events</h4>
                        </a>
                        <a href="<?php echo home_url(); ?>/successes" class="e-item wow fadeInRight">
                            <i class="fad fa-star fa-spin"></i>
                            <h4>Home Successes</h4>
                        </a>

                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="img-events wow fadeInLeft">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/e2.png" alt="">
                    </div>
                </div>


            </div>


        </div>


        <?php
    }
    ?>

</section>