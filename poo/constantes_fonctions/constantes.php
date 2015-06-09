<?php
define("TITRE_SITE", "MEWPIPE");
//ops feedback
define("OPERATION_MODIFICATION_SUCCES", "Modification effectuée avec succès");
define("OPERATION_AJOUT_SUCCES", "Ajout effectué avec succès");
define("OPERATION_SUPPRESSION_SUCCES", "Suppression effectuée avec succès");
define("OPERATION_ECHEC", "Echec de l'opération");
//root access
define("SUPER_USER_LOGIN", "admin");
define("SUPER_USER_PASSWORD", "admin");
//vidoe confidentiality policy
define("CONFIDENTIALITY_PROFILE_PUBLIC", "Public");
define("CONFIDENTIALITY_PROFILE_PRIVATE_LINK", "PrivateLink");
define("CONFIDENTIALITY_PROFILE_PRIVATE", "Private");
$CONFIDENTIALITY_PROFILES = array(CONFIDENTIALITY_PROFILE_PUBLIC, CONFIDENTIALITY_PROFILE_PRIVATE_LINK, CONFIDENTIALITY_PROFILE_PRIVATE);

define("MAXIMUM_VIDEO_SIZE", 512000);
//type of users
define("ACCREDITATION_LEVEL_USER", "SIMPLE_USER");
define("ACCREDITATION_LEVEL_ADMIN", "AMDIN_USER");
$ACCREDITATION_LEVELS = array(ACCREDITATION_LEVEL_USER, ACCREDITATION_LEVEL_ADMIN);