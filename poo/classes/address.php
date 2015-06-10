<?php

/**
 * @Entity 
 * @Table(name="ADDRESS")
 * 
 */
class Address extends BaseEntiteIntermediaire {

    /**
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue 
     * */
    protected $id;

    /**
     * @Column(type="integer", name="FONE_NUMBER") 
     * */
    protected $foneNumber;

    /**
     * @Column(type="string", name="EMAIL", unique = true) 
     * */
    protected $email;

    /**
     * @Column(type="text", name="ADRESS_TEXT") 
     * */
    protected $addressText;

    /**
     * @Column(type="integer", name="POSTAL_CODE") 
     * */
    protected $postalCode;

    /**
     * @Column(type="string", name="CITY") 
     * */
    protected $city;

    /**
     * @Column(type="string", name="COUNTRY") 
     * */
    protected $country;

    public function getId() {
        return $this->id;
    }

    public function getFoneNumber() {
        return $this->foneNumber;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAddressText() {
        return $this->addressText;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function getCity() {
        return $this->city;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFoneNumber($foneNumber) {
        $this->foneNumber = $foneNumber;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setAddressText($addressText) {
        $this->addressText = $addressText;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getDisplayName() {
        
    }

    public function getHomePage() {
        
    }

    public function getOrderCriteria() {
        
    }

    public function getPrimaryKey() {
        return $this->id;
    }

    public function getSimpleName() {
        return 'Address';
    }

}
