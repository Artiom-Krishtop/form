<?php require_once(ROOT.'/views/layouts/header.php') ?>
      <div class="row justify-content-center">
        <h2>Вход</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <form id="form"  method="post" >
            <div class="mb-3">
              <label for="login" class="form-label">Логин</label>
              <input type="text" class="form-control" name="login" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Пароль</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <input type="submit" id="btn" name="submit" class="btn btn-primary" value="Войти"></input>
          </form>
        </div>
      </div>
    </div>
<?php require_once(ROOT.'/views/layouts/footer.php') ?>
