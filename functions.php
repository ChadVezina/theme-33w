<?php

$functions_dir = get_template_directory() . '/functions/';

include_once "{$functions_dir}helper.php";
include_once "{$functions_dir}main-config.php";
// Include Customizer settings and render functions
include_once "{$functions_dir}customizer.php";
include_once "{$functions_dir}carousel.php";
include_once "{$functions_dir}carte.php";
// Include REST API for dynamic filters
include_once "{$functions_dir}rest-api.php";
