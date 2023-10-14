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

    <h1>Parts</h1>

    <?php

    $query = 'SELECT * 
        FROM themes
        ORDER BY name';
    $result = mysqli_query($connect, $query);

    ?>

    <?php while($theme = mysqli_fetch_assoc($result)): ?>

        <?=$theme['name']?>

        <br>

        <a href="/theme.php?if=<?=$theme['id']?>">Theme Details</a>

        <br>

        <pre><?php print_r($theme); ?></pre>

        <hr>

    <?php endwhile; ?>


</body>
</html>
