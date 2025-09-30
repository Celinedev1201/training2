<?php
// router.php
require 'controllers/noteController.php';

$route = $_GET['route'] ?? 'notes.index';

switch ($route) {
    case 'notes.index':
        indexNotes();
        break;
    case 'notes.store':
        storeNote();
        break;
    case 'notes.delete':
        deleteNote();
        break;
    default:
        echo "404 - Page not found";
}