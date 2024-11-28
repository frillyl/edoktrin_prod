<div class="archive">
    <h3 class="title">Asal Doktrin</h3>
    <div class="card-table search-card">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search">
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
                    <th>No.</th>
                    <th>Asal Doktrin</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="documentTable">
                <?php $no = 1;
                foreach ($pencipta as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $value['pencipta'] ?></td>
                        <td>
                            <div class="action-buttons">
                                <button class="detail-btn" data-toggle="tooltip" data-target="#info<?= $value['id_pencipta'] ?>" title="Lihat Detail"><i class="fa-solid fa-info"></i></button>
                                <button class="ubahunit" data-toggle="tooltip" data-target="#edit<?= $value['id_pencipta'] ?>" title="Edit Data"><i class="fa-solid fa-pen"></i></button>
                                <?php $role = session()->get('role'); ?>
                                <?php if (in_array($role, [1])): ?>
                                    <button class="delete-btn" data-toggle="tooltip" data-id="<?= $value['id_pencipta'] ?>" data-name="<?= $value['pencipta'] ?>" title="Hapus Data"><i class="fas fa-trash"></i></button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div id="noDataMessage" style="display: none; text-align: center; color: red; margin-top: 10px;">
            Tidak ditemukan data yang cocok
        </div>
    </div>

    <!-- Pagination -->
    <div class="pagination-container">
        <button id="addButton" class="btn create-btn" style="background-color: #8A3A42; color: #ffff;">Tambah Asal Doktrin Baru</button>
        <div class="pagination">
            <button id="prevPage" disabled><i class="fas fa-arrow-left"></i></button>
            <button class="page-button active" data-page="1">1</button>
            <button class="page-button" data-page="2">2</button>
            <button class="page-button" data-page="3">3</button>
            <button id="nextPage"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</div>

<!-- MODAL DETAIL ASAL DOKTRIN  -->
<?php foreach ($pencipta as $key => $value) { ?>
    <div class="modal" id="info<?= $value['id_pencipta'] ?>">
        <div class="modal-content" style=" margin: 10% auto;">
            <button class="close-btn" onclick="closeDetailModal('info<?= $value['id_pencipta'] ?>')">×</button>
            <h2 style="margin-bottom: 30px; margin-top: 40px; font-weight: 700">Detail Data Asal Doktrin</h2>
            <div class="modal-body">
                <p><strong>Asal Doktrin</strong><span id="detailNrp" class="detail-value"><?= $value['pencipta'] ?></span></p>
                <p><strong>Ditambahkan Pada</strong><span id="detailName" class="detail-value"><?= date('j F Y H:i:s', strtotime($value['created_at'])) ?></span></p>
                <p><strong>Ditambahkan Oleh</strong><span id="detailUsername" class="detail-value"><?= $value['created_by_name'] ?></span></p>
                <p><strong>Diubah Pada</strong><span id="detailRole" class="detail-value"><?php if ($value['edited_at'] == '') : ?>
                            Data asal doktrin belum pernah diubah.
                        <?php else : ?>
                            <?= date('j F Y H:i:s', strtotime($value['edited_at'])) ?>
                        <?php endif; ?></span></p>
                <p><strong>Diubah Oleh</strong><span id="detailAddedOn" class="detail-value"><?php if ($value['edited_by'] == 0) : ?>
                            Data asal doktrin belum pernah diubah.
                        <?php else : ?>
                            <?= $value['edited_by_name'] ?>
                        <?php endif; ?></span></p>
            </div>
        </div>
    </div>
<?php } ?>
<!-- END OF MODAL DETAIL ASAL DOKTRIN -->

<!-- MODAL ADD ASAL DOKTRIN -->
<div class="modal" id="add" style="display:none;">
    <div class="modal-content">
        <button class="close-btn" onclick="closeCreateModal()">×</button>
        <h2>Tambah Data Asal Doktrin</h2>
        <div class="modal-body">
            <?php
            echo form_open('master/pencipta/add');
            ?>
            <div class="input-group">
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" id="pencipta" name="pencipta" placeholder="Pencipta">
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
<!-- END OF MODAL ADD ASAL DOKTRIN -->

<!-- MODAL EDIT ASAL DOKTRIN -->
<?php foreach ($pencipta as $key => $value) { ?>
    <div class="modal" id="edit<?= $value['id_pencipta'] ?>" style="display:none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeDetailModal('edit<?= $value['id_pencipta'] ?>')">×</button>
            <h2>Ubah Data Asal Doktrin</h2>
            <div class="modal-body">
                <?php
                echo form_open('master/pencipta/edit/' . $value['id_pencipta']);
                ?>
                <div class="input-group">
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="pencipta" name="pencipta" value="<?= $value['pencipta'] ?>" placeholder="Pencipta">
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
<!-- END OF MODAL EDIT ASAL DOKTRIN -->

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
                text: `Ingin menghapus data asal doktrin "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('master/pencipta/delete/') ?>" + id;
                }
            });
        });
    });
</script>