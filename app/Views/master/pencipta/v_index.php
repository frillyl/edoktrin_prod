<div class="archive">
    <h3 class="title">Asal Doktrin</h3>
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
                                <button class="detail-btn" style="background-color: #27A6B1;" data-toggle="modal" data-target="#info<?= $value['id_pencipta'] ?>"><i class="fa-solid fa-info"></i> Detail</button>
                                <button class="ubahunit"><i class="fa-solid fa-pen"></i> Ubah</button>
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
        <a href="#" id="openModal" class="btn create-btn" style="background-color: #8A3A42; color: #ffff;">Tambah Data Asal Doktrin</a>
        <div class="pagination">
            <button id="prevPage" disabled><i class="fas fa-arrow-left"></i></button>
            <button class="page-button active" data-page="1">1</button>
            <button class="page-button" data-page="2">2</button>
            <button class="page-button" data-page="3">3</button>
            <button id="nextPage"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</div>

<!-- "Tambah" Modal Structure -->
<div id="addModal" class="custom-modal">
    <div class="custom-modal-content" style=" margin: 10% auto;">
        <span class="close-button" id="closeAddModal">&times;</span>
        <h2 id="addModalTitle" style="margin-top: 30px;">Tambah Data Asal Doktrin</h2>
        <div class="left-align-group">
            <label for="asalDoktrinAdd">Asal Doktrin</label>
            <input type="text" id="asalDoktrinAdd" placeholder="">
        </div>
        <div class="modal-buttons" style="margin-top: 50px; display: flex; align-items: center; justify-content: center;">
            <button class="btn btn-success save-modal" id="saveAddModalButton" style="background-color: #8A3A42; color: #ffff;">Tambah</button>
        </div>
    </div>
</div>

<!-- "Ubah" Modal Structure -->
<div id="editModal" class="custom-modal">
    <div class="custom-modal-content" style=" margin: 10% auto;">
        <span class="close-button" id="closeEditModal">&times;</span>
        <h2 id="editModalTitle" style="margin-top: 30px;">Ubah Data Asal Doktrin</h2>
        <div class="left-align-group">
            <label for="asalDoktrinEdit">Asal Doktrin</label>
            <input type="text" id="asalDoktrinEdit" placeholder="">
        </div>
        <div class="modal-buttons" style="margin-top: 50px; display: flex; align-items: center; justify-content: center;">
            <button class="btn btn-success save-modal" id="saveEditModalButton" style="background-color: #8A3A42; color: #ffff;">Simpan</button>
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
                <p><strong>Asal Doktrin</strong> <span id="detailNrp" class="detail-value"></span></p>
                <p><strong>Ditambahkan Pada</strong> <span id="detailName" class="detail-value"></span></p>
                <p><strong>Ditambahkan Oleh</strong> <span id="detailUsername" class="detail-value"></span></p>
                <p><strong>Diubah Pada</strong> <span id="detailRole" class="detail-value"></span></p>
                <p><strong>Diubah Oleh</strong> <span id="detailAddedOn" class="detail-value"></span></p>
            </div>
        </div>
    </div>
<?php } ?>

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