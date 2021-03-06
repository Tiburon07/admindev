<?php

namespace app\traits;

use app\classes\TwigFilters;
use app\classes\TwigGlobal;
use Slim\Views\Twig;
use Exception;

trait Template
{
    public function getTwig(){
        try{
            $twig = Twig::create(DIR_VIEWS);
            TwigGlobal::load($twig);
            return $twig;
        }catch (Exception $e){
            throwException($e);
        }
    }

    public function setView($name){
        return $name.EXT_VIEWS;
    }
}