<!Doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <?php wp_head(); ?>
</head>
<body>

<header class="sticky">
    <div class="container">
          <div class="header-top">
            <div class="right">
                <div id="hamberger">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="logo" title="<?php bloginfo( 'name' ); ?>">

                    <?php the_custom_logo(); ?>

                    <div class="site-branding-text">
                        <?php if ( is_front_page() ) : ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                        <?php endif; ?>

                        <?php
                        $description = get_bloginfo( 'description', 'display' );

                        if ( $description || is_customize_preview() ) :
                            ?>
                            <p class="site-description"><?php echo $description; ?></p>
                        <?php endif; ?>
                    </div><!-- .site-branding-text -->
                </div>

            </div>



            <div class="top-menu">
<!--                <a href="--><?php //echo home_url(); ?><!--/my-account" class="header-icon"><i class="fal fa-user"></i></a>-->
<!--                <a href="--><?php //echo home_url(); ?><!--/cart" class="header-icon"><i class="fal fa-shopping-cart"></i></a>-->
                <a href="<?php echo home_url(); ?>/donation" class="btn btn-theme"><i class="fal fa-heart"></i>کمک آرمانی</a>
            </div>
        </div>

        <nav class="navigation">
            <div id="close">
                <i class="fas fa-close"></i>
            </div>


            <?php wp_nav_menu( array( 'theme_location' => 'main-menu' , 'container'  => '' ) ); ?>

        </nav>
        <div class="header-bottom">

            <nav class="main-menu">
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu' , 'container'  => '' ) ); ?>
            </nav>



            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-form">
                <input type="submit" value="" class="search-submit">
                <input type="search" name="s" id="s" class="search-text" placeholder="جستجو..." autocomplete="off">
            </form>

        </div>

    </div>


</header>
<main>