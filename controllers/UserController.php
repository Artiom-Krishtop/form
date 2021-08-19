<?php

class UserController
{
  // главная сраница
  public function actionIndex()
  {
    $title = 'Главная';
    require_once(ROOT . '/views/main.php');

    return true;
  }

  // страница регистрации
  public function actionRegister()
  {
    $login = '';
    $name = '';
    $email = '';
    $title = 'Регистрация';
    if (isset($_POST['submit']))
    {
        $login = $_POST['login'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $errors = false;
        // валидация полей
        if (!User::checkLogin($login)) {
            $errors[] = 'Неверный логин';
        }

        if (!User::checkEmail($email)) {
            $errors[] = 'Неверный email';
        }

        if ($password !== $confirm_password) {
            $errors[] = 'Пароли не совпадают';
        }

        if (!User::checkPassword($password)) {
            $errors[] = 'Неверный пароль';
        }

        if (!User::checkName($name)) {
            $errors[] = 'Неверное имя';
        }

        //проверяем email и login на уникальность
        if (User::checkEmailExists($email)) {
            $errors[] = 'Такой email уже используется';
        }

        if (User::checkLoginExists($login)) {
            $errors[] = 'Такой логин уже используется';
        }

        // если ошибок нет регистрируем пользователя
        if ($errors == false) {
            $result = User::register($login, $password,$email, $name);
            header("Location:/login");
        }
    }

    require_once(ROOT . '/views/register.php');

    return true;
  }

  //страница логина
  public function actionLogin()
  {
    $title = 'Вход';

    if (isset($_POST['submit']))
    {
      $login = $_POST['login'];
      $password = $_POST['password'];

      $errors = false;

      if (!User::checkLogin($login)) {
          $errors[] = 'Неверный логин';
      }

      if (!User::checkPassword($password)) {
          $errors[] = 'Неверный пароль';
      }

      // если ошибок нет ,выполняем вход
      if ($errors == false) {
          $user = User::checkUserData($login, $password);
          if ($user == false) {
            // если данные о пользователе отсутствуют выводим ошибку
            $erros[] = 'Неправильные данные для входа на сайт';
          }else {
            // если есть,запоминаем пользователя в сессию и создаем cookie
            User::auth($user);

            header("Location:/mypage");
          }
      }
    }
    require_once(ROOT . '/views/login.php');

    return true;
  }

  // страница пользователя
  public function actionMypage()
  {
    $title = 'Моя страница';
    
    $userId = User::checkLogged();

    $user = User::getUserById($userId);

    require_once(ROOT. '/views/mypage.php');

    return true;
  }

  // выход пользователя со страницы
  public function actionExit()
  {
    unset($_SESSION["user"]);
    header("Location:/");
  }
}
 ?>
