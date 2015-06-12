<?php

class AddressDAO extends DAO {

    public function getByEmail($email) {
        $dql = 'SELECT a FROM Address a WHERE a.email = ?1';
        $query = $this->entityManager->createQuery($dql);
        $query->setParameter(1, $email);
        $adress = $query->getSingleResult();
        return $adress;
    }

    public function getByUser($idUser) {
        $dql = 'SELECT a FROM Address a WHERE a.proprietaire = ?1';
        $query = $this->entityManager->createQuery($dql);
        $query->setParameter(1, $idUser);
        $address = $query->getSingleResult();
        return $address;
    }

}
