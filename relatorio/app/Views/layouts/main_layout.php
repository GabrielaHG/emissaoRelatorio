<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Book</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/bootstrap.min.css') ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="<?= base_url('public/assets/images/logo.png') ?>" style="width:3rem" class="d-inline-block align-text-top"/>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= base_url('dashboard') ?>/">Home</a>
        </li>
        <li class="nav-item"> 
          <a class="nav-link" href="<?=base_url('moviment') ?>">Movimentos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('moviment/generatepdf')?>">Relatório</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?= base_url('users')?>" >Users</a>
        </li>
      </ul>
    </div>
    <div class="text-end">
            <?= $userInfo['name'] ?>
            <?= $userInfo['type'] ?>
            <a href="<?= site_url('auth/logout') ?>">Sair</a>
    </div>
  </div>
</nav>

    <?= $this->renderSection('dashboard') ?>

    <hr>
    <footer class="container">
        <div class="row">
            <div class="col text-center">
                Cash book &copy; <?= date('Y') ?>
            </div>
        </div>
    </footer>
    
    <script src="<?= base_url('public/assets/bootstrap.bundle.min.css') ?>"></script>
</body>
</html>