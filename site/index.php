<?php

require_once(dirname(__FILE__) . '/Slim/Slim.php');
\Slim\Slim::registerAutoloader();

require_once(dirname(__FILE__) . '/Models.php');
require_once(dirname(__FILE__) . '/DBManager.php');
require_once(dirname(__FILE__) . '/helper_functions.php');
require_once(dirname(__FILE__) . '/recaptchalib.php');


$viewHaml = new \Slim\Extras\Views\Haml();
$app = new \Slim\Slim(array(
        'view' => $viewHaml, 
        'debug' => true
    ));

$dbManager = DBManager::getInstance($app->getLog());

$app->get('/', function () use ($app) { 
    $app->render(
        'main-page.html.haml',
        array('app' => $app)
    );    
});

$app->get('/search', function () use ($app, $dbManager) { 
    $req = $app->request();    
    $app->render(
        'search-page.html.haml',
        array(
            'app' => $app            
        )
    );
});

$app->post('/search', function () use ($app, $dbManager) { 
    $req = $app->request();
    $search = $req->params('text');
    $type = $req->params('type');
    $albums = null;
    $singers = null;
    $pathToAlbum = './singers/';
    if ($type === 'singer') {
        $singers = $dbManager->getSingersBySearch($search);
        $count = count($singers);
    } else {
        $albums = $dbManager->getAlbumsBySearch($search);
        $count = count($albums);
    } 
    
    $app->render(
        'search-page.html.haml',
        array(
            'app' => $app,
            'search' => $search,
            'singertype' => $type === 'singer' ? true : false,            
            'singers' => $singers,
            'albums' => $albums,
            'count' => $count,
            'pathToAlbum' => $pathToAlbum
        )
    );
});

$app->get('/spec-search', function () use ($app, $dbManager) {    
    $req = $app->request();
    $letter = $req->params('letter');     
    $style = $req->params('style');
    $instrument = $req->params('instrument');

    if (isset($letter)) {
        $singers = $dbManager->getSingersByLetterSearch($letter);
    } elseif (isset($style)) {        
        $singers = $dbManager->getSingersByStyleSearch($style);
    } elseif (isset($instrument)) {
        $singers = $dbManager->getSingersByInstrumentSearch($instrument);
    } else {
        $letter = 'A';
        $singers = $dbManager->getSingersByLetterSearch($letter);
    }
    
    $app->render(
        'spec-search-page.html.haml',
        array(
            'app' => $app,
            'singers' => $singers,            
            'letter' => $letter,        
            'style' => $style,
            'instrument' => $instrument   
        )
    );
});

$app->get('/singers', function () use ($app, $dbManager) {      
    // $app->getLog()->debug('singers');
    $singers = $dbManager->getSingers();
    $app->render(
        'singers-page.html.haml',
        array(
            'app' => $app,
            'singers' => $singers
        )
    );

});

$app->get('/singers/:singer', function ($singer) use ($app, $dbManager) {   
    $s = $dbManager->getSinger($singer);
    $albums = $dbManager->getAlbumsBySinger($s->getId());
    $seealso = $dbManager->getSeeAlso($singer);
    $styles = $dbManager->getStylesBySingerId($singer);
    $instruments = $dbManager->getInstrumentsBySingerId($singer);    
    $app->render(
        'singer-page.html.haml', 
        array(
            'app' => $app,
            'singer' => $s,
            'albums' => $albums,
            'seealso' => $seealso,
            'styles' => $styles,
            'instruments' => $instruments,
            'pathToAlbum' => './'
        )
    );        
}); 

$app->get('/singers/:singer/:album', function ($singer, $album) use ($app, $dbManager) {   
    $s = $dbManager->getSinger($singer);
    $album = $dbManager->getAlbumById($album);
    $app->render(
        'album-page.html.haml', 
        array(            
            'app' => $app,
            'singer' => $s,
            'album' => $album
        )
    );        
}); 

$app->get('/albums', function () use ($app, $dbManager) {          
    albumsByType($app, $dbManager, 0);        
});

$app->get('/dvd', function () use ($app, $dbManager) {
    albumsByType($app, $dbManager, 1);
});

$app->get('/styles', function () use ($app, $dbManager) {
    $styles = $dbManager->getStyles();    
    $app->render(
        'styles-page.html.haml', 
        array(
            'app' => $app,
            'styles' => $styles
            )
    );
});

$app->get('/instruments', function () use ($app, $dbManager) {
    $instruments = $dbManager->getInstruments();    
    $app->render(
        'instruments-page.html.haml', 
        array(
            'app' => $app,
            'instruments' => $instruments
            )
    );
});

function albumsByType($app, $dbManager, $type) {
    $albums = $dbManager->getAlbumsByType($type);
    $app->render(
        'albums-page.html.haml',
        array(
            'app' => $app,
            'albums' => $albums,
            'type' => $type            
        )
    );
}

$app->get('/order', function () use ($app, $dbManager) { 
    $req = $app->request();    
    $app->render(
        'order-page.html.haml',
        array(
            'app' => $app,
            'params' => null            
        )
    );
});

$app->post('/order', function () use ($app, $dbManager) { 
    $req = $app->request();    
    $params['name'] = $req->params('name');
    $params['email'] = $req->params('email');
    $params['order'] = $req->params('order');

    $privatekey = "6LdtmtsSAAAAAO7svDTeKrUQF6X250-scCMdJibz";
    $resp = recaptcha_check_answer ($privatekey,
        $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"],
        $_POST["recaptcha_response_field"]);

    $errors = array();
    if (!$resp->is_valid) {
      $errors[] = 'Неверно введена капча: ' . $resp->error;
    }

    $error = 'Не заполнено поле ';
    if ($params['name'] == null)
        $errors[] = $error . "'имя'";
    if ($params['email'] == null)
        $errors[] = $error . "'email'";
    if ($params['order'] == null)
        $errors[] = $error . "'описание'";    

    if (count($errors) == 0) {
      $to = "gss@ru.ru";
      $from = $params['email'];
      $name = $params['name'];
      $order = $params['order'];      
      $subject = "Заказ дисков от $name, $from";      
      $extra = "From: $from\r\nReply-To: $from\r\n";
      $extra .= "Content-type: text/html; charset=Windows-1251;\r\n";
      $success = mail($to, $subject, $order);      

      if (!$success) {
        $errors[] = "Техническая ошибка отрпавки. Попробуйте отправить вручную на srdc@srdc.ru";
      } else {
        $subject = "Подтверждение заказа на сайте boogiewoogie.ru";
        $message = "Списабо за заказ. Наши менеджеры свяжутся с вами в кратчайшие сроки. \n\nТекст заказа: \n\n$order";
        $extra = "From: $to\r\nReply-To: $to\r\n";
        $extra .= "Content-type: text/html; charset=Windows-1251;\r\n";  
        mail($from, $subject, $message);
      }
    }

    $params['errors'] = $errors;    

    $app->render(
        'order-page.html.haml',
        array(
            'app' => $app,
            'params' => $params
        )
    );
});

$app->get('/chatting', function () use ($app, $dbManager) {     
    $app->render(
        'chatting-page.html.haml',
        array(
            'app' => $app        
        )
    );
});

$app->run();

include "misc.php"

?>