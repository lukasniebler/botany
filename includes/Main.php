<?php

namespace LN\Botany;

defined('ABSPATH') || exit;

class Main
{
    public function __construct()
    {
        new Cpt();
    }
}