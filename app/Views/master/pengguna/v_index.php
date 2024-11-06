<div class="user">
    <h3 class="title">Halaman Pengguna</h3>

    <!-- Kontainer utama untuk tabel dan tombol -->
    <div class="card-table search-card">
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <div class="search-icon">
                <i class="fas fa-search" title="Search"></i>
            </div>
            <div class="arrows">
                <i class="fas fa-align-center" title="Align Center"></i>
            </div>
            <div class="align-center-icon">
                <i class="fas fa-sort-alpha-down" title="Sort A-Z"></i>
            </div>
        </div>
    </div>

    <!-- Tabel pengguna -->
    <div class="card-table table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NRP</th>
                    <th>Nama Anggota</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="documentTable">
                <?php $no = 1;
                foreach ($pengguna as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $value['nrp'] ?></td>
                        <td><?= $value['nama'] ?></td>
                        <td>
                            <div class="action-buttons">
                                <button class="detail-btn" data-toggle="modal" data-target="#info<?= $value['id_pengguna'] ?>"><i class="fa-solid fa-info"></i> Detail</button>
                                <button class="ubahunit" data-toggle="modal" data-target="#edit<?= $value['id_pengguna'] ?>"><i class="fa-solid fa-pen"></i> Ubah</button>
                                <button class="delete-btn" data-id="<?= $value['id_pengguna'] ?>" data-name="<?= $value['nama'] ?>"><i class="fas fa-trash"></i> Hapus</button>
                                <?php if ($value['id_pengguna'] != session('id_pengguna')) : ?>
                                    <button class="resetpassword" data-id="<?= $value['id_pengguna'] ?>" data-name="<?= $value['nama'] ?>"><i class="fa-solid fa-key"></i> ResetPassword</button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        <button id="addButton" class="btn create-btn" style="background-color: #8A3A42; color: #ffff;">Tambah Pengguna Baru</button>
        <div class="pagination">
            <button id="prevPage" disabled><i class="fas fa-arrow-left"></i></button>
            <button class="page-button active" data-page="1">1</button>
            <button class="page-button" data-page="2">2</button>
            <button class="page-button" data-page="3">3</button>
            <button id="nextPage"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>

    <!-- MODAL DETAIL PENGGUNA -->
    <?php foreach ($pengguna as $key => $value) { ?>
        <div class="modal" id="info<?= $value['id_pengguna'] ?>">
            <div class="modal-content">
                <button class="close-btn" onclick="closeDetailModal('info<?= $value['id_pengguna'] ?>')">×</button>
                <h2 style="margin-bottom: 30px; margin-top: 40px; font-weight: 700">Detail Data Pengguna</h2>
                <div class="modal-body">
                    <p><strong>NRP</strong><span class="detail-value"><?= $value['nrp'] ?></span></p>
                    <p><strong>Nama</strong><span class="detail-value"><?= $value['nama'] ?></span></p>
                    <p><strong>Username</strong><span class="detail-value"><?= $value['username'] ?></span></p>
                    <p><strong>Role</strong><span class="detail-value"><?php if ($value['role'] == '1') {
                                                                            echo 'Administrator';
                                                                        } elseif ($value['role'] == '2') {
                                                                            echo 'Pengelola';
                                                                        } elseif ($value['role'] == '3') {
                                                                            echo 'User';
                                                                        } ?></span></p>
                    <p><strong>Ditambahkan Pada</strong><span class="detail-value"><?= date('j F Y H:i:s', strtotime($value['created_at'])) ?></span></p>
                    <p><strong>Ditambahkan Oleh</strong><span class="detail-value"><?= $value['created_by_name'] ?></span></p>
                    <p><strong>Diubah Pada</strong><span class="detail-value"><?php if ($value['edited_at'] == '') : ?>
                                Data pengguna belum pernah diubah.
                            <?php else : ?>
                                <?= date('j F Y H:i:s', strtotime($value['edited_at'])) ?>
                            <?php endif; ?></span></p>
                    <p><strong>Diubah Oleh</strong><span class="detail-value"><?php if ($value['edited_by'] == 0) : ?>
                                Data pengguna belum pernah diubah.
                            <?php else : ?>
                                <?= $value['edited_by_name'] ?>
                            <?php endif; ?></span></p>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- END OF MODAL DETAIL PENGGUNA -->

    <!-- MODAL ADD PENGGUNA -->
    <div class="modal" id="add" style="display:none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeCreateModal()">×</button>
            <h2>Tambah Data Pengguna</h2>
            <div class="modal-body">
                <?php
                echo form_open('master/pengguna/add');
                ?>
                <!-- NRP Input Field -->
                <div class="input-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="nrp" name="nrp" placeholder="NRP" required>
                    </div>
                </div>
                <!-- Name Input Fields -->
                <div class="name-group">
                    <div class="input-group">
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" id="nama_depan" name="nama_depan" placeholder="Nama Depan">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" id="nama_belakang" name="nama_belakang" placeholder="Nama Belakang">
                        </div>
                    </div>
                </div>
                <!-- Username Input Field -->
                <div class="input-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Username" readonly>
                    </div>
                </div>
                <!-- Role Input Field -->
                <div class="input-group">
                    <div class="input-wrapper password-input-wrapper">
                        <select id="role" name="role" required>
                            <option value="" selected>Pilih Role</option>
                            <option value="">-- Pilih Role --</option>
                            <option value="1">Administrator</option>
                            <option value="2">Pengelola</option>
                            <option value="3">User</option>
                        </select>
                    </div>
                </div>
                <!-- Created By -->
                <div class="input-group">
                    <input type="text" name="created_by" class="form-control" id="created_by" placeholder="Ditambahkan Oleh" value="<?= session('id_pengguna') ?>" hidden>
                </div>
                <!-- Submit Button -->
                <div class="button-container">
                    <button type="submit" class="submit-btn">Create</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- END OF MODAL ADD PENGGUNA -->

    <!-- MODAL EDIT PENGGUNA -->
    <?php foreach ($pengguna as $key => $value) {
        $nama = explode(' ', $value['nama'], 2);
        $nama_depan = $nama[0];
        $nama_belakang = isset($nama[1]) ? $nama[1] : '';
    ?>
        <div class="modal" id="edit<?= $value['id_pengguna'] ?>" style="display:none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeDetailModal('edit<?= $value['id_pengguna'] ?>')">×</button>
                <h2>Ubah Data Pengguna</h2>
                <div class="modal-body">
                    <?php
                    echo form_open('master/pengguna/edit/' . $value['id_pengguna']);
                    ?>
                    <!-- NRP Input Field -->
                    <div class="input-group">
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" id="editNrp" name="nrp" value="<?= $value['nrp'] ?>" placeholder="NRP">
                        </div>
                    </div>
                    <!-- Name Input Fields -->
                    <div class="name-group">
                        <div class="input-group">
                            <div class="input-wrapper">
                                <i class="fas fa-user"></i>
                                <input type="text" id="editFirstname" name="nama_depan" value="<?= $nama_depan ?>" placeholder="Nama Depan">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="input-wrapper">
                                <i class="fas fa-user"></i>
                                <input type="text" id="editLastname" name="nama_belakang" value="<?= $nama_belakang ?>" placeholder="Nama Belakang">
                            </div>
                        </div>
                    </div>
                    <!-- Username Input Field -->
                    <div class="input-group">
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" id="editUsername" name="username" value="<?= $value['username'] ?>" placeholder="Username">
                        </div>
                    </div>
                    <!-- Role Input Field -->
                    <div class="input-group">
                        <div class="input-wrapper password-input-wrapper">
                            <select id="editRole" name="role">
                                <option <?php if ($value['role'] == '') {
                                            echo 'selected';
                                        } ?> value="">Pilih Role</option>
                                <option <?php if ($value['role'] == 1) {
                                            echo 'selected';
                                        } ?> value="1">Administrator</option>
                                <option <?php if ($value['role'] == 2) {
                                            echo 'selected';
                                        } ?> value="2">Pengelola</option>
                                <option <?php if ($value['role'] == 3) {
                                            echo 'selected';
                                        } ?> value="3">User</option>
                            </select>
                        </div>
                    </div>
                    <!-- Edited By -->
                    <div class="input-group">
                        <input type="text" name="edited_by" value="<?= session('id_pengguna') ?>" class="form-control" id="edited_by" placeholder="Diubah Oleh" hidden>
                    </div>
                    <!-- Submit Button -->
                    <div class="button-container">
                        <button type="submit" class="submit-btn">Update</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- END OF MODAL EDIT PENGGUNA -->
</div>

<script>
    function openCreateModal() {
        document.getElementById("add").style.display = "flex";
    }

    function closeCreateModal() {
        document.getElementById("add").style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("addButton").addEventListener("click", function(event) {
            event.preventDefault(); // Mencegah reload halaman
            openCreateModal();
        });
    });


    // membuka modal ubah
    function openEditModal(id) {
        document.getElementById(id).style.display = "flex"; // Menampilkan modal
    }

    function closeEditModal() {
        document.getElementById(id).style.display = "none"; // Menyembunyikan modal
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".ubahunit").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const modalId = this.getAttribute("data-target").substring(1); // Ambil ID modal dari atribut data-target
                openEditModal(modalId); // Panggil openDetailModal dengan ID yang tepat
            });
        });
    });
    // Fungsi untuk membuka modal detail 
    function openDetailModal(id) {
        document.getElementById(id).style.display = "flex"; // Tampilkan modal dengan ID yang sesuai
    }


    function closeDetailModal(id) {
        document.getElementById(id).style.display = "none"; // Sembunyikan modal dengan ID yang sesuai
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".detail-btn").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const modalId = this.getAttribute("data-target").substring(1); // Ambil ID modal dari atribut data-target
                openDetailModal(modalId); // Panggil openDetailModal dengan ID yang tepat
            });
        });
    });
    //javascript untuk pagination
    document.addEventListener('DOMContentLoaded', function() {
        const rowsPerPage = 10; // Ubah angka ini untuk mengatur jumlah data per halaman
        let currentPage = 1;
        const tableBody = document.getElementById('documentTable');
        const rows = Array.from(tableBody.getElementsByTagName('tr')); // Mengambil semua baris data

        function displayPage(page) {
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            rows.forEach((row, index) => {
                row.style.display = (index >= start && index < end) ? '' : 'none';
            });
        }

        function updatePaginationButtons() {
            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = currentPage === Math.ceil(rows.length / rowsPerPage);

            // Update status tombol page-button
            document.querySelectorAll('.page-button').forEach(button => {
                button.classList.toggle('active', parseInt(button.getAttribute('data-page')) === currentPage);
            });
        }

        // Event listener untuk tombol page-button
        document.querySelectorAll('.page-button').forEach(button => {
            button.addEventListener('click', function() {
                currentPage = parseInt(this.getAttribute('data-page'));
                displayPage(currentPage);
                updatePaginationButtons();
            });
        });

        // Event listener untuk tombol Previous dan Next
        document.getElementById('prevPage').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                displayPage(currentPage);
                updatePaginationButtons();
            }
        });

        document.getElementById('nextPage').addEventListener('click', function() {
            if (currentPage < Math.ceil(rows.length / rowsPerPage)) {
                currentPage++;
                displayPage(currentPage);
                updatePaginationButtons();
            }
        });

        // Tampilkan halaman pertama pada saat halaman dimuat
        displayPage(currentPage);
        updatePaginationButtons();
    });

    // Event listener untuk tombol delete
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: `Ingin menghapus data pengguna "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('master/pengguna/delete/') ?>" + id;
                }
            });
        });
    });

    // Reset Password
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".resetpassword").forEach(button => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const name = this.getAttribute("data-name");

                // SweetAlert konfirmasi reset password
                Swal.fire({
                    title: 'Reset Password',
                    text: `Apakah Anda yakin ingin mereset password untuk pengguna "${name}"? Password akan direset ke default.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Reset Password',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke URL reset password
                        window.location.href = "<?= base_url('master/pengguna/reset_password/') ?>" + id;
                    }
                });
            });
        });
    });
</script>