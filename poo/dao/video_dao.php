<?php

class VideoDAO extends DAO {

    public function listByUser($idUser) {
        $dql = 'SELECT v FROM Video v WHERE v.owner = ?1';
        $query = $this->entityManager->createQuery($dql);
        $query->setParameter(1, $idUser);
        $videos = $query->getResult();
        return $videos;
    }

    public function supprimer(BaseEntite $video) {
        if (deleteVideo($video)) {
            deleteFile($video->getAccessURL());
            return parent::supprimer($video);
        }
        return false;
    }

}
