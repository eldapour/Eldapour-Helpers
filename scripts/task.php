<?php

function saveTask($project, $task)
{
    $fileName = 'tasks.json';
    $date = date('d-m-Y');  // Use the current date

    // Read existing data from the JSON file
    $data = json_decode(file_get_contents($fileName), true);

    // If the structure is not already initialized, initialize it
    if (!$data) {
        $data = [];
    }

    // Create a new task entry
    $data['daily report'][$date][$project]['tasks'][] = $task;

    // Save the updated data back to the JSON file
    file_put_contents($fileName, json_encode($data, JSON_PRETTY_PRINT));

    echo "Task saved successfully!\n";
}

// Check if enough command-line arguments are provided
if ($argc < 3) {
    die("Usage: php file.php project task\n");
}

// Get command-line arguments
$project = $argv[1];
$task = $argv[2];

// Call the saveTask function with the provided arguments
saveTask($project, $task);
