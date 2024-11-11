<footer id="footer">
    <p>Copyright 2024 © Pusinfolahta TNI</p>
</footer>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="<?= base_url() ?>/public/assets/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.4.20/sweetalert2.all.min.js"></script>


<script src="<?= base_url() ?>/public/assets/js/main.js"></script>

<script>
    // Tampilkan alert sukses dengan SweetAlert jika ada
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('success') ?>',
            showConfirmButton: false,
            timer: 3000
        });
    <?php endif; ?>

    // Tampilkan alert error dengan SweetAlert jika ada
    <?php if (session()->getFlashdata('errors')) : ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            html: `
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            `,
            showConfirmButton: false,
            timer: 5000
        });
    <?php endif; ?>
</script>
<script>
    document.getElementById('nama_depan').addEventListener('input', function() {
        let namaDepan = this.value.toLowerCase();
        let randomNum = Math.floor(10 + Math.random() * 90);
        document.getElementById('username').value = namaDepan + randomNum;
    });
</script>
<script>
    // Inisialisasi tooltips pada semua elemen yang memiliki atribut data-toggle="tooltip"
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#documentTable tr');
        let hasVisibleRows = false;

        rows.forEach(row => {
            const nrp = row.cells[1].textContent.toLowerCase();
            const nama = row.cells[2].textContent.toLowerCase();

            if (nrp.includes(filter) || nama.includes(filter)) {
                row.style.display = '';
                hasVisibleRows = true;
            } else {
                row.style.display = 'none';
            }
        });

        document.getElementById('noDataMessage').style.display = hasVisibleRows ? 'none' : 'block';
    });

    let isAscendingNRP = true; // Status urutan kolom NRP
    let isAscendingNama = true; // Status urutan kolom Nama

    // Fungsi untuk mengurutkan tabel
    function sortTable(columnIndex, isAscending) {
        const rows = Array.from(document.querySelectorAll('#documentTable tr'));

        rows.sort((a, b) => {
            const cellA = a.cells[columnIndex].textContent.toLowerCase();
            const cellB = b.cells[columnIndex].textContent.toLowerCase();

            if (cellA < cellB) return isAscending ? -1 : 1;
            if (cellA > cellB) return isAscending ? 1 : -1;
            return 0;
        });

        const tbody = document.getElementById('documentTable');
        tbody.innerHTML = ''; // Hapus isi tbody
        rows.forEach(row => tbody.appendChild(row)); // Tambahkan kembali dalam urutan baru
    }

    // Event listener untuk sorting berdasarkan NRP
    document.getElementById('sortNRP').addEventListener('click', function() {
        sortTable(1, isAscendingNRP);
        isAscendingNRP = !isAscendingNRP; // Toggle urutan
        this.querySelector('i').classList.toggle('fa-sort-alpha-down');
        this.querySelector('i').classList.toggle('fa-sort-alpha-up');
    });

    // Event listener untuk sorting berdasarkan Nama Anggota
    document.getElementById('sortNama').addEventListener('click', function() {
        sortTable(2, isAscendingNama);
        isAscendingNama = !isAscendingNama; // Toggle urutan
        this.querySelector('i').classList.toggle('fa-sort-alpha-down');
        this.querySelector('i').classList.toggle('fa-sort-alpha-up');
    });
</script>
<script>
    document.querySelector('.icon-container').addEventListener('click', function() {
        // Lakukan AJAX untuk menandai notifikasi sebagai dibaca
        fetch("<?= base_url('master/markNotificationsAsRead') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": "<?= csrf_hash() ?>"
                },
                body: JSON.stringify({
                    id_pengguna: <?= session()->get('id_pengguna') ?>
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hilangkan badge notifikasi jika berhasil
                    document.querySelector('.badge').style.display = 'none';
                }
            });
    });
</script>
</body>

</html>