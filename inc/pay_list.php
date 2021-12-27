<?php

include 'list_setup.php';

$exampleListTable = new Example_List_Table();
$exampleListTable->prepare_items();
?>
    <div class="wrap">
        <h2>لیست پرداخت‌ها</h2>
        <?php $exampleListTable->display(); ?>
    </div>
<?php