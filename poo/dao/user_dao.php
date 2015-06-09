<?php

class UserDAO extends DAO {

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
        return parent::supprimer($user);
    }

}
