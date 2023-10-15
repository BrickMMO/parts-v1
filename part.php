<?php

include('includes/connect.php');
include('includes/config.php');
include('includes/functions.php');

?>

<?php

$query = 'SELECT parts.*
    FROM parts
    WHERE part_num = '.$_GET['id'].'
    LIMIT 1';
$result = mysqli_query($connect, $query);

$part = mysqli_fetch_assoc($result);

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

    <h1>Part: <?=$part['name']?></h1>

    <?php

    $query = 'SELECT colors.*
        FROM colors
        LEFT JOIN elements 
        ON color_id = id
        WHERE part_num = '.$part['part_num'].'
        ORDER BY name';
    $result = mysqli_query($connect, $query);

    ?>

    <h2>Colours</h2>

    <?php while($color = mysqli_fetch_assoc($result)): ?>

        <hr>

        <h3>Color: <?=$color['name']?></h3>

        <a href="/color.php?id=<?=$part['part_num']?>">Part Details</a>

        <br><br>

        Full Color Data:
        <pre><?php print_r($color); ?></pre>

    <?php endwhile; ?>

</body>
</html>
