<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>public/assets/images/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.4.20/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/css/style.css">
    <style>
        :root {
            --bg-position-x: 50%;
            /* Center horizontally */
            --bg-position-y: 50%;
            /* Center vertically */
            --bg-scale: 1;
            /* Default scale */
        }

        .background {
            background-image: url('<?= base_url() ?>/public/assets/images/back.png');
            background-size: 110%;
            /* Use cover or contain based on your requirement */
            background-position: var(--bg-position-x) var(--bg-position-y);
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            /* Full viewport height */
            image-rendering: crisp-edges;
            /* Ensures smooth rendering for large images */
            transition: background-size 0.3s;
            /* Smooth transition for zooming */
            padding: 0;
            /* Remove padding */
            margin: 0;
            /* Remove margin */
        }



        footer {
            background-color: #8A3A42;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body class="background" style="background-color: #EAEAEA;">
    <nav>
        <div class="judul">
            <img src="<?= base_url() ?>/public/assets/images/logo.png" alt="E-ARSIP Icon" class="logo"> E-ARSIP
        </div>

        <div class="icon-login">
            <a href="<?= base_url('login') ?>" class="btn  custom-login-btn">
                Login
            </a>
        </div>
    </nav>

    <div class="page-background">
        <div class="content">
            <h1 class="h1-landing" style="margin-bottom: 60px; font-size: 30px; font-weight: 700;">SELAMAT DATANG <br> DI E-DOKTRIN PUSINFOLAHTA</h1>
            <div class="searchcontainer">
                <div class="search">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="<?= base_url() ?>" class="search-2">
                                <input type="text" name="search" value="<?= esc($search) ?>" id="search-input" placeholder="Masukkan kata kunci pencarian Anda disini...">
                                <button type="submit">Cari</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="results-container">
                <div class="main-card">
                    <?php if (!empty($results)): ?>
                        <h4 style="font-size: 16px; color: #5D5D5D; text-align: left; margin-bottom: 20px;">Hasil Pencarian Pada File:</h4>
                        <?php foreach ($results as $arsip): ?>
                            <div class="result-item">
                                <div class="card-body d-flex align-items-start">
                                    <img src="<?= base_url() ?>/public/assets/images/pdf.png" alt="Thumbnail" class="thumbnail">
                                    <div class="content ml-3">
                                        <h5 class="card-title" style="text-align: left;"><?= $arsip['no_arsip'] ?></h5>
                                        <p class="card-text" style="text-align: left;"><?= $arsip['perihal'] ?></p>
                                        <div class="btn-container">
                                            <button class="btn custom-preview" data-pdf-url="<?= base_url('arsip/preview/' . basename($arsip['path_file'])); ?>">Lihat</button>
                                            <button class="btn custom-download">Unduh</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL SHOW PDF -->
                            <div id="pdfModal" class="custom-modal" style="display: none;">
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
                            <!-- END OF MODAL SHOW PDF -->
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h4 style="font-size: 16px; color: #5D5D5D; text-align: left; margin-bottom: 20px;">Data Tidak Ditemukan.</h4>
                    <?php endif; ?>

                    <!-- Pindahkan pagination di luar perulangan -->
                    <div class="pagination" style="text-align: right; margin-top: 20px;">
                        <button class="btn"><i class="fas fa-arrow-left"></i></button>
                        <button class="btn page-btn" style="margin: 0 5px; background-color: #EAEAEA; color: black;">1</button>
                        <button class="btn"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer>
        Copyright 2024 © Pusinfolahta TNI
    </footer>

    <script>
        let currentPage = 1;
        const resultsPerPage = 3; // Adjust this to your desired number of results per page

        // Function to display the search results for the current page
        function displayResults() {
            const mainCard = document.getElementById('main-card');
            const resultTemplate = document.getElementById('result-template');
            const paginationContainer = document.getElementById('pagination-container');

            // Clear any existing results inside the main-card
            mainCard.querySelectorAll('.result-item').forEach(item => {
                if (item !== resultTemplate) {
                    item.remove();
                }
            });

            const start = (currentPage - 1) * resultsPerPage;
            const end = start + resultsPerPage;

            // Show the current page results
            for (let i = start; i < end && i < results.length; i++) {
                const resultItem = resultTemplate.cloneNode(true);
                resultItem.style.display = 'block'; // Make it visible
                resultItem.querySelector('.card-title').textContent = results[i].title;
                resultItem.querySelector('.card-text').textContent = results[i].description;
                mainCard.insertBefore(resultItem, paginationContainer); // Insert before pagination
            }

            // Update pagination buttons
            updatePaginationButtons();
        }

        // Function to change the page
        function changePage(direction) {
            const totalPages = Math.ceil(results.length / resultsPerPage);
            currentPage = Math.min(Math.max(1, currentPage + direction), totalPages);
            displayResults();
        }

        // Function to update pagination buttons
        function updatePaginationButtons() {
            const totalPages = Math.ceil(results.length / resultsPerPage);
            const paginationContainer = document.getElementById('pagination-container');

            // Clear previous pagination buttons
            paginationContainer.innerHTML = '';

            // Previous button
            const prevButton = document.createElement('button');
            prevButton.classList.add('btn');
            prevButton.innerHTML = '<i class="fas fa-arrow-left"></i>';
            prevButton.onclick = () => changePage(-1);
            paginationContainer.appendChild(prevButton);

            // Page buttons
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('button');
                pageButton.classList.add('btn', 'page-btn');
                pageButton.style.margin = '0 5px';
                pageButton.style.backgroundColor = '#EAEAEA';
                pageButton.style.color = 'black';
                pageButton.textContent = i;
                pageButton.onclick = () => {
                    currentPage = i;
                    displayResults();
                };
                paginationContainer.appendChild(pageButton);
            }

            // Next button
            const nextButton = document.createElement('button');
            nextButton.classList.add('btn');
            nextButton.innerHTML = '<i class="fas fa-arrow-right"></i>';
            nextButton.onclick = () => changePage(1);
            paginationContainer.appendChild(nextButton);

            // Highlight the active page
            const pageButtons = paginationContainer.querySelectorAll('.page-btn');
            pageButtons.forEach(btn => {
                btn.style.backgroundColor = 'gray'; // Reset background color
            });
            if (pageButtons[currentPage - 1]) {
                pageButtons[currentPage - 1].style.backgroundColor = '#CCCCCC'; // Highlight active page
            }
        }
        // Initialize the first page display
        displayResults();
    </script>
    <script>
        // Event listener untuk semua tombol "Lihat" yang membuka modal PDF
        document.querySelectorAll('.custom-preview').forEach(button => {
            button.addEventListener('click', function() {
                // Ambil URL PDF dari atribut data
                const pdfUrl = this.getAttribute('data-pdf-url');

                // Set src dari iframe dengan URL PDF
                document.getElementById('pdfViewer').src = pdfUrl;

                // Tampilkan modal
                document.getElementById('pdfModal').style.display = 'block';
            });
        });

        // Event listener untuk menutup modal
        document.getElementById('closePdfModalBtn')?.addEventListener('click', function() {
            // Sembunyikan modal
            document.getElementById('pdfModal').style.display = 'none';

            // Kosongkan src iframe agar PDF tidak terus terbuka saat modal ditutup
            document.getElementById('pdfViewer').src = '';
        });

        // Pastikan modal ditutup jika klik di luar modal
        document.getElementById('pdfModal')?.addEventListener('click', function(event) {
            if (event.target === this) {
                document.getElementById('pdfModal').style.display = 'none';
                document.getElementById('pdfViewer').src = ''; // Kosongkan iframe
            }
        });
    </script>
    <!-- Bootstrap JS (optional, for better styling of the cards) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= base_url('public/assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>