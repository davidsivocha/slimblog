<?php
require 'Slim/Slim.php';
$app = new Slim();

$app->config(array(
   'templates.path' => './templates',
   'article.path' => './articles'   // location of articles
));

$app->get('/about', function () use ($app) {
    $app->render('about.php');
});

$app->get('/:article',function($article) use($app){
   $path     = $app->config('article.path');
   //open text file and read it
   $handle  = fopen($path . '/' . $article . '.txt', 'r');
   $content = stream_get_contents($handle);
   // split the content to get metadata
   $content = explode("\n\n", $content);
   $rawMeta = array_shift($content);
   // metadata is json encoded. so decode it.
   $meta    = json_decode($rawMeta,true);
   $content = implode("\n\n", $content);
   $article = array('meta' => $meta , 'content' => $content);
   $app->render('article.php', $article);
});

$app->get('/', function() use ($app){
   $path = $app->config('article.path');
   $dir = new DirectoryIterator($path);
   $articles = array();
   foreach($dir as $file){
      if($file->isFile()){
         $handle  = fopen($path . '/' . $file->getFilename(), 'r');
         $content = stream_get_contents($handle);
         $content = explode("\n\n", $content);
         $rawMeta = array_shift($content);
         $meta    = json_decode($rawMeta,true);
         $content = implode("\n\n", $content);
         $articles[$file->getFilename()] = array('meta' => $meta, 'content' => $content);
      }
   }
   $app->render('index.php',array('articles' => $articles));
});

$app->run();
