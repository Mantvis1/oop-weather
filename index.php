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
$api = new \Weather\Api\GoogleApi();

switch ($request->getRequestUri()) {
    case '/oop-weather/week':
        $renderInfo = $controller->getWeekWeather("old");
        break;
    case '/oop-weather/day':
        $renderInfo = $controller->getTodayWeather("old");
        break;
    case '/apiWeek':
        #code
        break;
    case '/apiDay':
        var_dump($api->getToday());
        $daysInfo = array();
        $daysInfo[0] = $api->getToday();
        $renderInfo = $daysInfo;
        var_dump($renderInfo);
        break;
    case '/oop-weather/index.php/jsonWeek':
        $renderInfo = $controller->getWeekWeather("new");
        var_dump($renderInfo);
        break;
    case '/oop-weather/index.php/jsonDay':
        $renderInfo = $controller->getTodayWeather("new");
        var_dump($renderInfo);
        break;
    default:
        var_dump($request->getRequestUri());
        $renderInfo = $controller->getTodayWeather("old");
        //var_dump($renderInfo);
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