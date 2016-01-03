<?php

namespace Core;

class CustomView extends \Slim\View
{
    public function render($template, $data = null)
    {
        $this->set('app', \Slim\Slim::getInstance());
        return parent::render($template, $data);
    }
}