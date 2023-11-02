<?php

namespace App\Models;

class AnnoncesModel extends Model
{
        protected $id;
        protected $title;
        protected $description;
        protected $created_at;
        protected $actif;
        
    public function __construct()
    {
        $this->table = 'annonce';
    }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of created_at
         */ 
        public function getCreated_at()
        {
                return $this->created_at;
        }

        /**
         * Set the value of created_at
         *
         * @return  self
         */ 
        public function setCreated_at($created_at)
        {
                $this->created_at = $created_at;

                return $this;
        }

        /**
         * Get the value of actif
         */ 
        public function getActif()
        {
                return $this->actif;
        }

        /**
         * Set the value of actif
         *
         * @return  self
         */ 
        public function setActif($actif)
        {
                $this->actif = $actif;

                return $this;
        }
}
 ?>