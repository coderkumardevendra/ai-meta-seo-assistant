<?php
/*
Plugin Name: AI Meta SEO Assistant
Description: Generates meta titles, descriptions, keyword suggestions, readability scores, and internal link suggestions using ChatGPT.
Version: 1.0
Author: Kieran
*/

if (!defined('ABSPATH')) exit;

define('AIMG_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Include files
require_once AIMG_PLUGIN_PATH . 'includes/settings.php';
require_once AIMG_PLUGIN_PATH . 'includes/meta-boxes.php';
require_once AIMG_PLUGIN_PATH . 'includes/api.php';
require_once AIMG_PLUGIN_PATH . 'includes/head-output.php';
