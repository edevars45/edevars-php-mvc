<?php
declare(strict_types=1);               // Mode strict des types

// 1) Affichage des erreurs en développement
ini_set('display_errors','1');
error_reporting(E_ALL);

// 2) Inclusion manuelle des fichiers PHP
require __DIR__ . '/../app/Model/modelcontroller.php';
require __DIR__ . '/../app/Controller/Controller.php';
require __DIR__ . '/../app/View/viewcontroller.php';

// 3) Import de la classe Controller via son namespace
use App\Controller\Controller;

// 4) Instanciation du contrôleur principal
$controller = new Controller();

// 5) Lecture de l’action (index, store, destroy)
$action = $_GET['action'] ?? 'index';

// 6) Routage : on appelle la méthode correspondante
if ($action === 'store') {
    $controller->store();               // ajout de tâche
} elseif ($action === 'destroy') {
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    $controller->destroy($id);          // suppression de tâche
} else {
    $controller->index();               // affichage de la liste
}
