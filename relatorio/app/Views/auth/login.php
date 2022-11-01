<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/bootstrap.min.css') ?>">
</head>
<body>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 offset-4">
                <h4>Entrar</h4>
                <hr>

                <?php
                    if(!empty(session()->getFlashdata('success'))){
                        ?>
                        <div class="alert alert-success">
                            <?= 
                                session()->getFlashdata('success');
                            ?>
                        </div>
                        <?php
                    } else if(!empty(session()->getFlashdata('fail'))){
                        ?>
                        <div class="alert alert-danger">
                            <?= 
                                session()->getFlashdata('fail');
                            ?>
                        </div>
                        <?php
                    } 
                ?>

                <form action="<?= base_url('auth/loginUser') ?>" 
                      class="form mb-3"
                      method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label for="">E-mail</label>
                        <input type="text" 
                               class="form-control"
                               name="email"
                               value="<?= set_value('email') ?>"
                               placeholder="Email Here">
                        <span class="text-danger text-sm">
                            <?= isset($validation) ? display_form_errors($validation, 'email') : '' ?>
                        </span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Senha</label>
                        <input type="password" 
                               class="form-control"
                               name="password"
                               value="<?= set_value('password') ?>"
                               placeholder="Password Here">
                    </div>

                    <div class="form-group mb-3">
                        <input type="submit" 
                               class="btn btn-info"
                               value="Sign In">
                    </div>
                </form>

                <a href="<?= site_url('auth/register') ?>">
                    Criar uma nova conta
                </a>
            </div>
        </div>
    </div>    


    <script src="<?= base_url('public/assets/bootstrap.bundle.min.css') ?>"></script>
</body>
</html>