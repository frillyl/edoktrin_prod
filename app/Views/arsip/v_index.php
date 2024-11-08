<div class="archive">

    <h3 class="title"><?= $sub ?></h3>

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

    <div class="card-table table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Doktrin</th>
                    <th>Tanggal Doktrin</th>
                    <th>Tanggal Masuk</th>
                    <th>Asal Doktrin</th>
                    <th>Jenis Doktrin</th>
                    <th>Unit Organisasi</th>
                    <th>Perihal</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="documentTable">
                <?php $no = 1;
                foreach ($arsip as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?>.</td>
                        <td><?= $value['no_arsip'] ?></td>
                        <td><?= date('j F Y', strtotime($value['tgl_doktrin'])) ?></td>
                        <td><?= date('j F Y', strtotime($value['tgl_masuk'])) ?></td>
                        <td><?= $value['pencipta'] ?></td>
                        <td><?= $value['klasifikasi'] ?></td>
                        <td><?= $value['unit'] ?></td>
                        <td><?= $value['perihal'] ?></td>
                        <td>
                            <div class="action-buttons">
                                <button class="detail-btn" data-toggle="tooltip" data-target="#info<?= $value['id_klasifikasi'] ?>" title="Lihat Detail"><i class="fa-solid fa-info"></i></button>
                                <button id="openEditModal" data-toggle="tooltip" class="ubahunit" title="Edit Data"><i class="fa-solid fa-pen"></i></button>
                                <button id="openDeleteModal" data-toggle="tooltip" class="delete-btn" title="Hapus Data"><i class="fas fa-trash"></i></button>
                                <button id="openPdfModal" data-toggle="tooltip" class="show-pdf" data-pdf="<?= base_url('assets/pdf/jurnal.pdf'); ?>" title="Lihat PDF">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        <button id="addButton" class="btn create-btn" style="background-color: #8A3A42; color: #ffff;">Tambah Arsip</button>
        <div class="pagination">
            <button id="prevPage" disabled><i class="fas fa-arrow-left"></i></button>
            <button class="page-button active" data-page="1">1</button>
            <button class="page-button" data-page="2">2</button>
            <button class="page-button" data-page="3">3</button>
            <button id="nextPage"><i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</div>

<!-- Modal ubah arsip -->
<div id="myEditModal" class="custom-modal">
    <div class="custom-modal-dialog">
        <div class="custom-modal-header">
            <h5 class="custom-modal-title">Ubah Data Arsip</h5>
            <button type="button" class="close-arsip" id="closeEditModalBtn" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="custom-modal-body">
            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nomor-doktrin-edit">Nomor Doktrin</label>
                        <input type="text" id="nomor-doktrin-edit" placeholder="Nomor Doktrin" class="input-arsip1">
                    </div>
                    <div class="form-group">
                        <label for="tanggal-doktrin-edit">Tanggal Doktrin</label>
                        <input type="date" id="tanggal-doktrin-edit" class="input-arsip1">
                    </div>
                    <div class="form-group">
                        <label for="tanggal-doktrin-masuk-edit">Tanggal Doktrin Masuk</label>
                        <input type="date" id="tanggal-doktrin-masuk-edit" class="input-arsip1">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group">
                        <label for="select-doktrin">Asal Doktrin</label>
                        <div class="custom-select">
                            <div class="select-selected">
                                Jenis Doktrin
                                <span class="dropdown-icon"></span>
                            </div>
                            <div class="select-items">
                                <div data-value="">option 1</div>
                                <div data-value="">option 2</div>
                                <div data-value="">option 3</div>
                                <div data-value="">option 4</div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="select-doktrin">Jenis Doktrin</label>
                        <div class="custom-select">
                            <div class="select-selected">
                                Jenis Doktrin
                                <span class="dropdown-icon"></span>
                            </div>
                            <div class="select-items">
                                <div data-value="JUKREF">JUKREF</div>
                                <div data-value="JUKGAR">JUKGAR</div>
                                <div data-value="JUKNIS">JUKNIS</div>
                                <div data-value="DOKTRIN">DOKTRIN</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis-doktrin-edit">Unit Organisasi</label>
                        <div class="custom-select">
                            <div class="select-selected">
                                Jenis Doktrin
                                <span class="dropdown-icon"></span>
                            </div>
                            <div class="select-items">
                                <div data-value="KEMHAN">KEMHAN</div>
                                <div data-value="MABES TNI">MABES TNI</div>
                                <div data-value="TNI AD">TNI AD</div>
                                <div data-value="TNI AU">TNI AU</div>
                                <div data-value="TNI AL">TNI AL</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="perihal-edit">Perihal</label>
                        <textarea id="perihal-edit" placeholder="Perihal" class="input-arsip"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="lampiran-edit">Lampiran</label>
                        <input type="file" id="lampiran-edit" class="input-arsip">
                    </div>
                </div>
                <div class="modal-buttons" style="margin-top: 30px; display: flex; align-items: center; justify-content: center;">
                    <button class="btn btn-success save-modal" id="saveEditModalButton" style="background-color: #8A3A42; color: #ffff;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DETAIL ARSIP  -->
<?php foreach ($arsip as $key => $value) { ?>
    <div class="modal" id="info<?= $value['id_arsip'] ?>">
        <div class="modal-content modal-content-detail" style=" margin: 10% auto;">
            <button class="close-btn" onclick="closeDetailModal('info<?= $value['id_arsip'] ?>')">×</button>
            <h2 style="margin-bottom: 30px; margin-top: 40px; font-weight: 700">Detail Data Arsip</h2>
            <div class="modal-body">
                <p><strong>Nomor Doktrin</strong><span class="detail-value"><?= $value['no_arsip'] ?></span></p>
                <p><strong>Tanggal Doktrin</strong><span class="detail-value"><?= date('j F Y', strtotime($value['tgl_doktrin'])) ?></span></p>
                <p><strong>Tanggal Masuk Doktrin</strong><span class="detail-value"><?= date('j F Y', strtotime($value['tgl_masuk'])) ?></span></p>
                <p><strong>Asal Doktrin</strong><span class="detail-value"><?= $value['pencipta'] ?></span></p>
                <p><strong>Jenis Doktrin</strong><span class="detail-value"><?= $value['klasifikasi'] ?></span></p>
                <p><strong>Unit Organisasi</strong><span class="detail-value"><?= $value['unit'] ?></span></p>
                <p><strong>Perihal</strong><span class="detail-value"><?= $value['perihal'] ?></span></p>
                <strong>Ditambahkan Pada</strong><span id="detailName" class="detail-value"><?= date('j F Y H:i:s', strtotime($value['created_at'])) ?></span></p>
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
<!-- END OF MODAL DETAIL ARSIP -->

<!-- MODAL ADD ARSIP -->
<div id="add" class="custom-modal">
    <div class="custom-modal-dialog">
        <div class="custom-modal-header">
            <h5 class="custom-modal-title">Tambah Data Arsip</h5>
            <button type="button" class="close-arsip" onclick="closeCreateModal()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="custom-modal-body">
            <?php
            echo form_open_multipart('manajemen/arsip/add', ['id' => 'form-arsip']);
            ?>
            <div class="form-row">
                <div class="form-group">
                    <label for="nomor-doktrin">Nomor Doktrin</label>
                    <input type="text" id="nomor-doktrin" name="no_arsip" placeholder="Nomor Doktrin" class="input-arsip1">
                </div>
                <div class="form-group">
                    <label for="tanggal-doktrin">Tanggal Doktrin</label>
                    <input type="date" id="tanggal-doktrin" name="tgl_doktrin" class="input-arsip1">
                </div>
                <div class="form-group">
                    <label for="tanggal-doktrin-masuk">Tanggal Doktrin Masuk</label>
                    <input type="date" id="tanggal-doktrin-masuk" name="tgl_masuk" class="input-arsip1">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="select-doktrin">Asal Doktrin</label>
                    <div class="custom-select" data-input-id="hidden-id-pencipta">
                        <div class="select-selected">Pilih Asal Doktrin<span class="dropdown-icon"></span></div>
                        <div class="select-items">
                            <?php foreach ($pencipta as $key => $value) { ?>
                                <div value="<?= $value['id_pencipta'] ?>"><?= $value['pencipta'] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_pencipta" id="hidden-id-pencipta">
                <div class="form-group">
                    <label for="select-doktrin">Jenis Doktrin</label>
                    <div class="custom-select" data-input-id="hidden-id-klasifikasi">
                        <div class="select-selected">Pilih Jenis Doktrin<span class="dropdown-icon"></span></div>
                        <div class="select-items">
                            <?php foreach ($klasifikasi as $key => $value) { ?>
                                <div value="<?= $value['id_klasifikasi'] ?>"><?= $value['kode'] ?> - <?= $value['klasifikasi'] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_klasifikasi" id="hidden-id-klasifikasi">
                <div class="form-group">
                    <label for="jenis-doktrin-edit">Unit Organisasi</label>
                    <div class="custom-select" data-input-id="hidden-id-unit">
                        <div class="select-selected">Pilih Unit Organisasi<span class="dropdown-icon"></span></div>
                        <div class="select-items">
                            <?php foreach ($unit as $key => $value) { ?>
                                <div value="<?= $value['id_unit'] ?>"><?= $value['unit'] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_unit" id="hidden-id-unit">
            </div>
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="perihal">Perihal</label>
                    <textarea id="perihal" name="perihal" placeholder="Perihal" class="input-arsip"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="lampiran">Lampiran</label>
                    <input type="file" class="input-arsip" id="lampiran" name="nama_file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="created_by" class="form-control" id="created_by" placeholder="Ditambahkan Oleh" value="<?= session('id_pengguna') ?>" hidden>
            </div>
            <div class="modal-buttons" style="margin-top: 30px; display: flex; align-items: center; justify-content: center;">
                <button type="submit" class="btn btn-success save-modal" id="saveEditModalButton" style="background-color: #8A3A42; color: #ffff;">Tambah</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<!-- END OF MODAL ADD ARSIP -->

<!-- Modal for displaying PDF -->
<div id="pdfModal" class="custom-modal">
    <div class="custom-modal-dialog">
        <div class="custom-modal-header" style="display: flex; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center;">
                <h5 class="custom-modal-title" style="margin-right: 10px;">Dokumen PDF</h5>
                <span id="pdfTitle"></span>
            </div>
            <button type="button" class="close-arsip" id="closePdfModalBtn" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="custom-modal-body">
            <iframe id="pdfViewer" style="width:100%; height: 500px;" src=""></iframe>
        </div>
    </div>
</div>


<!-- Modal pop-up for delete confirmation -->
<div id="deleteModal" class="custom-modal">
    <div class="modal-overlay" style="margin: 20% auto;">
        <span class="close-button" id="closeModal">&times;</span>
        <p>Apakah Anda Yakin Ingin Menghapus Data Pengguna <strong>Administrator</strong>?</p>
        <div class="modal-buttons">
            <button id="cancelBtn" class="cancel-btn">Batal</button>
            <button id="confirmDeleteBtn" class="delete-btn">Hapus</button>
        </div>
    </div>
</div>



<script>
    function openCreateModal() {
        document.getElementById("add").style.display = "flex";
    }

    // Fungsi untuk menutup modal
    function closeCreateModal() {
        document.getElementById("add").style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("addButton").addEventListener("click", function(event) {
            event.preventDefault();
            openCreateModal();
        });

        // Menutup dropdown saat mengklik di luar elemen dropdown
        document.addEventListener("click", function() {
            document.querySelectorAll('.select-items.open').forEach(openItems => {
                openItems.classList.remove('open');
            });
            document.querySelectorAll('.select-selected.open').forEach(openSelected => {
                openSelected.classList.remove('open');
            });
        });

        const selects = document.querySelectorAll('.custom-select');

        selects.forEach(select => {
            const selected = select.querySelector('.select-selected');
            const items = select.querySelector('.select-items');
            const hiddenInputId = select.getAttribute('data-input-id'); // Mendapatkan id dari atribut data-input-id
            const hiddenInput = document.getElementById(hiddenInputId);

            // Toggle tampilan dropdown saat elemen selected diklik
            selected.addEventListener('click', function(e) {
                e.stopPropagation(); // Mencegah klik di luar menutup dropdown saat diklik
                items.classList.toggle('open');
                selected.classList.toggle('open');
            });

            // Pilih opsi dan tutup dropdown
            items.querySelectorAll('div').forEach(option => {
                option.addEventListener('click', function(e) {
                    e.stopPropagation(); // Mencegah propagasi agar dropdown tidak tertutup sebelum opsi dipilih
                    selected.textContent = this.textContent;
                    items.classList.remove('open'); // Tutup dropdown
                    selected.classList.remove('open'); // Reset ikon

                    // Set nilai ke hidden input agar bisa dikirim melalui form
                    hiddenInput.value = this.getAttribute('value');
                });
            });
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
        document.getElementById(id).style.display = "block"; // Tampilkan modal dengan ID yang sesuai
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
                text: `Ingin menghapus data jenis doktrin "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('master/klasifikasi/delete/') ?>" + id;
                }
            });
        });
    });
</script>