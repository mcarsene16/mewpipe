<?php

interface entite {

    public function getSimpleName();

    public function getPrimaryKey();

    public function hydrate(array $attributs);

    public function getDisplayName();

    public function getOrderCriteria();

    public function getHomePage();
}

/**
 *  @MappedSuperclass 
 */
abstract class BaseEntite implements entite {

    protected $attributs;

    public function __construct(array $attributs) {
        $this->hydrate($attributs);
    }

    public function hydrate(array $attributs) {
        foreach ($attributs as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key);
            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

}

?>