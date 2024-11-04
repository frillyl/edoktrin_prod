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

                <tr>
                    <td>1</td>
                    <td>K.0.0.001</td>
                    <td>Jenis Doktrin A</td>
                    <td>0 Tahun</td>
                    <td>
                        <div class="action-buttons">
                            <button id="openDetailModal" class="detail-btn" style="background-color: #27A6B1;"><i class="fa-solid fa-info"></i> Detail</button>
                            <button class="ubahunit" id="openEditModal"><i class="fa-solid fa-pen"></i> Ubah</button>
                            <button class="delete-btn"><i class="fas fa-trash"></i> Hapus</button>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>K.0.0.002</td>
                    <td>Jenis Doktrin B</td>
                    <td>0 Tahun</td>
                    <td>
                        <div class="action-buttons">
                            <button id="openDetailModal" class="detail-btn" style="background-color: #27A6B1;"><i class="fa-solid fa-info"></i> Detail</button>
                            <button class="ubahunit" id="openEditModal"><i class="fa-solid fa-pen"></i> Ubah</button>
                            <button class="delete-btn"><i class="fas fa-trash"></i> Hapus</button>
                        </div>
                    </td>
                </tr>

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
    <div class="custom-modal-content2">
        <span class="close-button" id="closeAddModal" style="margin-right: 5px;">&times;</span>
        <h2 id="addModalTitle" style="margin-top: 40px;">Tambah Data Asal Doktrin</h2>

        <div class="left-align-group">
            <label for="kodeDoktrinAdd" class="left-label">Kode Doktrin</label>
            <input type="text" id="kodeDoktrinAdd" placeholder="">
        </div>

        <div class="left-align-group">
            <label for="jenisDoktrinAdd" class="left-label">Jenis Doktrin</label>
            <input type="text" id="jenisDoktrinAdd" placeholder="">
        </div>

        <div class="left-align-group">
            <label for="retensiAdd" class="left-label">Retensi</label>
            <input type="text" id="retensiAdd" placeholder="">
        </div>

        <div class="left-align-group">
            <label for="kategoriDoktrinAdd" style="font-weight: 600;">Kategori</label>
            <select id="kategoriDoktrinAdd" class="form-select">
                <option value="" disabled selected>--pilih kategori--</option>
                <option value="sangat-rahasia">Sangat Rahasia</option>
                <option value="rahasia">Rahasia</option>
                <option value="umum">Umum</option>
            </select>
        </div>

        <div class="modal-buttons" style="margin-top: 50px; display: flex; align-items: center; justify-content: center;">
            <button class="btn btn-success save-modal" id="saveAddModalButton" style="background-color: #8A3A42; color: #ffff;">Tambah</button>
        </div>
    </div>
</div>


<!-- "Ubah" Modal Structure -->
<div id="editModal" class="custom-modal">
    <div class="custom-modal-content2">
        <span class="close-button" id="closeEditModal" style="margin-right: 5px;">&times;</span>
        <h2 id="editModalTitle" style="margin-top: 40px;">Ubah Data Asal Doktrin</h2>

        <div class="left-align-group">
            <label for="asalDoktrinEdit" class="left-label">Kode Doktrin</label>
            <input type="text" id="asalDoktrinEdit" placeholder="">
        </div>

        <div class="left-align-group">
            <label for="jenisDoktrinEdit" class="left-label">Jenis Doktrin</label>
            <input type="text" id="jenisDoktrinEdit" placeholder="">
        </div>

        <div class="left-align-group">
            <label for="retensiEdit" class="left-label">Retensi</label>
            <input type="text" id="retensiEdit" placeholder="">
        </div>

        <div class="left-align-group">
            <label for="kategoriDoktrinEdit" style="font-weight: 600;">Kategori</label>
            <select id="kategoriDoktrinEdit" class="form-select">
                <option value="" disabled selected>--pilih kategori--</option>
                <option value="sangat-rahasia">Sangat Rahasia</option>
                <option value="rahasia">Rahasia</option>
                <option value="umum">Umum</option>
            </select>
        </div>

        <div class="modal-buttons" style="margin-top: 50px; display: flex; align-items: center; justify-content: center;">
            <button class="btn btn-success save-modal" id="saveEditModalButton" style="background-color: #8A3A42; color: #ffff;">Simpan</button>
        </div>
    </div>
</div>


<!-- Modal Detail Asal Doktrin  -->
<div class="modal" id="detailModal">
    <div class="modal-content" style=" margin: 8% auto;">
        <button class="close-btn" id="closeDetailModal" style="top: -15px; margin-top: 5px;">×</button>
        <h2 style="margin-bottom: 10px; font-weight: 700; text-align: center;">Detail Data Jenis Doktrin</h2>
        <div class="modal-body">
            <p><strong>Kode:</strong> <span class="detail-value"></span></p>
            <p><strong>Jenis Doktrin:</strong> <span class="detail-value"></span></p>
            <p><strong>Retensi:</strong> <span class="detail-value"></span></p>
            <p><strong>Kategori:</strong> <span class="detail-value"></span></p>
            <p><strong>Ditambahkan Pada:</strong> <span class="detail-value"></span></p>
            <p><strong>Ditambahkan Oleh:</strong> <span class="detail-value"></span></p>
            <p><strong>Diubah Pada:</strong> <span class="detail-value"></span></p>
            <p><strong>Diubah Oleh:</strong> <span class="detail-value"></span></p>
        </div>
    </div>
</div>


<script>
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


    // JavaScript modal
    document.addEventListener('DOMContentLoaded', () => {
        const modals = [{
                openButton: 'openModal',
                closeButton: 'closeAddModal',
                modal: 'addModal'
            },
            {
                openButton: 'openEditModal',
                closeButton: 'closeEditModal',
                modal: 'editModal'
            },
            {
                openButton: 'openDetailModal',
                closeButton: 'closeDetailModal',
                modal: 'detailModal'
            }
        ];

        modals.forEach(({
            openButton,
            closeButton,
            modal
        }) => {
            const openModalButton = document.getElementById(openButton);
            const closeModalButton = document.getElementById(closeButton);
            const modalElement = document.getElementById(modal);

            // Function to open the modal
            if (openModalButton) {
                openModalButton.addEventListener('click', () => {
                    modalElement.style.display = 'block'; // Show the modal
                });
            }

            // Function to close the modal
            if (closeModalButton) {
                closeModalButton.addEventListener('click', () => {
                    modalElement.style.display = 'none'; // Hide the modal
                });
            }

            // Close modal if user clicks outside of the modal content
            window.addEventListener('click', (event) => {
                if (event.target === modalElement) {
                    modalElement.style.display = 'none'; // Hide the modal
                }
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                // Show SweetAlert confirmation
                Swal.fire({
                    text: "Apakah Anda Yakin Ingin Menghapus Data Pengguna?",
                    showCancelButton: true,
                    confirmButtonColor: "#8A3A42",
                    cancelButtonColor: "grey",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    customClass: {
                        actions: 'swal2-actions-right' // Custom class for button alignment
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Handle deletion logic here
                        const row = this.closest('tr'); // Get the row of the button clicked
                        row.remove(); // Remove the row

                        // Show success message
                        Swal.fire({
                            title: "Berhasil Dihapus",
                            icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>