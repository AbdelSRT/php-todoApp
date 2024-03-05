<?php
include 'data.php';
$id = $_GET['id'];


$tasks = get_tasks();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            display: flex;
            justify-content: space-around;
        }

        .title {
            margin-top: 2rem;
            font-size: xx-large;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .desc {
            margin-top: 2rem;
            font-size: xx-large;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <h1>Taak wijzigen</h1>
    <?php foreach ($tasks as $task) : ?>
        <?php if ($task['id'] === $id) : ?>
            <div class="container">
                <form action="">
                    <label for="title">Title</label><br>
                    <input type="text" placeholder="Voeg een titel toe" name="title"><br>
                    <label for="description">Beschrijving</label><br>
                    <input type="text" placeholder="Voeg een beschrijving toe" name="description">
                </form>
            </div>



            <?php echo "<br>" ?>
        <?php endif; ?>
    <?php endforeach; ?>

</body>

</html>