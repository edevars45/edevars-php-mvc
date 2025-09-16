<?php
namespace App\View;                     // Namespace de la vue

class ViewController                  // Classe qui génère le HTML
{
    // Affiche la TODO-list et le formulaire d’ajout
    public static function render(array $tasks): void
    {
        echo "<h1>Ma TODO List</h1><ul>";            // Titre et début de la liste
        foreach ($tasks as $idx => $task) {          // Pour chaque tâche…
            $title = htmlspecialchars($task['title']); // …on échappe le titre
            // on affiche la ligne + lien de suppression
            echo "<li>{$title} 
                    <a href=\"?action=destroy&id={$idx}\">[supprimer]</a>
                  </li>";
        }
        echo "</ul>";                                // Fin de la liste

        // Formulaire HTML pour ajouter une nouvelle tâche
        echo <<<HTML
        <form method="POST" action="?action=store">
            <input name="task" placeholder="Nouvelle tâche">
            <button>Ajouter</button>
        </form>
        HTML;
    }
}
