<?php
namespace App\Controller;              // Namespace du contrôleur

use App\Model\ModelController;       // On importe la classe modèle
use App\View\ViewController;         // On importe la classe vue

class Controller                     // Classe principale qui orchestre l’app
{
    // Route « index » : affiche la liste des tâches
    public function index(): void
    {
        $tasks = ModelController::getAll(); // on récupère toutes les tâches
        ViewController::render($tasks);     // on les passe à la vue pour affichage
    }

    // Route « store » : stocke une nouvelle tâche envoyée en POST
    public function store(): void
    {
        $new = trim($_POST['task'] ?? ''); // on prend la valeur envoyée, ou chaîne vide
        if ($new !== '') {                 // si ce n’est pas vide…
            $tasks = ModelController::getAll(); // …on lit l’existant
            $tasks[] = ['title' => $new];       // on ajoute la nouvelle tâche
            ModelController::saveAll($tasks);   // on réécrit le fichier JSON
        }
        header('Location: /'); // on redirige vers la page d’accueil
        exit;                  // on arrête l’exécution
    }

    // Route « destroy » : supprime une tâche d’après son ID
    public function destroy(?int $id): void
    {
        if ($id !== null) {                      // si un ID a été passé…
            $tasks = ModelController::getAll();  // on récupère les tâches
            if (isset($tasks[$id])) {            // si l’ID existe bien…
                array_splice($tasks, $id, 1);    // on supprime l’entrée du tableau
                ModelController::saveAll($tasks);// on réécrit le JSON
            }
        }
        header('Location: /'); // redirection vers l’index
        exit;                  // fin du script
    }
}
