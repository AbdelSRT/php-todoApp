<?php
include 'data.php';
$id = $_REQUEST['id'] ?? null;

if (!$id) {
    header('Location: overview-tasks.php');
    exit;
}
$tasks = get_tasks();
$local_task = array_filter($tasks, function ($task) use ($id) {
    return $task['id'] == $id;
});

$task = array_values($local_task)[0];

$task_updated = false;

if (isset($_REQUEST['submit'])) {
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $tasks = array_map(function ($task) use ($title, $description, $id) {
        if (isset($_REQUEST['done']) && $_REQUEST['done'] === 'on') {
            $done = true;
        } else {
            $done = false;
        }
        if ($task['id'] == $id) {
            $task['title'] = $title;
            $task['description'] = $description;
            $task['done'] = $done;
        }
        return $task;
    }, $tasks);



    save_tasks($tasks);
    $task = array_values(array_filter($tasks, function ($task) use ($id) {
        return $task['id'] == $id;
    }))[0];
    $task_updated = true;
}
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

        body {
            padding: 2rem;
        }

        input {
            padding: 0.5rem 1rem;
        }

        input[type="submit"],
        input[type="checkbox"] {
            padding: 0.5rem 1rem;
            background-color: lightblue;
            border: none;
            cursor: pointer;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
        }

        .notification {
            background-color: lightgreen;
            padding: 1rem;
            margin-top: 1rem;
        }

        .form-item {
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>
    <h1>Taak wijzigen</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $task['id'] ?>" method="post">
        <div class="form-item">
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" placeholder="Titel" value="<?= $task['title'] ?>" />
        </div>

        <div class="form-item">
            <label for="description">Omschrijving</label>
            <input type="text" name="description" id="description" placeholder="Omschrijving" value="<?= $task['description'] ?>" />
        </div>

        <div class="form-item">
            <label for="done">Klaar
                <?php if ($task['done']) : ?>
                    <input type="checkbox" name="done" id="done" checked />
                <?php else : ?>
                    <input type="checkbox" name="done" id="done" />
                <?php endif; ?>
            </label>
        </div>

        <div class="actions">
            <input type="submit" value="Wijzigen" name="submit" />
        </div>
    </form>
    <?php if ($task_updated) : ?>
        <div class="notification">Taak gewijzigd!</div>
    <?php endif; ?>

</body>

</html>