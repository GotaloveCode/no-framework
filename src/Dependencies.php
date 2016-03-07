<?php

$injector = new \Auryn\Injector;

$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

$injector->alias('Example\Template\Renderer', 'Example\Template\TwigRenderer');
$injector->delegate('Twig_Environment', function() use ($injector) {
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
    $twig = new Twig_Environment($loader);
    return $twig;
});

$injector->define('Example\Page\FilePageReader', [
    ':pageFolder' => __DIR__ . '/../pages',
]);
$injector->alias('Example\Page\PageReader', 'Example\Page\FilePageReader');
$injector->share('Example\Page\FilePageReader');


$injector->alias('Example\Template\FrontendRenderer', 'Example\Template\FrontendTwigRenderer');
$injector->alias('Example\Menu\MenuReader', 'Example\Menu\ArrayMenuReader');
$injector->share('Example\Menu\ArrayMenuReader');

$injector->share('PDO');
$injector->define('PDO', [
    ':dsn' => 'mysql:dbname=testdb;host=127.0.0.1',
    ':username' => 'master_user',
    ':passwd' => 'test'
]);




return $injector;
?>
