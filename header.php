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
<header>
    <div class="container">

        <div class="header-top">
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


            <div class="top-menu">
                <a href="#"><i class="fal fa-user"></i></a>
                <a href="#"><i class="fal fa-shopping-cart"></i></a>
                <a href="<?php echo home_url(); ?>/donation" class="btn btn-primary"><i class="fal fa-heart"></i>کمک آرمانی</a>
            </div>
        </div>


        <div class="header-bottom">
            <nav class="main-menu">
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu' , 'container'  => '' ) ); ?>
            </nav>
<!--            <nav class="navbar navbar-expand-md navbar-light" role="navigation">-->
<!--                <div class="container">-->
<!--                    <!-- Brand and toggle get grouped for better mobile display -->
<!--                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="--><?php //esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?><!--">-->
<!--                        <span class="navbar-toggler-icon"></span>-->
<!--                    </button>-->
<!--                    --><?php
//                    wp_nav_menu( array(
//                        'theme_location'    => 'main-menu',
//                        'depth'             => 2,
//                        'container'         => 'div',
//                        'container_class'   => 'collapse navbar-collapse',
//                        'container_id'      => 'bs-example-navbar-collapse-1',
//                        'menu_class'        => 'nav navbar-nav',
//                        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
//                        'walker'            => new WP_Bootstrap_Navwalker(),
//                    ) );
//                    ?>
<!--                </div>-->
<!--            </nav-->


            <form action="https://duckduckgo.com/" role="search" class="search-form">
                <input type="submit" value="" class="search-submit">
                <input type="search" name="q" class="search-text" placeholder="جستجو..." autocomplete="off">
            </form>

        </div>

    </div>


</header>
<main>