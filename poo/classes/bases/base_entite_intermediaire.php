<?php

abstract class BaseEntiteIntermediaire extends BaseEntite {

    function __construct() {
        //le nombre d'arguments de la fonction
        $num = func_num_args();
        //le tableau des arguments passés avec 0 comme indice de départ
        $args = func_get_args();
        switch ($num) {
            //aucun argument passé
            case 0:
                break;
            //un argument passé
            case 1:
                parent::__construct($args[0]);
                break;
            default:
        }
    }

}
