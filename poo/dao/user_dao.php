<?php

class UserDAO extends DAO {

    public function ajouter(User $user) {
        $addressDAO = new AddressDAO();
        $addressDAO->ajouter($user->getAddress());
        $address = $addressDAO->getByEmail($user->getAddress()->getEmail());
        $user->setAddress($address);
        parent::ajouter($user);
    }

    public function supprimer(User $user) {
        $videoDAO = new VideoDAO();
        $addressDAO = new AddressDAO();
        //récupération de la liste des vidéos de l'utilisateur
        $userVideos = $videoDAO->listByUser($user->getId());
        //suppression de chaque élément de la liste
        foreach ($userVideos as $video) {
            $videoDAO->supprimer($video);
        }
        //suppression de l'adresse de l'utilisateur
        $addressDAO->supprimer($user->getAddress());
        //suppression de son dossier de vidéos
        deleteUserPersonnalFolder($user);
        return parent::supprimer($user);
    }

    public function getByUserName($username) {
        $dql = 'SELECT u FROM User u WHERE u.login = ?1';
        $query = $this->entityManager->createQuery($dql);
        $query->setParameter(1, $username);
        $user = $query->getSingleResult();
        return $user;
    }

}
