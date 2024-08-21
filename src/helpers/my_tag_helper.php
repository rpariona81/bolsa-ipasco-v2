<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Helper que da formato a los errores.
 * */
if (!function_exists('my_validation_errors')) {

    function my_validation_errors($errors) {
        $salida = '';
        if ($errors) {
            /*$salida = '<div class="alert alert-danger">';
            
            $salida = $salida . '<h4> Mensajes Validacion </h4>';
            $salida = $salida . '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            $salida = $salida . '<small>' . $errors . '</small>';
            $salida = $salida . '</div>';
            */

            $salida = '<div class="alert alert-danger">';
            $salida = $salida .'<h5 class="card-title">Mensajes de validación</h5>';
            $salida = $salida . '<small>' . $errors . '</small>';
            $salida = $salida .'</div>';
        }
        return $salida;
    }

}