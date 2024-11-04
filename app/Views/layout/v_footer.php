<footer id="footer">
    <p>Copyright 2024 © Pusinfolahta TNI</p>
</footer>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
</body>

</html>