<?php

//bootstrap.php


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once "vendor/autoload.php";
require_once 'classes/bases/base_entite.php';
require_once 'classes/bases/base_entite_intermediaire.php';
require_once 'constantes_fonctions/constantes.php';
//require_once 'constantes_fonctions/constantes_include.php';
require_once 'constantes_fonctions/fonctions.php';
//require_once 'constantes_fonctions/fonctions_include.php';
require_once('phpass/PasswordHash.php');
require_once 'constantes_fonctions/data_base_configurations.php';
require_once 'PHPMailer/PHPMailerAutoload.php';
require_once'vendor/facebook/php-sdk-v4/autoload.php';
//Create a simple default Doctrine ORM configuration for annotations
//$isDevMode = true;
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
//or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);
//require files
$isDevMode = true;
$paths = array(__DIR__ . "/classes");
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

// the connection configuration
$dbParams = array(
    'dbname' => DB_NAME,
    'user' => DB_USER,
    'password' => DB_PASSWORD,
    'host' => DB_HOST,
    'port' => DB_HOST_PORT,
    'driver' => DB_DRIVER,
);

//obtaining entityManager
$entityManager = EntityManager::create($dbParams, $config);

interface IDAO {

    public function getEntityManager();

    public function ajouter(BaseEntite $entite);

    public function recuperer(BaseEntite $entite, $id);

    public function modifier(BaseEntite $entite, $id, array $attributs);

    public function supprimer(BaseEntite $entite);

    public function lister(BaseEntite $entite);

    public function recupererParSimpleName($simpleName, $id);
}

class DAO implements IDAO {

    private $isDevMode;
    private $paths;
    private $config;
    private $dbParams;
    protected $entityManager;

    public function __construct() {
        $this->isDevMode = true;
        $this->paths = array(__DIR__ . "/classes");
        $this->config = Setup::createAnnotationMetadataConfiguration($this->paths, $this->isDevMode);
        $this->dbParams = array(
            'dbname' => DB_NAME,
            'user' => DB_USER,
            'password' => DB_PASSWORD,
            'host' => DB_HOST,
            'port' => DB_HOST_PORT,
            'driver' => DB_DRIVER,
        );
        $this->entityManager = EntityManager::create($this->dbParams, $this->config);
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function ajouter(BaseEntite $entite) {
        try {
            $this->entityManager->persist($entite);
            $this->entityManager->flush();
            $this->entityManager->clear();
        } catch (Exception $ex) {
            
        }
    }

    public function recuperer(BaseEntite $entite, $id) {
        try {
            $entite = $this->entityManager->find($entite->getSimpleName(), $id);
            return $entite;
        } catch (Exception $ex) {
            $this->traduireExeption($ex);
        }
    }

    public function recupererParSimpleName($simpleName, $id) {
        try {
            $entite = $this->entityManager->find($simpleName, $id);
            return $entite;
        } catch (Exception $ex) {
            $this->traduireExeption($ex);
        }
    }

    public function modifier(BaseEntite $entite, $id, array $attributs) {
        $entite = $this->recuperer($entite, $id);
        $entite->hydrate($attributs);
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    function supprimer(BaseEntite $entite) {
        try {
            $this->entityManager->remove($entite);
            $this->entityManager->flush();
            $this->entityManager->clear();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    function lister(BaseEntite $entite) {
//        $entityRepository = $this->entityManager->getRepository($entite->getSimpleName());
//        $entities = $entityRepository->findAll();
//        return $entities;
        return $this->listerParOrdre($entite);
    }

    function listerParOrdre(BaseEntite $entite) {
        $dql = 'SELECT e FROM ' . $entite->getSimpleName() . ' e ORDER BY e.' . $entite->getOrderCriteria() . ' ASC';
        $query = $this->entityManager->createQuery($dql);
        $entites = $query->getResult();
        return $entites;
    }

    function traduireExeption(Exception $ex) {
        echo "Exception " . $ex->getCode() . " in file " . $ex->getFile() . " on line " . $ex->getLine() . " \n " . $ex->getMessage();
    }

}

require_once 'classes/user.php';
require_once 'classes/address.php';
require_once 'classes/video.php';
require_once 'dao/user_dao.php';
require_once 'dao/address_dao.php';
require_once 'dao/video_dao.php';
require_once 'utils/facebook_utils.php';
//require_once 'utils/thread.php';

