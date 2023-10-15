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

    <h1>Themme: <?=$theme['name']?></h1>

    <?php

    $query = 'SELECT sets.*,inventories.id,inventories.version
        FROM sets
        LEFT JOIN inventories
        ON inventories.set_num = sets.set_num
        WHERE theme_id = '.$theme['id'].'
        ORDER BY name';
    $result = mysqli_query($connect, $query);

    ?>

    <h2>Sets</h2>

    <?php while($set = mysqli_fetch_assoc($result)): ?>

        <hr>

        <h3>Set: <?=$set['name']?></h3>


        <a href="/set.php?id=<?=$set['id']?>">Set Details</a>

        <br><br>

        Full Set Data:
        <pre><?php print_r($set); ?></pre>

    <?php endwhile; ?>

</body>
</html>
