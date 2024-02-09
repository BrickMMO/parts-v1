<?php

include('includes/connect.php');
include('includes/config.php');
include('includes/functions.php');

define('PAGE_TITLE', 'Home');
include('includes/header.php');
?>

<h2>Themes</h2>

<?php
/* Run a query to fecth all the themes */
$query = 'SELECT * 
        FROM themes
        ORDER BY name';
$result = mysqli_query($connect, $query);
?>

<div class="container mt-4">
    <div class="row">
        <?php
        while ($theme = mysqli_fetch_assoc($result)) :
            /* Select one set from the current theme */
            $query = 'SELECT * 
            FROM sets
            WHERE theme_id = ' . $theme['id'] . '
            ORDER BY name
            LIMIT 1';
            $result2 = mysqli_query($connect, $query);
            if (mysqli_num_rows($result2) > 0) {
                $set = mysqli_fetch_assoc($result2)
        ?>
                <div class="col-3 mb-4">
                    <a class="text-decoration-none mb-4" href="theme.php?id=<?= $theme['id'] ?>">
                        <div class="card justify-content-center" style="width:300px; height:370px; overflow: hidden;">
                            <div class="parts-card-img-container p-2">
                                <img class="rounded mx-auto d-block " src=<?= $set['img_url']; ?> alt="<?= $set['name']; ?>">
                            </div>
                            <div class="card-body" style="height: 50%; overflow-y:auto">
                                <h3 class="card-title" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; "><?= $theme['name']; ?></h3>
                                <h6 class="card-subtitle text-muted">Set: <?= $set['name']; ?></h6>
                                <p class="card-text">Number: <?= $set['set_num']; ?></p>
                                </br>
                            </div>
                        </div>
                    </a>
                </div>
        <?php
            }
        endwhile; ?>
    </div>
</div>
<?php include('includes/footer.php'); ?>