<?php

function getNotes($pdo)
{
    return $pdo->query("SELECT * FROM notes ORDER BY created_at DESC")->fetchAll();
}

function addNote($pdo, $title, $content)
{
    $stmt = $pdo->prepare("INSERT INTO notes (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);
    // $stmt->execute([htmlspecialchars($title), htmlspecialchars($content)]);
}

function deleteNote($pdo, $id)
{
    $stmt = $pdo->prepare("DELETE FROM notes WHERE id = ?");
    $stmt->execute([$id]);
}


// Recherche par titre ou contenu
function searchNotes($pdo, $term)
{
    $searchTerm = "%$term%";
    $stmt = $pdo->prepare(
        "SELECT * FROM notes 
         WHERE title LIKE :search OR content LIKE :search 
         ORDER BY created_at DESC"
    );
    $stmt->execute(['search' => $searchTerm]);
    return $stmt->fetchAll();
}

// Recherche uniquement par titre
function searchNotesByTitle($pdo, $term)
{
    $searchTerm = "%$term%";
    $stmt = $pdo->prepare(
        "SELECT * FROM notes 
         WHERE title LIKE :search 
         ORDER BY created_at DESC"
    );
    $stmt->execute(['search' => $searchTerm]);
    return $stmt->fetchAll();
}

// Recherche uniquement par contenu
function searchNotesByContent($pdo, $term)
{
    $searchTerm = "%$term%";
    $stmt = $pdo->prepare(
        "SELECT * FROM notes 
         WHERE content LIKE :search 
         ORDER BY created_at DESC"
    );
    $stmt->execute(['search' => $searchTerm]);
    return $stmt->fetchAll();
}
