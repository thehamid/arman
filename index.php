<?php
get_header();


global $wp;
$url=home_url( $wp->request );
$key='en';
if (strpos($url, $key) == false) {
get_template_part("template/index","hero");
get_template_part("template/index","services");
get_template_part("template/index","events");
get_template_part("template/index","info");
get_template_part("template/index","crowdfunding");
get_template_part("template/index","blog");
get_template_part("template/index","volunteer");
}
else {

    get_template_part("template/index","hero");
    get_template_part("template/index","info");
    get_template_part("template/index","events");
    get_template_part("template/index","volunteer");
}

get_footer();














