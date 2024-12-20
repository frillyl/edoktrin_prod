<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Doktrin - Masuk</title>
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

                <?php echo form_open('login/update_password') ?>
                <h2>Ubah Password</h2>
                <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="new_password" placeholder="Masukkan Password Baru" required>
                </div>
                <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="confirm_password" placeholder="Konfirmasi Password Baru" required>
                </div>
                <button type="submit" class="btn-login">Ubah Password</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <div class="circle circle-one"></div>
    <div class="circle circle-two"></div>
    <div class="circle circle-three"></div>
</body>

</html>