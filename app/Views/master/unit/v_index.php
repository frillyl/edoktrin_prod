<div class="archive">
    <h3 class="title">Unit Organisasi</h3>

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
                    <th>Unit Organisasi</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="documentTable">
                <tr>
                    <td>1</td>
                    <td>Unit Organisasi A</td>
                    <td>
                        <div class="action-buttons">
                            <button class="detail-btn"><i class="fa-solid fa-info"></i> Detail</button>
                            <button class="ubahunit"><i class="fa-solid fa-pen"></i> Ubah</button>
                            <button class="delete-btn"><i class="fas fa-trash"></i> Hapus</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Unit Organisasi B</td>
                    <td>
                        <div class="action-buttons">
                            <button class="detail-btn"><i class="fa-solid fa-info"></i> Detail</button>
                            <button class="ubahunit"><i class="fa-solid fa-pen"></i> Ubah</button>
                            <button class="delete-btn"><i class="fas fa-trash"></i> Hapus</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>



    <!-- Pagination -->
    <div class="pagination-container">
        <a href="#" id="openModalLink" class="btn create-btn" style="background-color: #8A3A42; color: #ffff;">Tambah Data Unit Organisasi</a>
        <div class="pagination">
            <button id="prevPage" disabled><i class="fas fa-arrow-left"></i></button>
            <button class="page-button active" data-page="1">1</button>
            <button class="page-button" data-page="2">2</button>
            <button class="page-button" data-page="3">3</button>
            <button id="nextPage"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>

    <!-- "Tambah" Modal Structure -->
    <div id="addModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-button" id="closeAddModal">&times;</span>
            <h2 id="addModalTitle" style="margin-top: 30px;">Tambah Data Jenis Doktrin</h2>
            <div class="left-align-group">
                <label for="unitOrganisasiAdd">Unit Organisasi</label>
                <input type="text" id="unitOrganisasiAdd" placeholder="">
            </div>
            <div class="modal-buttons" style="margin-top: 50px; display: flex; align-items: center; justify-content: center;">
                <button class="btn btn-success save-modal" id="saveAddModalButton" style="background-color: #8A3A42; color: #ffff;">Tambah</button>
            </div>
        </div>
    </div>

    <!-- "Ubah" Modal Structure -->
    <div id="editModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-button" id="closeEditModal">&times;</span>
            <h2 id="editModalTitle" style="margin-top: 30px;">Ubah Data Unit Organisasi</h2>
            <div class="left-align-group">
                <label for="unitOrganisasiEdit">Unit Organisasi</label>
                <input type="text" id="unitOrganisasiEdit" placeholder="">
            </div>
            <div class="modal-buttons" style="margin-top: 50px; display: flex; align-items: center; justify-content: center;">
                <button class="btn btn-success save-modal" id="saveEditModalButton" style="background-color: #8A3A42; color: #ffff;">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal" id="detailModal">
        <div class="modal-content">
            <span class="close-button" id="closeDetailModal">&times;</span>
            <h2 style="margin-bottom: 30px; margin-top: 40px; font-weight: 700">Detail Data Unit Organisasi</h2>
            <div class="modal-body">
                <p><strong>Unit Organisasi:</strong> <span class="detail-value"></span></p>
                <p><strong>Ditambahkan Pada:</strong> <span class="detail-value"></span></p>
                <p><strong>Ditambahkan Oleh:</strong> <span class="detail-value"></span></p>
                <p><strong>Diubah Pada:</strong> <span class="detail-value"></span></p>
                <p><strong>Diubah Oleh:</strong> <span class="detail-value"></span></p>
            </div>
        </div>
    </div>



</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to open the "Tambah" modal
        function openCreateModal() {
            document.getElementById("addModal").style.display = "flex";
        }

        function closeCreateModal() {
            document.getElementById("addModal").style.display = "none";
        }
        document.getElementById("openModalLink").addEventListener("click", function(event) {
            event.preventDefault();
            openCreateModal();
        });
        document.getElementById("closeAddModal").addEventListener("click", function() {
            closeCreateModal();
        });

        // Function to open the "Ubah" modal
        function openEditModal() {
            document.getElementById("editModal").style.display = "flex";
        }

        function closeEditModal() {
            document.getElementById("editModal").style.display = "none";
        }
        document.querySelectorAll(".ubahunit").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                openEditModal();
            });
        });
        document.getElementById("closeEditModal").addEventListener("click", function() {
            closeEditModal();
        });

        // Function to open the "Detail" modal
        function openDetailModal() {
            document.getElementById("detailModal").style.display = "flex";
        }

        function closeDetailModal() {
            document.getElementById("detailModal").style.display = "none";
        }
        document.querySelectorAll(".detail-btn").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                openDetailModal();
                // Optionally, you can fill the detail modal with dynamic data here
            });
        });
        document.getElementById("closeDetailModal").addEventListener("click", function() {
            closeDetailModal();
        });
    });


    document.addEventListener('DOMContentLoaded', () => {
        const rowsPerPage = 10; // Set number of rows per page
        const rows = document.querySelectorAll('#documentTable tr'); // Select all table rows
        const totalRows = rows.length; // Total number of rows
        const totalPages = Math.ceil(totalRows / rowsPerPage); // Total pages based on rows per page
        let currentPage = 1; // Start on the first page

        function displayPage(page) {
            // Hide all rows
            rows.forEach((row) => {
                row.style.display = 'none';
            });

            // Calculate start and end row indices
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            // Show rows for the current page
            for (let i = start; i < end && i < totalRows; i++) {
                rows[i].style.display = ''; // Show the row
            }

            // Update active page button
            document.querySelectorAll('.page-button').forEach(button => {
                button.classList.remove('active');
            });
            const activeButton = document.querySelector(`.page-button[data-page="${page}"]`);
            if (activeButton) {
                activeButton.classList.add('active');
            }

            // Enable/disable pagination buttons
            document.getElementById('prevPage').disabled = page === 1; // Disable if on the first page
            document.getElementById('nextPage').disabled = page === totalPages; // Disable if on the last page
        }

        // Event listeners for pagination buttons
        document.querySelectorAll('.page-button').forEach(button => {
            button.addEventListener('click', () => {
                const page = parseInt(button.getAttribute('data-page')); // Get the page number
                currentPage = page; // Update the current page
                displayPage(currentPage); // Display the rows for the current page
            });
        });

        // Previous page button functionality
        document.getElementById('prevPage').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--; // Decrement current page
                displayPage(currentPage); // Display the new current page
            }
        });

        // Next page button functionality
        document.getElementById('nextPage').addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++; // Increment current page
                displayPage(currentPage); // Display the new current page
            }
        });

        // Initial display
        displayPage(currentPage);
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