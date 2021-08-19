<?php require_once(ROOT.'/views/layouts/header.php') ?>
    <h1>Hello,<?php echo $user[0]->name; ?></h1>
    <a href="/exit" class="btn btn-danger" >Выход</a>
<?php require_once(ROOT.'/views/layouts/footer.php') ?>
