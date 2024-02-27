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

if (! function_exists('get_color')) {
    function get_color($service) {
        $color = null;

        switch ($service) {
            case 'Servizi al conducente':
                $color = '5e53dd';
                break;
            case 'Patenti':
                $color = '7a95db';
                break;
            case 'Formazione professionale':
                $color = '74d4ff';
                break;
            case 'Nautica':
                $color = 'a6cb0d';
                break;
            case 'Patenti professionali':
                $color = '01bca0';
                break;
            case 'Corsi':
                $color = '017c67';
                break;

            default:
                $color = '5e53dd';
                break;
        }

        return $color;
    }
}

if (! function_exists('get_step')) {
    function get_step($step) {
        $description = '';

        switch ($step) {
            case 'documenti':
                $description = 'Documenti di riconoscimento cliente';
                break;
            case 'scansioni':
                $description = 'Scansione documenti cliente';
                break;
            case 'fototessera':
                $description = 'Fototessera cliente';
                break;
            case 'genitore/tutore':
                $description = 'Documenti e firma Genitore/Tutore';
                break;
            case 'accompagnatori':
                $description = 'Documenti e firma accompagnatori';
                break;
            case 'visita':
                $description = 'Certificato visita medica';
                break;

        }

        return $description;
    }
}

if (! function_exists('get_guide')) {
    function get_guide($guide) {
        $icon = '';

        switch ($guide) {
            case 'notturna':
                $icon = 'night';
                break;
            case 'extraurbana':
                $icon = 'street';
                break;
            case 'autostrada':
                $icon = 's_street';
                break;
        }

        return $icon;
    }
}
