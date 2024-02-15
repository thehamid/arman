<section class="info">
    <?php
    global $wp;
    $url=home_url( $wp->request );
    $key='en';
    if (strpos($url, $key) == false) {?>
    <div class="container">
        <div class="info-item">
            <div class="img-info wow fadeInRight">
                <img src="<?php echo get_template_directory_uri(); ?>/img/family_blue.png" alt="">
            </div>

            <div class="content-info wow fadeInLeft">
                <div class="title-info" ><img src="<?php echo get_template_directory_uri(); ?>/img/adoption.png" alt=""><h2>فرزند پذیری</h2></div>
                <p>لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده </p>

                <a href="<?php echo home_url(); ?>\adoption" class="btn btn-theme">اطلاعات بیشتر<i class="fas fa-long-arrow-alt-left"></i></a>
            </div>
        </div>
    </div>
        <?php
    }
    else {
        ?>

        <div class="container">
            <div class="info-item">

                <div class="content-info wow fadeInLeft">
                    <div class="title-info" ><h2>About ArmanHome</h2></div>
                    <p>Arman Home, is a care center for orphaned and abused children, which has been operating since 2010 with registration number 3194, licensed and under the supervision of the General Welfare Department of Isfahan province. </p>

                    <a href="<?php echo home_url(); ?>\about-arman" class="btn btn-theme">More info</a>
                </div>



                <div class="img-info wow fadeInRight">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/about-en.png" alt="">
                </div>


            </div>
        </div>

        <?php
    }
    ?>
</section>