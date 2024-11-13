<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | <?= $sub ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>public/assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body style="overflow: hidden;">
    <div class="container">
        <div class="left-section">
            <div class="img-login">
                <img src="<?= base_url() ?>/public/assets/images/Image.png" alt="Logo">
                <h3><b>Satu Klik Menuju Semua Dokumen Anda!</b></h3>
            </div>
        </div>

        <div class="right-section">
            <div class="login-form">
                <?php
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach ($errors as $key => $value) { ?>
                                <li><?= esc($value) ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php
                if (session()->getFlashdata('failed')) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo session()->getFlashdata('failed');
                    echo '</div>';
                }

                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }

                if (session()->getFlashdata('success')) {
                    echo '<div class="alert alert-success" role="alert">';
                    echo session()->getFlashdata('success');
                    echo '</div>';
                }
                ?>

                <?php echo form_open('login/auth') ?>
                <h2>Login</h2>
                <div class="input-box" style="margin-bottom: 15px;">
                    <i class="fa fa-envelope"></i>
                    <input type="text" name="username" placeholder="Enter Your Username">
                </div>
                <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter Your Password">
                </div>
                <div class="login-options">
                    <label>
                        <input type="checkbox" name="remember">
                        Ingat saya
                    </label>
                </div>
                <button type="submit" class="btn-login">Login</button>
                <p style="color: #CD5E5E; text-align: center; margin-top: 20px;">
                    Login website ini hanya untuk yang berkepentingan
                </p>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <div class="circle circle-one"></div>
    <div class="circle circle-two"></div>
    <div class="circle circle-three"></div>
</body>

</html>