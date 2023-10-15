<?php

include('includes/connect.php');
include('includes/config.php');
include('includes/functions.php');

?>

<?php

/*
Fetch the selected set
*/
$query = 'SELECT sets.*,inventories.id,inventories.version
    FROM sets
    LEFT JOIN inventories
    ON inventories.set_num = sets.set_num
    WHERE inventories.id = "'.$_GET['id'].'"
    LIMIT 1';
$result = mysqli_query($connect, $query);

$set = mysqli_fetch_assoc($result);

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

    <a href="/">Home</a>

    <h1>Set: <?=$set['name']?></h1>

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

    <h2>Parts</h2>

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

        Color: <?=$color['name']?>

        <br><br>

        <a href="/part.php?id=<?=$part['part_num']?>">Part Details</a>

        <br><br>

        Full Part Data:
        <pre><?php print_r($part); ?></pre>

        Full Color Data:
        <pre><?php print_r($color); ?></pre>

    <?php endwhile; ?>

    <h2>Minifigs</h2>

    <?php

    /*
    Here you can add code to fetch all the minifigs that 
    belong to the selected set, list them, and link to 
    a minifig.php page
    */

    ?>

</body>
</html>
