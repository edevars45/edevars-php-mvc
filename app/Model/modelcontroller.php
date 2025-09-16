<?php
namespace App\Model;                    // On déclare le namespace du modèle

class ModelController                  // Définition de la classe qui gère les données
{
    // Retourne le chemin absolu vers le fichier JSON de stockage
    private static function getStoragePath(): string
    {
        // __DIR__ = …/app/Model, on remonte de deux niveaux puis on va dans public/data
        return __DIR__ . '/../../public/data/tasks.json';
    }

    // S’assure que le dossier et le fichier existent
    public static function ensureStorage(): void
    {
        $path = self::getStoragePath(); // chemin complet vers tasks.json
        $dir  = dirname($path);         // dossier parent de tasks.json

        if (!is_dir($dir)) {            // si le dossier n’existe pas…
            mkdir($dir, 0777, true);    // …on le crée (et tous ses parents) avec permissions 0777
        }
        if (!file_exists($path)) {      // si le fichier n’existe pas…
            file_put_contents($path, json_encode([])); // …on l’initialise à un tableau JSON vide
        }
    }

    // Lit et renvoie toutes les tâches sous forme de tableau PHP
    public static function getAll(): array
    {
        self::ensureStorage();                          // on s’assure que le fichier est prêt
        $json = file_get_contents(self::getStoragePath()); // on lit le contenu JSON
        return json_decode($json, true) ?: [];           // on décode en tableau, ou tableau vide
    }

    // Enregistre (écrase) le tableau de tâches passé en JSON
    public static function saveAll(array $tasks): void
    {
        file_put_contents(
            self::getStoragePath(),                     // chemin vers tasks.json
            json_encode($tasks, JSON_PRETTY_PRINT)      // encodage propre avec indentations
        );
    }
}
