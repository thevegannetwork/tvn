<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rhythm
 */

$oArgs = ThemeArguments::getInstance('templates/pages/index');
$oArgs -> set('template',ts_get_opt('blog-template'));
$oArgs -> set('columns',ts_get_opt('blog-columns'));
get_template_part('templates/pages/index');
$oArgs -> reset();
