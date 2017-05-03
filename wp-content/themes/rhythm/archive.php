<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rhythm
 */

$oArgs = ThemeArguments::getInstance('templates/pages/index');
$oArgs -> set('template',ts_get_opt('archive-template'));
$oArgs -> set('columns',ts_get_opt('archive-columns'));
get_template_part('templates/pages/index');
$oArgs -> reset();