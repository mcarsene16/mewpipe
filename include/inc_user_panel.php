<div class="col-md-4 text pull-right">
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
            <?php
            if (isset($_SESSION['fullName'])) {
                echo $_SESSION['fullName'];
            }
//            if (!$facebookUtils->isFacebookSessionActive()) {
//                $facebookUtils->getFacebookUser()->getName();
//            }
            ?>
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>            
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="edit-profile">Edit Profile</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Share video</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="logout">Log out</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" data-toggle="modal" data-target="#myModal">Delete Account</a></li>
        </ul>
    </div>    
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Supprimer le compte</h4>
            </div>
            <div class="modal-body">
                <p>Vous êtes sur le point de supprimer votre compte. 
                    Cette action entrainera la suppression de toutes vos vidéos et est irréversible.
                    Cliquez sur valider pour continuer ou annuler pour revenir en arrière.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="deleteAccount">Valider</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->