<?php

class UserDAO extends DAO {

    public function supprimer(BaseEntite $user) {
        $videoDAO = new VideoDAO();
        $addressDAO = new AddressDAO();
        //récupération de la liste des vidéos de l'utilisateur
        $userVideos = $videoDAO->listByUser($user->getId());
        //suppression de chaque élément de la liste
        foreach ($userVideos as $video) {
            $videoDAO->supprimer($video);
        }
        //suppression de son dossier de vidéos
        deleteUserPersonnalFolder($user);
        //suppression de l'adresse de l'utilisateur
        $currentUserAddress = $addressDAO->getByUser($user->getId());
        $addressDAO->supprimer($currentUserAddress);
        //suppression de l'utilisateur
        return parent::supprimer($user);
    }

    public function getByOpenId($openId) {
        $dql = 'SELECT u FROM User u WHERE u.openId = ?1';
        $query = $this->entityManager->createQuery($dql);
        $query->setParameter(1, $openId);
        $user = $query->getSingleResult();
        return $user;
    }

}
