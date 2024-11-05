<style>
    .custom-modal-content2 {
        background-color: #fff;
        margin: 1% auto;
        width: 80%;
        padding: 10px;
        border-radius: 10px;
        height: 96%;
        width: 40%;
        position: relative;
    }

    .left-align-group {
        margin-left: 20px;
        margin-right: 20px;
    }

    .left-align-group input {
        width: 100%;
        height: 50px;
        border-radius: 10px;
    }
</style>
<div class="archive">
    <h3 class="title">Jenis Doktrin</h3>
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
    <div class="card-table">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Jenis Doktrin</th>
                    <th>Retensi</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="documentTable">
                <?php $no = 1;
                foreach ($klasifikasi as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value['kode'] ?></td>
                        <td><?= $value['klasifikasi'] ?></td>
                        <td><?= $value['retensi'] ?> Tahun</td>
                        <td>
                            <div class="action-buttons">
                                <button class="detail-btn" style="background-color: #27A6B1;" data-toggle="modal" data-target="#info<?= $value['id_klasifikasi'] ?>"><i class="fa-solid fa-info"></i> Detail</button>
                                <button class="ubahunit" data-toggle="modal" data-target="#edit<?= $value['id_klasifikasi'] ?>"><i class="fa-solid fa-pen"></i> Ubah</button>
                                <button class="delete-btn"><i class="fas fa-trash"></i> Hapus</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <!-- Pagination -->
    <div class="pagination-container">
        <button id="addButton" class="btn create-btn" style="background-color: #8A3A42; color: #ffff;">Tambah Jenis Doktrin Baru</button>
        <div class="pagination">
            <button id="prevPage" disabled><i class="fas fa-arrow-left"></i></button>
            <button class="page-button active" data-page="1">1</button>
            <button class="page-button" data-page="2">2</button>
            <button class="page-button" data-page="3">3</button>
            <button id="nextPage"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</div>

<!-- MODAL DETAIL JENIS DOKTRIN  -->
<?php foreach ($klasifikasi as $key => $value) { ?>
    <div class="modal" id="info<?= $value['id_klasifikasi'] ?>">
        <div class="modal-content" style=" margin: 10% auto;">
            <button class="close-btn" onclick="closeDetailModal('info<?= $value['id_klasifikasi'] ?>')">×</button>
            <h2 style="margin-bottom: 30px; margin-top: 40px; font-weight: 700">Detail Data jenis doktrin</h2>
            <div class="modal-body">
                <p><strong>Kode</strong><span id="detailNrp" class="detail-value"><?= $value['kode'] ?></span></p>
                <p><strong>Jenis Doktrin</strong><span id="detailNrp" class="detail-value"><?= $value['klasifikasi'] ?></span></p>
                <p><strong>Retensi</strong><span id="detailNrp" class="detail-value"><?= $value['retensi'] ?> Tahun</span></p>
                <p><strong>Kategori</strong><span class="detail-value"><?php if ($value['kategori'] == '1') {
                                                                            echo 'Sangat Rahasia';
                                                                        } elseif ($value['kategori'] == '2') {
                                                                            echo 'Rahasia';
                                                                        } elseif ($value['kategori'] == '3') {
                                                                            echo 'Umum';
                                                                        } ?></span></p>
                <p><strong>Ditambahkan Pada</strong><span id="detailName" class="detail-value"><?= date('j F Y H:i:s', strtotime($value['created_at'])) ?></span></p>
                <p><strong>Ditambahkan Oleh</strong><span id="detailUsername" class="detail-value"><?= $value['created_by_name'] ?></span></p>
                <p><strong>Diubah Pada</strong><span id="detailRole" class="detail-value"><?php if ($value['edited_at'] == '') : ?>
                            Data jenis doktrin belum pernah diubah.
                        <?php else : ?>
                            <?= date('j F Y H:i:s', strtotime($value['edited_at'])) ?>
                        <?php endif; ?></span></p>
                <p><strong>Diubah Oleh</strong><span id="detailAddedOn" class="detail-value"><?php if ($value['edited_by'] == 0) : ?>
                            Data jenis doktrin belum pernah diubah.
                        <?php else : ?>
                            <?= $value['edited_by_name'] ?>
                        <?php endif; ?></span></p>
            </div>
        </div>
    </div>
<?php } ?>
<!-- END OF MODAL DETAIL JENIS DOKTRIN -->

<!-- MODAL ADD JENIS DOKTRIN -->
<div class="modal" id="add" style="display:none;">
    <div class="modal-content">
        <button class="close-btn" onclick="closeCreateModal()">×</button>
        <h2>Tambah Data Jenis Doktrin</h2>
        <div class="modal-body">
            <?php
            echo form_open('master/klasifikasi/add');
            ?>
            <div class="input-group">
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" id="kode" name="kode" placeholder="Kode">
                </div>
            </div>
            <div class="input-group">
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" id="klasifikasi" name="klasifikasi" placeholder="Jenis Doktrin">
                </div>
            </div>
            <div class="input-group">
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="number" min="0" id="retensi" value="0" name="retensi" placeholder="0">
                </div>
            </div>
            <div class="input-group">
                <div class="input-wrapper password-input-wrapper">
                    <select id="kategori" name="kategori" required>
                        <option value="" selected>Pilih Kategori</option>
                        <option value="">Pilih Kategori</option>
                        <option value="1">Sangat Rahasia</option>
                        <option value="2">Rahasia</option>
                        <option value="3">Umum</option>
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
<!-- END OF MODAL ADD JENIS DOKTRIN -->

<!-- MODAL EDIT JENIS DOKTRIN -->
<?php foreach ($klasifikasi as $key => $value) { ?>
    <div class="modal" id="edit<?= $value['id_klasifikasi'] ?>" style="display:none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeDetailModal('edit<?= $value['id_klasifikasi'] ?>')">×</button>
            <h2>Ubah Data Jenis Doktrin</h2>
            <div class="modal-body">
                <?php
                echo form_open('master/klasifikasi/edit/' . $value['id_klasifikasi']);
                ?>
                <div class="input-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="kode" name="kode" value="<?= $value['kode'] ?>" placeholder="Kode">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="klasifikasi" name="klasifikasi" value="<?= $value['klasifikasi'] ?>" placeholder="Jenis Doktrin">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="number" min="0" id="retensi" value="<?= $value['retensi'] ?>" name="retensi" placeholder="0">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-wrapper password-input-wrapper">
                        <select id="editKategori" name="kategori">
                            <option <?php if ($value['kategori'] == '') {
                                        echo 'selected';
                                    } ?> value="">Pilih Kategori</option>
                            <option <?php if ($value['kategori'] == 1) {
                                        echo 'selected';
                                    } ?> value="1">Sangat Rahasia</option>
                            <option <?php if ($value['kategori'] == 2) {
                                        echo 'selected';
                                    } ?> value="2">Rahasia</option>
                            <option <?php if ($value['kategori'] == 3) {
                                        echo 'selected';
                                    } ?> value="3">Umum</option>
                        </select>
                    </div>
                </div>
                <!-- Edited By -->
                <div class="input-group">
                    <input type="text" name="edited_by" value="<?= session('id_pengguna') ?>" class="form-control" id="edited_by" hidden>
                </div>
                <!-- Submit Button -->
                <div class="button-container">
                    <button type="submit" class="submit-btn">Update</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<?php } ?>
<!-- END OF MODAL EDIT JENIS DOKTRIN -->

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
</script>