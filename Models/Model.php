<?php

namespace App\Models;
use App\Db\Db;

class Model extends Db
{
    // table de la base de données
    protected $table;

    // Instance de Db
    private $db;

    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }
    public function findBy( array $criteres)
    {
        $champs = [];
        $valeurs = [];
        // on va boucler pour éclater le tableau
        foreach ($criteres as $champ => $valeur) {
            // SELECT * FROM annonce WHERE actif = ?
            // bindValue(1, valeur)
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }
        // on transforme le tableau champs en chaine de carractere
        $liste_champs = implode(' AND ', $champs);
        // on execute la requete
        return $this->requete('SELECT * FROM '. $this->table.' WHERE '.$liste_champs, $valeurs)->fetchAll();
    }
    public function find(int $id)
    {
        return $this->requete("SELECT * FROM $this->table WHERE id = $id")->fetch();
    }

    public function create(Model $model){
        $champs = [];
        $inter = [];
        $valeurs = [];
        // on va boucler pour éclater le tableau
        foreach ($model as $champ => $valeur) {
            // INSERT INTO annonce (title, description , actif) VALUES (?,?,?)
            // bindValue(1, valeur)
            if($valeur != null && $champ != 'db' && $champ != 'table'){
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }
        // on transforme le tableau champs en chaine de carractere
        $liste_champs = implode(' , ', $champs);
        $liste_inter = implode(' , ', $inter);

        // on execute la requete
        return $this->requete('INSERT INTO '. $this->table.' ('. $liste_champs. ') VALUES('.$liste_inter.')', $valeurs);
    }
    public function update(int $id, Model $model)
    {
        $champs = [];
        $valeurs = [];
        // on va boucler pour éclater le tableau
        foreach ($model as $champ => $valeur) {
            // UPDATE annonce SET title = ? , description = ? , actif = ? WHERE id = ?
            // bindValue(1, valeur)
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;
        // on transforme le tableau champs en chaine de carractere
        $liste_champs = implode(' , ', $champs);

        // on execute la requete
        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . 'WHERE id = ?', $valeurs);
    }

    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    public function requete( string $sql, array $attributs = null)
    {
        // on récupère l'instance de Db
        $this->db = Db::getInstance();
        // on vérifie si on a des attributs
        if($attributs !== null){
            // requete préparer
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }else{
            // Requete simple
            return $this->db->query($sql);
        }
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // on récupère le nom du setter correspondant à la clé (key)
            // title -> setTitle
            $setter = 'set' . ucfirst($key);
            // on vérifie si le setter existe
            if(method_exists($this, $setter)){
                // on appelle le setter
                $this->$setter($value);
            }
        }
        return $this;
    }
}
?>