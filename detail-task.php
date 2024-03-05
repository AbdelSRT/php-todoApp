<?php
include 'data.php';
$id = $_REQUEST['id'] ?? null;


if (!$id) {
    header('Location: overview.php');
    exit;
}
$tasks = get_tasks();
$found_task = array_filter($tasks, function ($task) use ($id) {
    return $task['id'] == $id;
});

$task = array_values($found_task)[0];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <link rel="stylesheet" href="extras/style.css">
</head>

<body>
    <?php include "nav.php" ?>
    <div class="container" style="width: 100%;">
        <h1>Task Details</h1>
        <table>
            <tr>
                <th class="title">Titel</th>
                <th class="id">Beschrijving</th>
                <th class="bool">Gedaan?</th>
            </tr>
            <tr>
                <td><?php echo $task['title'] ?></td>
                <?php if ($task['description']) : ?>
                    <td><?php echo $task['description'] ?></td>
                <?php else : ?>
                    <td>Geen beschrijving</td>
                <?php endif; ?>
                <?php if ($task['done'] === true) : ?>
                    <td><?php echo "Ja" ?></td>
                <?php else : ?>
                    <td><?php echo "Nee" ?></td>
                <?php endif; ?>
            </tr>
        </table>

        <?php echo "<br>" ?>
    </div>


</body>

</html>