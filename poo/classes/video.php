<?php

/**
 * @Entity 
 * @Table(name="VIDEO")
 * 
 */
class Video extends BaseEntiteIntermediaire {

    /**
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue 
     * */
    protected $id;

    /**
     * @Column(type="string", name="TITLE", unique=true) 
     * */
    protected $title;

    /**
     * @Column(type="string", name="ACCES_URL", unique=true) 
     * */
    protected $accessURL;

    /**
     * @Column(type="string", name="CONFIDENTIALITY_PROFILE") 
     * */
    protected $confidentialityProfile;

    /**
     * @Column(type="float", name="SIZE") 
     * */
    protected $size;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="ID_USER", referencedColumnName="id")
     */
    private $owner;

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAccessURL() {
        return $this->accessURL;
    }

    public function getConfidentialityProfile() {
        return $this->confidentialityProfile;
    }

    public function getSize() {
        return $this->size;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAccessURL($accessURL) {
        $this->accessURL = $accessURL;
    }

    public function setConfidentialityProfile($confidentialityProfile) {
        $this->confidentialityProfile = $confidentialityProfile;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function setOwner($owner) {
        $this->owner = $owner;
    }

    public function getDisplayName() {
        return $this->title;
    }

    public function getHomePage() {
        
    }

    public function getOrderCriteria() {
        return 'title';
    }

    public function getPrimaryKey() {
        return $this->id;
    }

    public function getSimpleName() {
        return 'Video';
    }

}
