<?php

use App\Autoloader;
use App\Models\AnnoncesModel;
use App\Models\UsersModel;

require_once 'Autoloader.php';

Autoloader::register();

// $model = new AnnoncesModel;

//-----affiche tout nos acticles

// echo '<pre>';
// var_dump($model->findAll());
// echo '</pre>';

//------affiche les éléments qui comporte actif = 1

// $annonces = $model->findBy(['actif' => 1]);
// echo '<pre>';
// var_dump($annonces);
// echo '</pre>';

//-----affiche l'element qui à un id = 1

// $annonces = $model->find(1);
// echo '<pre>';
// var_dump($annonces);
// echo '</pre>';

// $annonce = $model
//     ->setTitle('Nouvelle annonce')
//     ->setDescription('Nouvelle description')
//     ->setActif(1);

// $donnees = [
//     'title' => 'Annonce modifier',
//     'description' => 'Description de l\'annonce modifier',
//     'actif' => 0
// ];

// $annonce = $model->hydrate($donnees);

// $model->delete(5);
// echo '<pre>';
// var_dump($annonce);
// echo '</pre>';

$model = new UsersModel;
 

$user = $model->setEmail('contact@nouvelle-techno.fr')
    ->setPassword(password_hash('azerty', PASSWORD_ARGON2I));

$model->create($user);
echo '<pre>';
 var_dump($user);
 echo '</pre>';

?>