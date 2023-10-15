<?php

include('includes/connect.php');
include('includes/config.php');
include('includes/functions.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | BrickMMO Parts</title>

    <link href="styles.css" type="text/css" rel="stylesheet">

</head>
<body>

    <h1>BrickMMO Parts</h1>

    <h2>Themes</h2>

    <?php

    $query = 'SELECT * 
        FROM themes
        ORDER BY name';
    $result = mysqli_query($connect, $query);

    ?>

    <?php while($theme = mysqli_fetch_assoc($result)): ?>

        <hr>
        
        <?php

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

        <a href="/theme.php?id=<?=$theme['id']?>">Theme Details</a>

        <br><br>

        Full Theme Data:
        <pre><?php print_r($theme); ?></pre>

        Full Set Data:
        <pre><?php print_r($set); ?></pre>

    <?php endwhile; ?>

</body>
</html>
