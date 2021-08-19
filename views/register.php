<?php require_once(ROOT.'/views/layouts/header.php') ?>
      <div class="row justify-content-center">
        <h2>Регистрация</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <form id="form" method="post" >
            <div class="mb-3">
              <label for="login" class="form-label">Логин</label>
              <input type="text" class="form-control"  id="login" name="login" value="<?php echo $login; ?>" required>
              <small class="form-text text-muted">Логин должен содержать более 6 символов</small>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Пароль</label>
              <input type="password" id="password" class="form-control" name="password" required>
              <small class="form-text text-muted">Пароль должен содержать латинские буквы,иметь одну заглавную букву и спец.символы($,%,^,&)</small>
            </div>
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Повторите пароль</label>
              <input type="password" id="confirm_password" class="form-control" name="confirm_password" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Эл. адресс</label>
              <input type="email" id="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Ваше имя</label>
              <input type="text" id="name" class="form-control" name="name" value="<?php echo $name; ?>" required>
              <small class="form-text text-muted">Имя должно содержать более 2 символов</small>
            </div>
            <input type="submit" name="submit" id="btn" class="btn btn-primary" value="Регистрация"></input>
          </form>
        </div>
      </div>
    </div>
<?php require_once(ROOT.'/views/layouts/footer.php') ?>
