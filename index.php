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

var_dump($request->getRequestUri());

$controller = new StartPage();
switch ("/jsonDay") { //$request->getRequestUri()
    case '/week':
        $renderInfo = $controller->getWeekWeather("old");
        break;
    case '/day':
        $renderInfo = $controller->getTodayWeather("old");
        break;
    case '/apiWeek':
        #code
        break;
    case '/apiDay':
        #code:
        break;
    case '/jsonWeek':
        $renderInfo = $controller->getWeekWeather("new");
        var_dump($renderInfo);
        break;
    case '/jsonDay':
        $renderInfo = $controller->getTodayWeather("new");
        var_dump($renderInfo);
        break;
    default:

}
$renderInfo['context']['resources_dir'] = 'src/Weather/Resources';

$content = $twig->render($renderInfo['template'], $renderInfo['context']);

$response = new Response(
    $content,
    Response::HTTP_OK,
    array('content-type' => 'text/html')
);
$response->send();