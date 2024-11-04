<body>
    <div class="home">
        <div class="container-home">
            <div class="card card-waves mb-4 mt-5 card-red">
                <div class="card-body p-3">
                    <div class="row align-items-center justify-content-between">
                        <div class="col">
                            <h2><b>Selamat Datang, Admin!</b></h2>
                            <p style="color: white;">
                                Lorem Ipsum is a standard placeholder text used in the printing and typesetting industry.
                                It serves to demonstrate visual elements such as fonts and layouts without the distraction of meaningful content.
                            </p>
                        </div>
                        <div class="col-auto d-none d-lg-block mt-xxl-n4">
                            <img src="<?= base_url() ?>/public/assets/images/file.png">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-xl-3 col-md-6 mb-2 mx-1">
                    <div class="card custom-card d-flex flex-row">
                        <div class="left-home">
                            <div class="top-text">35</div>
                            <div class="bottom-text">TOTAL ARSIP HARI INI</div>
                        </div>
                        <div class="right-home"></div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-2 mx-1">
                    <div class="card custom-card d-flex flex-row">
                        <div class="left-home alt-left">
                            <div class="top-text">35</div>
                            <div class="bottom-text">TOTAL ARSIP HARI INI</div>
                        </div>
                        <div class="right-home alt-right"></div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-2 mx-1">
                    <div class="card custom-card d-flex flex-row">
                        <div class="left-home">
                            <div class="top-text">35</div>
                            <div class="bottom-text">TOTAL ARSIP HARI INI</div>
                        </div>
                        <div class="right-home"></div>
                    </div>
                </div>
            </div>

            <div class="page-home">
                <div class="content">
                    <div class="searchcontainer">
                        <div class="search">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="search-2">
                                        <input type="text" id="search-input" placeholder="Search">
                                        <button onclick="performSearch()">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="results-container"></div> <!-- Add this div to hold search results -->
                </div>
            </div>
        </div>
    </div>

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
                <img src="<?= base_url('assets/img/Landing.png'); ?>" alt="Thumbnail" class="thumbnail">
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

</body>