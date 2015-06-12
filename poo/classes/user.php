<?php

/**
 * @Entity 
 * @Table(name="USER")
 * 
 */
class User extends BaseEntiteIntermediaire {

    /**
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue 
     * */
    protected $id;

    /**
     * @Column(type="string", name="LAST_NAME") 
     * */
    protected $lastName;

    /**
     * @Column(type="string", name="FIRST_NAME") 
     * */
    protected $firstName;

    /**
     * @Column(type="datetime", name="BIRTH_DATE") 
     * */
    protected $birthDate;

    /**
     * @Column(type="string", name="OPENID", unique=true) 
     * */
    protected $openId;

    /**
     * @Column(type="string", name="USER_TYPE") 
     * */
    protected $userType;   

    public function getId() {
        return $this->id;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function getUserType() {
        return $this->userType;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }

    public function setUserType($userType) {
        $this->userType = $userType;
    }

    public function getDisplayName() {
        return $this->firstName . $this->lastName;
    }

    public function getOpenId() {
        return $this->openId;
    }

    public function setOpenId($openId) {
        $this->openId = $openId;
    }

    public function getHomePage() {
        
    }

    public function getOrderCriteria() {
        return 'nom';
    }

    public function getPrimaryKey() {
        return $this->id;
    }

    public function getSimpleName() {
        return 'User';
    }

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }

}
