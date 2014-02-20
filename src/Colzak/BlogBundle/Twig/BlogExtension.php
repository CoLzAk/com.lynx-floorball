<?php

// src/Colzak/BlogBundle/Twig/BlogExtension.php
namespace Colzak\BlogBundle\Twig;

class BlogExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('toIframe', array($this, 'toIframe'))
        );
    }

    public function toIframe($str)
    {
        var_dump($str);
        return $str;
    }

    public function getName()
    {
        return 'blog_extension';
    }
}