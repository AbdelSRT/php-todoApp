<?php
include 'data.php';

$id = $_REQUEST['id'] ?? null;
$done = $_REQUEST['done'] === '1' ? false : true;

if ($id) {
    $tasks = get_tasks();

    $tasks = array_map(function ($task) use ($id, $done) {
        if ($task['id'] == $id) {
            $task['done'] = $done;
        }

        return $task;
    }, $tasks);

    save_tasks($tasks);
}

//header('Location: overview.php');
