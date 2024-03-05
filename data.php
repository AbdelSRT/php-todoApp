<?php
function get_tasks()
{
    $file = 'extras/tasks.json';

    if (file_exists($file)) {
        $handle = fopen($file, 'r');
        $content = fread($handle, filesize($file));
        fclose($handle);

        $data = json_decode($content, true);

        return $data;
    }

    return [];
}

function save_tasks($tasks)
{
    $file = 'extras/tasks.json';
    $handle = fopen($file, 'w');
    fwrite($handle, json_encode($tasks));
    fclose($handle);
}

function add_task($task)
{
    $tasks = get_tasks();
    $highestId = array_reduce($tasks, function ($carry, $task) {
        return $task['id'] > $carry ? $task['id'] : $carry;
    }, 0);
    $task['id'] = $highestId + 1;
    $task['done'] = false;
    $tasks[] = $task;
    save_tasks($tasks);
}
