<?php
/*
	Template Name: NewHome
*/
?>
<?php
get_header();
?>
<style>
    .container h1{
        font-family: Pinar,Peyda,serif;
        text-align: center;
        margin-top: 100px;
        margin-bottom: 120px;
        color:#8523ff ;
    }

    .blu-home {
        background:url("<?php echo get_template_directory_uri(); ?>/img/building.png") repeat-x;
        position: relative;
        display: flex;
        justify-content: center;
    }

    .house {
        top: 50%;
        left: 75px;
        height: auto;
        background: linear-gradient(to bottom, #0cbee4, #00adee, #0099f5, #0082f3, #5a64e6);
    }
    .house::before {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-left: 150px solid transparent;
        border-right: 150px solid transparent;
        border-bottom: 113px solid #0cbee4;
        z-index: 2;
        top: -111px;
        left: 300px;
    }

    .house::after {
        content: '';
        position: absolute;
        top: -90px;
        left: 330px;
        height: 70px;
        width: 30px;
        background: #0cbee4;
        z-index: 1;
        border-top: 7px solid rgba(0, 0, 0, .3);
    }

    .matrix {
        z-index: 3;
        position: relative;
        display: grid;
        grid-template-columns: repeat(25, 1fr);
        gap: 10px;
        padding: 10px;
    }

    .led {
        display: inline-block;
        margin-bottom: 0px;
        width: 20px;
        height: 20px;
        background-color: rgb(255, 208, 0);
        -webkit-box-shadow: 0px 0px 15px 5px rgba(255, 225, 0, 0.50);
        -moz-box-shadow: 0px 0px 15px 5px rgba(255, 225, 0, 0.50);
        box-shadow: 0px 0px 15px 5px rgba(255, 225, 0, 0.50);
    }

    .off{
        background-color: #222222;
        -webkit-box-shadow: 0px 0px 0px 0px rgba(255, 255, 190, .75);
        -moz-box-shadow: 0px 0px 0px 0px rgba(255, 255, 190, .75);
        box-shadow: 0px 0px 0px 0px rgba(255, 255, 190, .75);
    }


    @media screen and (max-width: 760px) {
        .house::before {
            left: 130px;
        }

        .house::after {
            left: 150px;
        }

        .matrix {
            grid-template-columns: repeat(20, 1fr);
        }

        .bottom-home{
          flex-wrap: wrap;
        }

    }
    @media screen and (max-width: 600px) {
        .matrix {
            grid-template-columns: repeat(10, 1fr);
        }
        .house::before {
            left: 110px;
        }

        .house::after {
            left: 145px;
        }
    }

    @media screen and (max-width: 470px) {
        .house::before {
            border-left: 100px solid transparent;
            border-right: 100px solid transparent;
            border-bottom: 100px solid #0cbee4;
            z-index: 2;
            top: -100px;
            left: 95px;
        }

        .house::after {
            top: -70px;
            height: 55px;
            left: 115px;
        }

        .matrix {
            grid-template-columns: repeat(10, 1fr);
            gap: 8px;
            padding: 5px;
        }

        .led {
            width: 12px;
            height: 12px;
        }

    }

    @media screen and (max-width: 360px) {
        .house::before {
            left: 60px;
        }

        .house::after {
            left: 80px;
        }
    }

    .bottom-home{
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    .bottom-home .form_pay{
        border: 1px solid #818182;
        border-radius: 20px;
        padding: 20px;
        text-align: justify;
        margin: 10px;
    }
    .bottom-home .form_pay #input_4_2{
        display: flex;
        justify-content: space-between;
    }
    .bottom-home .form_pay #input_4_2 li{
        border: 1px solid #0a8cce;
        text-align: center;
    }

    .bottom-home .form_pay #gform_submit_button_4{
        width: 100%;
        text-align: center;
        border-radius: 50px;
        background: #FFCC00;
    }

    .bottom-home .text_pay{
        border: 1px solid #818182;
        border-radius: 20px;
        padding: 20px;
        text-align: justify;
        margin: 10px;
    }
</style>
<div class="container">
        <h1>چراغ این خانه را روشن کنید</h1>
        <section class="blu-home">
        <div id="base" class="house">
            <div id="matrix" class="matrix"></div>
        </div>

        </section>


    <section class="bottom-home">
        <div class="form_pay">
            <?php   echo do_shortcode('[gravityform id="4"]'); ?>
        </div>
        <div class=" text_pay">
            <h4>توضیحات</h4>
            <p>
                توضیحات لازم در مورد این طرح
            </p>

        </div>


    </section>





    <?php
    global $wpdb;
$donors_count = $wpdb->get_var( $wpdb->prepare(
    "SELECT COUNT(*) AS id FROM {$wpdb->prefix}gf_entry WHERE payment_status='Paid' AND form_id=8"

) );
    $simple=30;
?>



</div>
<script>
    //Code For New Home landing Page
    var demo = document.getElementById("demo"),
        matrix = document.getElementById("matrix"),
        base = document.getElementById("base"),
        mat = new Array(),
        rotationL = 0,
        rotationR = 0;

    // Positioning Base
    // var parWidth = window.getComputedStyle(base.parentNode).width;
    // parWidth = parWidth.slice(0, parWidth.length-2);
    // var baseWidth = window.getComputedStyle(base).width;
    // baseWidth = baseWidth.slice(0, baseWidth.length-2);
    // base.style.left = (parWidth/2) - (baseWidth/2)  + "px";

    // Filling matrix
    function newLine(){
        var line = new Array();
        for (var i = 0; i < 400; i++){
            var led = document.createElement("div");
            led.onclick = function(){onOff(this)};
            led.className = "led off";
            matrix.appendChild(led);
            line[i] = led;
        }
        return line;
    }
    for (var i = 0; i < 1; i++)
        mat[i] = newLine();

    function write (arr) {
        var i = 0;
        var j = 0;

        while (i < arr) {
            mat[j][399-i++].className = "led";

        }

    }

    write('<?php echo $simple; ?>');


    ///end code for landing page new home
</script>

<?php
get_footer();
?>

