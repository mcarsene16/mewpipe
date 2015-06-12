<?php
$attributsAddress = array(
    'foneNumber' => '',
    'email' => '',
    'addressText' => '',
    'postalCode' => '',
    'city' => '',
    'country' => '',
);

$attributs = array(
    'lastName' => '',
    'firstName' => '',
    'birthDate' => '',
);
if (isset($_SESSION['tmp_openId'])) {
    if (isset($_GET['lastName'])) {
        $attributs['lastName'] = $_GET['lastName'];
    }
    if (isset($_GET['firstName'])) {
        $attributs['firstName'] = $_GET['firstName'];
    }
}
if (isset($_SESSION['openId'])) {
    $addressDAO = new AddressDAO();
    $userDAO = new UserDAO();
    $user = $userDAO->getByOpenId($_SESSION['openId']);
    $attributs['lastName'] = $user->getLastName();
    $attributs['firstName'] = $user->getFirstName();
    $attributs['birthDate'] = date_format($user->getBirthDate(),'m/d/y');
    $address = $addressDAO->getByUser($user->getId());
    $attributsAddress['foneNumber'] = $address->getFoneNumber();
    $attributsAddress['email'] = $address->getEmail();
    $attributsAddress['addressText'] = $address->getAddressText();
    $attributsAddress['postalCode'] = $address->getPostalCode();
    $attributsAddress['city'] = $address->getCity();
    $attributsAddress['country'] = $address->getCountry();
}
?>
<section class="features" id="features">
    <div class="container">
        <form id="register-form" method="POST" action="scripts/user_registration.php">
            <div class="row">
                <div class="col-md-3">
                    <label>Nom <span class="required">*</span></label>
                    <div class="input-group input-group-sm">                        
                        <input name="lastName" id="lastName" value = "<?php echo $attributs['lastName']; ?>" type="text" class="form-control" placeholder="nom" aria-describedby="sizing-addon3">
                    </div>                    
                </div>
                <div class="col-md-3">
                    <label>Prénom <span class="required">*</span></label>
                    <div class="input-group input-group-sm">                        
                        <input name="firstName" id="firstName" value = "<?php echo $attributs['firstName']; ?>" type="text" class="form-control" placeholder="prénom" aria-describedby="sizing-addon3">
                    </div>                    
                </div>
                <div class="col-md-3">
                    <label>Date de naissance <span class="required">*</span></label>
                    <div class="input-group input-group-sm">                        
                        <input name="birthDate" id="birthDate" value = "<?php echo $attributs['birthDate']; ?>"  type="text" class="form-control" placeholder="date de naissance" aria-describedby="sizing-addon3" value = <?php echo $attributs['birthDate']; ?>>
                    </div>                    
                </div>
                <div class="col-md-3">
                    <label>Téléphone <span class="required">*</span></label>
                    <div class="input-group input-group-sm">                        
                        <input name="foneNumber" id="foneNumber" value = "<?php echo $attributsAddress['foneNumber']; ?>" type="text" class="form-control" placeholder="numéro de téléphone" aria-describedby="sizing-addon3">
                    </div>                    
                </div>
            </div><br/>
            <div class="row">
                <div class="col-md-3">
                    <label>Email <span class="required">*</span></label>
                    <div class="input-group input-group-sm">                        
                        <input name="email" id="email" value = "<?php echo $attributsAddress['email']; ?>" type="text" class="form-control" placeholder="email" aria-describedby="sizing-addon3">
                    </div>                    
                </div>
                <div class="col-md-3">
                    <label>Adresse</label>
                    <div class="input-group input-group-sm">                        
                        <input name="addressText" id="addressText" value = "<?php echo $attributsAddress['addressText']; ?>" type="text" class="form-control" placeholder="adresse" aria-describedby="sizing-addon3">
                    </div>                    
                </div>
                <div class="col-md-3">
                    <label>Code postal</label>
                    <div class="input-group input-group-sm">                        
                        <input name="postalCode" id="postalCode" value = "<?php echo $attributsAddress['postalCode']; ?>" type="text" class="form-control" placeholder="code postal" aria-describedby="sizing-addon3">
                    </div>                    
                </div>
                <div class="col-md-3">
                    <label>Ville</label>
                    <div class="input-group input-group-sm">                        
                        <input name="city" id="postalCode" value = "<?php echo $attributsAddress['postalCode']; ?>" type="city" class="form-control" placeholder="ville" aria-describedby="sizing-addon3">
                    </div>                    
                </div>
            </div><br/>
            <div class="row">
                <div class="col-md-3">
                    <label>Pays</label>
                    <div class="input-group input-group-sm">                        
                        <input name="country" id="country" value = "<?php echo $attributsAddress['country']; ?>" type="text" class="form-control" placeholder="pays" aria-describedby="sizing-addon3">
                    </div>                    
                </div>
            </div> <br/>     
            <div class="row">
                <div class="col-md-12 text-center">                    
                    <button type="reset" class="btn btn-default">Annuler</button>
                    <button type="submit" class="btn btn-success">Valider</button>
                </div>
            </div>
        </form>
    </div>
</section>