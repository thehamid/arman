<?php

//include "donors_list.php";
//
//    //Create an instance of our package class...
//    $testListTable = new TT_Example_List_Table();
//    //Fetch, prepare, sort, and filter our data...
//    $testListTable->prepare_items();
//
//    ?>
<!--    <div class="wrap">-->
<!---->
<!--        <div id="icon-users" class="icon32"><br/></div>-->
<!--        <h2> لیست پرداخت‌ها </h2>-->
<!---->
<!---->
<!---->
<!--        <form id="movies-filter" method="get">-->
<!---->
<!--            <input type="hidden" name="page" value="--><?php //echo $_REQUEST['page'] ?><!--" />-->
<!---->
<!--            --><?php //$testListTable->display() ?>
<!--        </form>-->
<!---->
<!--    </div>-->
<!--    --><?php


include 'list_setup.php';

$exampleListTable = new Example_List_Table();
$exampleListTable->prepare_items();
?>
    <div class="wrap">
        <h2>لیست پرداخت‌ها</h2>
        <?php $exampleListTable->display(); ?>
    </div>
<?php