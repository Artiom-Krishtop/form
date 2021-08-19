<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="/template/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  </head>
  <body>
    <div class="container" id="errors">
      <?php if (isset($errors) && is_array($errors)): ?>
          <div class="row justify-content-center" >
            <div class="col-md-4">
              <ul class="alert alert-danger">
                  <?php foreach ($errors as $error): ?>
                      <li> - <?php echo $error; ?></li>
                  <?php endforeach; ?>
              </ul>
            </div>
          </div>
      <?php endif; ?>
