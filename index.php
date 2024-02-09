<?php

include('includes/connect.php');
include('includes/config.php');
include('includes/functions.php');

define('PAGE_TITLE', 'Home');
include('includes/header.php');

?>



<h1>BrickMMO Parts</h1>

<h2>Themes</h2>

<?php

/*
    Run a query to fecth all the themes
    */
$query = 'SELECT * 
        FROM themes
        ORDER BY name';
$result = mysqli_query($connect, $query);

?>

<div class="container">
    <div class="row row-cols-3">
        <?php while ($theme = mysqli_fetch_assoc($result)) : ?>



            <?php

            /*
        Select one set from the current theme
        */
            $query = 'SELECT * 
            FROM sets
            WHERE theme_id = ' . $theme['id'] . '
            ORDER BY name
            LIMIT 1';
            $result2 = mysqli_query($connect, $query);

            $set = mysqli_fetch_assoc($result2)

            ?>

            <!-- <h3>Theme: <?= $theme['name'] ?></h3>

        Set: <?= $set['name'] ?>
        <br>
        Number: <?= $set['set_num'] ?> -->



            <!-- Full Theme Data: -->
            <!-- <pre><?php // print_r($theme); 
                        ?></pre> -->
            <?php

            ?>
            <!-- Full Set Data: -->
            <!-- <pre><?php //print_r($set); 
                        ?></pre> -->
            <?php
            if ($set['img_url']) {
            ?>

                <div class="col">
                    <a href="theme.php?id=<?= $theme['id'] ?>">
                        <img class="rounded mx-auto d-block" height="200px" width="200px" src=<?= $set['img_url']; ?> alt="<?= $set['name']; ?>">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $set['name']; ?></h5>
                        </br>
                    </div>
                </div>
        <?php
            }
        endwhile; ?>
    </div>
</div>
<?php include('includes/footer.php'); ?>