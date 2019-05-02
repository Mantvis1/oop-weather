<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Weather\Controller\StartPage;

$request = Request::createFromGlobals();

$loader = new FilesystemLoader('View', __DIR__ . '/src/Weather');
$twig = new Environment($loader, ['cache' => __DIR__ . '/cache', 'debug' => true]);

$controller = new StartPage();

switch ($request->getRequestUri()) {
    case '/oop-weather/week':
        $renderInfo = $controller->getWeekWeather("old");
        break;
    case '/oop-weather/day':
        $renderInfo = $controller->getTodayWeather("old");
        break;
    case '/oop-weather/apiWeek':
        $renderInfo = $controller->getWeekWeather("api");
        break;
    case '/oop-weather/apiDay':
        $renderInfo = $controller->getTodayWeather("api");
        break;
    case '/oop-weather/jsonWeek':
        $renderInfo = $controller->getWeekWeather("new");
        break;
    case '/oop-weather/jsonDay':
        $renderInfo = $controller->getTodayWeather("new");
        break;
    default:
        $renderInfo = $controller->getTodayWeather("old");
        break;

}
$renderInfo['context']['resources_dir'] = 'src/Weather/Resources';

$content = $twig->render($renderInfo['template'], $renderInfo['context']);

$response = new Response(
    $content,
    Response::HTTP_OK,
    array('content-type' => 'text/html')
);
$response->send();