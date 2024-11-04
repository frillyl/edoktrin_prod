<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <h1 class="h1-landing" style="margin-bottom: 60px; font-size: 30px; font-weight: 700;">Selamat Datang <br> di E-DOKTRIN PUSINFOLAHTA</h1>
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
                <?php if (!empty($results)): ?>
                    <?php foreach ($results as $arsip): ?>
                        <div class="main-card">
                            <h4 style="font-size: 16px; color: #5D5D5D; text-align: left; margin-bottom: 20px;">Hasil Pencarian Pada File:</h4>
                            <div class="result-item">
                                <div class="card-body d-flex align-items-start">
                                    <img src="<?= base_url() ?>/public/assets/images/Landing.png" alt="Thumbnail" class="thumbnail">
                                    <div class="content ml-3">
                                        <h5 class="card-title" style="text-align: left;">Judul Hasil Pencarian</h5>
                                        <p class="card-text" style="text-align: left;">Deskripsi hasil pencarian akan muncul di sini.</p>
                                        <div class="btn-container">
                                            <button class="btn custom-preview">Preview</button>
                                            <button class="btn custom-download">Download</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pagination" style="text-align: right; margin-top: 20px;">
                                <button class="btn"><i class="fas fa-arrow-left"></i></button>
                                <button class="btn page-btn" style="margin: 0 5px; background-color: #EAEAEA; color: black;">1</button>
                                <button class="btn"><i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h4 style="font-size: 16px; color: #5D5D5D; text-align: left; margin-bottom: 20px;">Data Tidak Ditemukan.</h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <footer>
        Copyright 2024 © Pusinfolahta TNI
    </footer>

    <script>
        let currentPage = 1;
        const itemsPerPage = 5;

        function performSearch() {
            const query = document.getElementById('search-input').value;

            const simulatedResults = [{
                    title: "1 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "2 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "3 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "4 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "5 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "6 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "7 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "8 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "9 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "10 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "11 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "12 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "13 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "14 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                },
                {
                    title: "15 Petunjuk Referensi Proses Pengambilan Keputusan Militer Dalam Rangka Operasi Militer Untuk Perang",
                    description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                }
            ];

            const results = simulatedResults.filter(item =>
                item.title.toLowerCase().includes(query.toLowerCase()) ||
                item.description.toLowerCase().includes(query.toLowerCase())
            );

            displayResults(results);
        }

        function displayResults(results) {
            const container = document.getElementById('results-container');
            container.innerHTML = '';

            if (results.length === 0) {
                container.innerHTML += '<p>No results found.</p>';
                return;
            }

            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedResults = results.slice(startIndex, endIndex);

            const mainCard = document.createElement('div');
            mainCard.className = 'main-card';

            const heading = document.createElement('h4');
            heading.textContent = 'Hasil Pencarian Pada File:';
            heading.style.fontSize = '16px';
            heading.style.color = '#5D5D5D';
            heading.style.textAlign = 'left';
            heading.style.marginBottom = '20px';
            mainCard.appendChild(heading);

            paginatedResults.forEach(result => {
                const resultElement = document.createElement('div');
                resultElement.className = 'result-item';
                resultElement.innerHTML = `
            <div class="card-body d-flex align-items-start">
                <img src="<?= base_url() ?>/public/assets/images/Landing.png" alt="Thumbnail" class="thumbnail">
                <div class="content ml-3">
                    <h5 class="card-title" style="text-align: left;">${result.title}</h5>
                    <p class="card-text" style="text-align: left;">${result.description}</p>
                    <div class="btn-container">
                        <button class="btn custom-preview">Preview</button>
                        <button class="btn custom-download">Download</button>
                    </div>
                </div>
            </div>
        `;
                mainCard.appendChild(resultElement);
            });

            // Create pagination element
            const pagination = displayPagination(results.length);
            mainCard.appendChild(pagination); // Add pagination to mainCard

            container.appendChild(mainCard);
        }

        function displayPagination(totalItems) {
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const pagination = document.createElement('div');
            pagination.className = 'pagination';
            pagination.style.textAlign = 'right'; // Align to right
            pagination.style.marginTop = '20px';

            // Left arrow button
            const leftArrow = document.createElement('button');
            leftArrow.innerHTML = '<i class="fas fa-arrow-left"></i>';
            leftArrow.className = 'btn';
            leftArrow.disabled = currentPage === 1;
            leftArrow.onclick = () => {
                if (currentPage > 1) {
                    currentPage--;
                    performSearch();
                }
            };
            pagination.appendChild(leftArrow);

            // Page number buttons
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('button');
                pageButton.className = 'btn page-btn';
                pageButton.textContent = i;
                pageButton.style.margin = '0 5px';
                pageButton.style.backgroundColor = i === currentPage ? '#8A3A42' : '#EAEAEA';
                pageButton.style.color = i === currentPage ? 'white' : 'black';

                pageButton.addEventListener('click', () => {
                    currentPage = i;
                    performSearch();
                });

                pagination.appendChild(pageButton);
            }

            // Right arrow button
            const rightArrow = document.createElement('button');
            rightArrow.innerHTML = '<i class="fas fa-arrow-right"></i>';
            rightArrow.className = 'btn';
            rightArrow.disabled = currentPage === totalPages;
            rightArrow.onclick = () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    performSearch();
                }
            };
            pagination.appendChild(rightArrow);

            return pagination; // Return pagination to be appended in mainCard
        }

        document.getElementById('search-input').addEventListener('click', function() {
            const container = document.getElementById('results-container');
            if (container.innerHTML !== '') {
                container.innerHTML = '';
            }
        });
    </script>

    <!-- Bootstrap JS (optional, for better styling of the cards) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>