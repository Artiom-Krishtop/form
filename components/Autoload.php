<?php

function __autoload($className)
{
  // список папок для автозагрузки
  $array_paths = array(
    '/components/',
    '/models/'
  );

  foreach ($array_paths as $path) {
    // создаём путь
    $path = ROOT . $path . $className . ".php";
    // если этот файл существует, то подключаем его
    if (is_file($path)) {
      require_once $path;
    }
  }
}

 ?>
