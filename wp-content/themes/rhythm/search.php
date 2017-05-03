<?php
/**
 * The template for displaying search results pages.
 *
 * @package Rhythm
 */

$oArgs = ThemeArguments::getInstance('templates/pages/index');
$oArgs -> set('template',ts_get_opt('search-template'));
$oArgs -> set('columns',ts_get_opt('search-columns'));
get_template_part('templates/pages/index');
$oArgs -> reset();