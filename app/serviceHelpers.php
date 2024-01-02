<?php

if (! function_exists('get_icon')) {
    function get_icon($service) {
        $icon = null;

        switch ($service) {
            case 'Servizi al conducente':
                $icon = 'drive';
                break;
            case 'Patenti':
                $icon = 'patent';
                break;
            case 'Formazione professionale':
                $icon = 'prof_training';
                break;
            case 'Nautica':
                $icon = 'boat';
                break;
            case 'Patenti professionali':
                $icon = 'prof_patent';
                break;
            case 'Corsi':
                $icon = 'courses';
                break;

            default:
                $icon = 'drive';
                break;
        }

        return $icon;
    }
}
