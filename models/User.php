<?php
  /**
   *
   */
  class User
  {
    private static $salt = 'd8578edf8458ce06fbc5';
    // проверяем логин
    static public function checkLogin($login)
    {
      $regular_expression = "/^[А-ЯЁа-яёA-Za-z0-9]+$/u";
      if (mb_strlen($login,'utf-8')>=6 && preg_match($regular_expression, $login)) {
        return true;
      }
      return false;
    }


     // проверяем пароль
    public static function checkPassword($password)
    {
      $regular_expression = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$%^&]).*$/u";
      if (strlen($password) >= 6 && preg_match($regular_expression, $password)) {
        return true;
      }
      return false;
    }

    // проверяем email
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    // проверяем имя
    public static function checkName($name)
    {
      if (mb_strlen($name,'utf-8')>=2 && preg_match("/^[А-ЯЁа-яёA-Za-z0-9]+$/u", $name)) {
        return true;
      }
      return false;
    }

    // проверяем вошел ли пользователь
    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }else {
          header("Location:/login");
        }
    }

    // првоерка уникальности пароля
    static public function checkLoginExists($login)
    {
      $db = xmlDb::connect( 'database' );

      $db->from('users')->select('login')->where('login', $login);
      $result = $db->getAll();

      if ($result) {
        return true;
      }
      return false;
    }

    // првоерка  уникальности email
    static public function checkEmailExists($email)
    {
      $db = xmlDb::connect( 'database' );

      $db->from('users')->select('email')->where('email', $email);
      $result = $db->getAll();

      if ($result) {
        return true;
      }
      return false;
    }

    // регистрация пользователя
    static public function register($login, $password, $email, $name)
    {

      $db = xmlDb::connect( 'database' );
      $db->addTable('users');
      // солим пароль
      $password = sha1(self::$salt . $password);

      $db->in('users')->bind('login', $login);
      $db->in('users')->bind('email', $email);
      $db->in('users')->bind('password', $password);
      $db->in('users')->bind('name', $name);
      $db->in('users')->insert();
       return true;
    }

    // получаем пользователя по ID
    static public function getUserById($id)
    {
      $db = xmlDb::connect('database');

      $db->from('users')
      ->select('*')
      ->where('id', $id);

      $userData = $db->getAll();

      return $userData;
    }
    // проверяем,существует ли пользователь
    static public function checkUserData($login, $password)
    {
      $db = xmlDb::connect('database');

      // солим пароль
      $password = sha1(self::$salt . $password);

      $db->from('users')
      ->select('id,login,password')
      ->where('login', $login )
      ->where('password', $password);

      $user = $db->getAll();
      if ($user) {
        return $user[0]->id;
      }
      return false;
    }

    static public function auth($userId)
    {
      $_SESSION['user'] = $userId;
      setcookie('user',$userId,time()+3600);
    }


  }
 ?>
