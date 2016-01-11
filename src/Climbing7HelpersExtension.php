<?php

use \Cake\Utility\Inflector;

class Climbing7HelpersExtension extends \Twig_Extension
{
    protected $router;
    protected $uri;

    public function __construct($router, $uri) {
        $this->router = $router;
        $this->uri = $uri;
    }

    public function getName()
    {
        return 'climbing7';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('library', array($this, 'library')),
            new \Twig_SimpleFunction('asset', array($this, 'asset')),
            new \Twig_SimpleFunction('css', array($this, 'css'), ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('js', array($this, 'js'), ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('postUrl', array($this, 'postUrl'))
        ];
    }

    public function postUrl($post, $queryParams = []) {
        return $this->router->pathFor('post', [
            'id' => $post['id'],
            'title' => Inflector::slug($post['title'], '-')
        ], $queryParams);
    }

    /**
    * Assets 
    **/
    public function css($paths) {
        if (!is_array($paths))
            $paths = [$paths];
        $html = '';
        foreach ($paths as $path) {
            $html .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$this->asset('/css/'.$path)."\"/>\n";
        }

        return $html;
    }

    public function js($paths) {
        if (!is_array($paths))
            $paths = [$paths];
        $html = '';
        foreach ($paths as $path) {
            $html .= "<script type=\"text/javascript\" src=\"".$this->asset('/js/'.$path)."\"></script>\n";
        }

        return $html;
    }

    public function library($path) {
        return $this->asset('/library'.$path);
    }

    public function asset($path) {
        return $this->uri->getBasePath() . '/src/public' . $path;
    }

}
