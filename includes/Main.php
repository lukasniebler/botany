<?php

namespace LN\Botany;

defined('ABSPATH') || exit;

class Main
{
    public function __construct($pluginFile)
    {
        $this->pluginFile = $pluginFile;
        // require_once __DIR__ . '../vendor/cmb2/init.php';
        Helper::debug(__DIR__ . '../vendor/cmb2/cmb2/init.php');
        new Cpt($pluginFile);
        new Helper();
    }
}