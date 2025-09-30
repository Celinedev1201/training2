<?php
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../models/noteModel.php';


// Affiche toutes les notes
function indexNotes()
{
    global $pdo;
    $search = $_GET['search'] ?? '';
    $filter = $_GET['filter'] ?? 'both';

    // Pagination
    $perPage = 16;
    $page = max(1, intval($_GET['page'] ?? 1)); // page par défaut = 1
    $offset = ($page - 1) * $perPage;

    if ($search) {
        if ($filter === 'title') {
            $notes = searchNotesByTitle($pdo, $search);
        } elseif ($filter === 'content') {
            $notes = searchNotesByContent($pdo, $search);
        } else {
            $notes = searchNotes($pdo, $search);
        }
        // ⚠️ pour simplifier, pas de pagination sur recherche (on peut l’ajouter après si tu veux)
        $totalNotes = count($notes);
    } else {
        $notes = getNotesPagination($pdo, $perPage, $offset);
        $totalNotes = countNotes($pdo);
    }

    $totalPages = ceil($totalNotes / $perPage);

    include __DIR__ . '/../views/header.php';
    include __DIR__ . '/../views/notes.php';
    include __DIR__ . '/../views/form.php';
    include __DIR__ . '/../views/footer.php';
}

// Sauvegarde une note
function storeNote()
{
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($_POST['title']) && !empty($_POST['content'])) {
            addNote($pdo, $_POST['title'], $_POST['content']);
        }
    }

    header("Location: index.php?route=notes.index");
    exit;
}

// Supprime une note
function deleteNote()
{
    global $pdo;

    if (isset($_GET['id'])) {
        deleteNoteFromDb($pdo, $_GET['id']);
    }

    header("Location: index.php?route=notes.index");
    exit;
}