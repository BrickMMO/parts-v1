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

    <?php while($theme = mysqli_fetch_assoc($result)): ?>

        <hr>
        
        <?php

        /*
        Select one set from the current theme
        */
        $query = 'SELECT * 
            FROM sets
            WHERE theme_id = '.$theme['id'].'
            ORDER BY name
            LIMIT 1';
        $result2 = mysqli_query($connect, $query);

        $set = mysqli_fetch_assoc($result2)

        ?>

        <h3>Theme: <?=$theme['name']?></h3>

        Set: <?=$set['name']?>
        <br>
        Number: <?=$set['set_num']?>

        <br><br>

        <a href="theme.php?id=<?=$theme['id']?>">Theme Details</a>

        <br><br>

        Full Theme Data:
        <pre><?php print_r($theme); ?></pre>
        <?php

?>
        Full Set Data:
        <pre><?php print_r($set); ?></pre>
        <?php
        echo $set['set_num'];
        echo '<img  height=200px width=200px src="'.$set['img_url'].'"/></br>';  
 
        ?>
    <?php endwhile; ?>
<?php include('includes/footer.php');?>

