<?php 
include "head.php";
$page = 'foru_in_line';

include "DataManager.php";
$manager = new DataManager('42_data.json');

?>

<style>
    a.btn {
        margin: 5px;
    }
</style>

<div class="container"> 
    <?php include "navigation.php";?>

    <form action="">
        <div class="mb-3">
            <label for="link-amount" class="form-label" >Amount of links</label>
            <input id="link-amount" name="amount" type="number" class="form-control" >
        </div>
        <div class="mb-3">
        <button type="submit" class="btn btn-info">submit</button>
        </div>
    </form>

    <?php
    if (array_key_exists('amount', $_GET)) {
        $amount = (int) $_GET['amount'];
    }
    else {
        $amount = $manager->get('amount', 0);
        if ($amount == '') {
            $amount = 42;
        }
    }
    $manager->save('amount', 0, $amount);
    print($i);

    for ($i = 1; $i <= $amount; $i++){
        if ($i % 6 === 0) {
            echo "<a href='?id=$i' class='btn btn-danger'> $i </a>";
        }
        else {
            echo "<a href='?id=$i' class='btn btn-dark'> $i  </a>";
        }
    }  
    ?>
</div>