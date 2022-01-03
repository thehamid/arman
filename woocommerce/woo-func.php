<?php
/*-------------------------------------------
            WooCommerce Functions
----------------------------------------------*/
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 200,
        'single_image_width'    => 500,

        'product_grid'          => array(
            'default_rows'    => 1,
            'min_rows'        => 1,
            'max_rows'        => 1,
            'default_columns' => 4,
            'min_columns'     => 1,
            'max_columns'     => 4,
        ),
    ) );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


// Ajax Cart Count
add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_cart_fragments', 50, 1 );
function wc_refresh_cart_fragments( $fragments ){
    $cart_count = WC()->cart->get_cart_contents_count();

    // Normal version
    $count_normal = '<span id="count-cart-items">' .  $cart_count . '</span>';
    if($cart_count>0) {
        $fragments['#count-cart-items'] = $count_normal;
    }
    // Mobile version
    $count_mobile = '<span id="count-cart-itemob">' .  $cart_count . '</span>';
    $fragments['#count-cart-itemob'] = $count_mobile;

    return $fragments;
}


add_filter('woocommerce_checkout_fields','addBootstrapToCheckoutFields');
function addBootstrapToCheckoutFields($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            // if you want to add the form-group class around the label and the input
            $field['class'][] = 'form-group';

            // add form-control to the actual input
            $field['input_class'][] = 'form-control input-lg';
            $field['label_class'][] = 'control-label';
        }
    }
    return $fields;
}

// Minimum CSS to remove +/- default buttons on input field type number
add_action( 'wp_head' , 'custom_quantity_fields_css' );
function custom_quantity_fields_css(){
    ?>
    <style>
        .quantity input::-webkit-outer-spin-button,
        .quantity input::-webkit-inner-spin-button {
            display: none;
            margin: 0;
        }
        .quantity input.qty {
            appearance: textfield;
            -webkit-appearance: none;
            -moz-appearance: textfield;
        }
    </style>
    <?php
}


add_action( 'wp_footer' , 'custom_quantity_fields_script' );
function custom_quantity_fields_script(){
    ?>
    <script type='text/javascript'>
        jQuery( function( $ ) {
            if ( ! String.prototype.getDecimals ) {
                String.prototype.getDecimals = function() {
                    var num = this,
                        match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                    if ( ! match ) {
                        return 0;
                    }
                    return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
                }
            }
            // Quantity "plus" and "minus" buttons
            $( document.body ).on( 'click', '.plus, .minus', function() {
                var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                    currentVal  = parseFloat( $qty.val() ),
                    max         = parseFloat( $qty.attr( 'max' ) ),
                    min         = parseFloat( $qty.attr( 'min' ) ),
                    step        = $qty.attr( 'step' );

                // Format values
                if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
                if ( max === '' || max === 'NaN' ) max = '';
                if ( min === '' || min === 'NaN' ) min = 0;
                if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

                // Change the value
                if ( $( this ).is( '.plus' ) ) {
                    if ( max && ( currentVal >= max ) ) {
                        $qty.val( max );
                    } else {
                        $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                    }
                } else {
                    if ( min && ( currentVal <= min ) ) {
                        $qty.val( min );
                    } else if ( currentVal > 0 ) {
                        $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                    }
                }

                // Trigger change event
                $qty.trigger( 'change' );
            });
        });
    </script>
    <?php
}

