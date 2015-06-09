<?php

/**
 * @Entity 
 * @Table(name="image_acs")
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
     * @Column(type="string", name="LOGIN", unique=true) 
     * */
    protected $login;

    /**
     * @Column(type="string", name="PASSWORD") 
     * */
    protected $password;

    /**
     * @Column(type="string", name="USER_TYPE") 
     * */
    protected $userType;

    /**
     * @OneToOne(targetEntity="Address")
     * @JoinColumn(name="ID_ADDRESS", referencedColumnName="id")
     */
    private $address;

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

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUserType() {
        return $this->userType;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
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

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setUserType($userType) {
        $this->userType = $userType;
    }

    public function getDisplayName() {
        return $this->firstName . $this->lastName;
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

}
