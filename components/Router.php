<?php

class Router
{
    private $routes;

    public function __construct()
    {
      $routesPath = ROOT . '/config/routes.php';
      $this->routes = include($routesPath);
    }

    // возращает строку запроса

    private function getURI()
    {
      if (!empty($_SERVER['REQUEST_URI']))
      {
        return trim($_SERVER['REQUEST_URI'], '/');
      }
    }

    public function run()
    {
      // полусить строку запроса
      $uri = $this->getURI();

      // проверить наличие такого запроса в routes.php
      foreach ($this->routes as $uriPattern => $path)
      {

        // сравниваем $uriPattern и $uri
        if (preg_match("~$uriPattern~", $uri))
        {

          // получаем внутренний путь из внешенго
          $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

            // определяем контроллер и action

            $segments = explode('/', $internalRoute);

            // контролле
            $controllerName = ucfirst(array_shift($segments) . 'Controller');

            // action
            $actionName = 'action' . ucfirst(array_shift($segments));

            $parameters = $segments;

            // Подключить файл класса-контроллерa
            $controllerFile = ROOT . '/controllers/' . $controllerName. '.php';

            if (file_exists($controllerFile))
            {
              include_once($controllerFile);
            }

            // создать объект, вызвать метод
            $controllerObject = new $controllerName;

            $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

            if ($result != null) {
              break;
            }
        }
      }
    }
}


 ?>
