<?php
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../models/noteModel.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        addNote($pdo, $_POST['title'], $_POST['content']);
    }
    header("Location: index.php");
    exit;
}

if (isset($_GET['delete'])) {
    deleteNote($pdo, $_GET['delete']);
    header("Location: index.php");
    exit;
}

$notes = getNotes($pdo);

// systeme de recherche
$search = $_GET['search'] ?? '';
$filter = $_GET['filter'] ?? 'both';

if ($search) {
    if ($filter === 'title') {
        $notes = searchNotesByTitle($pdo, $search);
    } elseif ($filter === 'content') {
        $notes = searchNotesByContent($pdo, $search);
    } else {
        $notes = searchNotes($pdo, $search);
    }
} else {
    $notes = getNotes($pdo);
}
