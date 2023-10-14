<?php

include('includes/connect.php');
include('includes/config.php');
include('includes/functions.php');

?>

<?php

$query = 'SELECT * 
    FROM themes
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
$result = mysqli_query($connect, $query);

$theme = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Theme | BrickMMO Parts</title>

    <link href="styles.css" type="text/css" rel="stylesheet">

</head>
<body>

    <h1><?=$theme['name']?></h1>

    <?php

    $query = 'SELECT * 
        FROM sets
        WHERE theme_id = '.$theme['id'].'
        ORDER BY name';
    $result = mysqli_query($connect, $query);

    ?>

    <h2>Sets</h2>

    <?php while($set = mysqli_fetch_assoc($result)): ?>

        <?=$set['name']?>

        <br>

        <a href="/set.php?id=<?=$set['set_num']?>">Set Details</a>

        <br>

        <pre><?php print_r($set); ?></pre>

        <hr>

    <?php endwhile; ?>


</body>
</html>
