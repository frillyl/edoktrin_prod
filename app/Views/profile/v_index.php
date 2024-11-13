<style>
    /* Circles styling */
    .circle {
        position: absolute;
        border-radius: 50%;
        opacity: 0.4;
        z-index: -1;
        background-color: #99999933;
    }

    .circle-main {
        width: 400px;
        height: 400px;
        top: -35%;
        right: 20%;
    }

    .circle-two {
        width: 300px;
        height: 300px;
        top: 70%;
        left: -15%;
        border-radius: 60%;
    }

    .circle-three {
        width: 400px;
        height: 400px;
        bottom: -55%;
        right: -15%;
    }
</style>

<body style="background-color: #EAEAEA; overflow-x: hidden;">
    <div class="profile-container">
        <div class="header-container">
            <h2 class="mb-2" style="margin-top: 20px;">Profil Saya</h2>
            <div class="profile-left">
                <div class="profile-picture">
                    <img src="<?= base_url('public/assets/images/profile_pict/' . session()->get('photo')) ?>" alt="Profile Picture" id="gambar_load" class="rounded-circle" style="width: 150px; height: 150px;">
                </div>
            </div>
        </div>

        <!-- Card Profile di sebelah kanan -->
        <div class="card profile-card">
            <form action="<?= base_url('profile/edit') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">NRP</label>
                    <input type="text" class="form-control" name="nrp" value="<?= session('nrp') ?>">
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <div class="me-2">
                        <label class="form-label">Nama Depan</label>
                        <input type="text" name="nama_depan" class="form-control" value="<?= $nama_depan ?>" placeholder="Nama Depan" style="width: 280px; margin-right: 15px;">
                    </div>
                    <div>
                        <label class="form-label">Nama Belakang</label>
                        <input type="text" name="nama_belakang" class="form-control" value="<?= $nama_belakang ?>" placeholder="Nama Belakang" style="width: 280px;">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= session('email') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input type="tel" class="form-control" name="no_hp" value="<?= session('no_hp') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" name="username" value="<?= session('username') ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ganti Foto</label>
                    <input type="file" name="photo" id="preview_gambar" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="edited_by" value="<?= session('id_pengguna') ?>" class="form-control" id="edited_by" placeholder="Diubah Oleh" hidden>
                </div>
                <div class="mb-3 d-flex justify-content-end mt-2">
                    <button type="submit" class="btn" style="border-radius: 20px; width: 150px; height: 45px; font-size: 18px; background-color: #8A3A42; color: white;">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="circle circle-main"></div>
    <div class="circle circle-two"></div>
    <div class="circle circle-three"></div>
</body>