<?php

include('includes/connect.php');
include('includes/config.php');
include('includes/functions.php');

define('PAGE_TITLE', 'Set');
include('includes/header.php');


/*
Fetch the selected set
*/
$query = 'SELECT sets.*,inventories.id,inventories.version, themes.name
    FROM sets
    LEFT JOIN inventories
    ON inventories.set_num = sets.set_num
    LEFT JOIN themes
    ON themes.id = sets.theme_id
    WHERE inventories.id = "'.$_GET['id'].'"
    LIMIT 1';
    
$result = mysqli_query($connect, $query);

$set = mysqli_fetch_assoc($result);
// echo $query;
?>

   
    <div class="container mt-4">
    <h1>Set: <?=$set['name']?></h1>
    <div class="row align-items-center">
        <div class="col-md-8">  
            <!-- <div class="set-img-container p-2"> -->
                <img class="rounded mx-auto d-block" height="300px" width="400px" style="object-fit: contain;" src=<?= $set['img_url']; ?> alt="<?= $set['name']; ?>">
            <!-- </div> -->
        </div>
        <div class="col-md-4">
                <div class="card">
                    <div class="card-header  justify-content-center" style="background-color:#FAAB36;font-size:larger;font-weight:600;">
                        Theme Details   
                    </div>
                    <div class="card-body " style="background-color:#F4F0F0;">
                        <h3 class="card-title"><?= $set['set_num']; ?></h3>
                        <h6 class="card-subtitle mb-2">Theme <?= '<b>'.$set['name'].'</b>'; ?></h6>
                        <h6 class="card-subtitle mb-2">Inventory <?= $set['num_parts']; ?></h6>
                        <h6 class="card-subtitle mb-2">Year <?= $set['year']; ?></h6>
                        
                    </div>
                </div>
        </div>
            
    </div>

    <?php

    /*
    Select all the parts that are connected to the
    selected set
    */
    $query = 'SELECT inventory_parts.*,
        parts.name AS part_name,
        part_categories.name AS category_name
        FROM inventory_parts
        LEFT JOIN parts 
        ON inventory_parts.part_num = parts.part_num
        LEFT JOIN part_categories
        ON parts.part_cat_id = part_categories.id
        WHERE inventory_id = '.$set['id'].'
        ORDER BY parts.name';
    $result = mysqli_query($connect, $query);

    ?>
<div class="container">
    <h2>Parts</h2>
    <div class="row">
    <?php while($part = mysqli_fetch_assoc($result)): ?>

        <hr>

        <?php

        /*
        Fetch the colour used in this set
        */
        $query = 'SELECT *
            FROM colors
            WHERE id = '.$part['color_id'].'
            LIMIT 1';
        $result2 = mysqli_query($connect, $query);

        $color = mysqli_fetch_assoc($result2);

        ?>

        <h3>Part: <?=$part['part_name']?></h3>
        

        <div class="col">
        <img class="rounded mx-auto d-block" src=<?= $part['img_url']; ?> alt="<?= $part['img_url']; ?>">
        </div>
        <br>
        <div class="col">
        <a href="part.php?id=<?=$part['part_num']?>">Part Details</a>

        <br>

        Full Part Data:
        <pre><?php print_r($part); ?></pre>

        Full Color Data:
        <pre><?php print_r($color); ?></pre>
        </div>
    <?php endwhile; ?>

    <h2>Minifigs</h2>

    <?php

    /*
    Here you can add code to fetch all the minifigs that 
    belong to the selected set, list them, and link to 
    a minifig.php page
    */

    ?>

<?php include('includes/footer.php');?>

