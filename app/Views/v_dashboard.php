<body>
    <div class="home">
        <div class="container-home">
            <div class="card card-waves mb-4 mt-5 card-red">
                <div class="card-body p-3">
                    <div class="row align-items-center justify-content-between">
                        <div class="col">
                            <h2 class="greetings"><b>Selamat Datang, Admin!</b></h2>
                            <p style="color: white;">
                                Selamat datang di portal E-Doktrin, solusi digital untuk pengelolaan arsip dan dokumen yang mudah, cepat, dan aman. Semoga portal ini mendukung efisiensi dan kemudahan akses bagi semua pengguna.
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

            $.ajax({
                url: '<?= base_url('/dashboard/search') ?>',
                method: 'POST',
                data: {
                    keywords: query
                },
                dataType: 'json',
                success: function(results) {
                    displayResults(results);
                },
                error: function() {
                    console.error('Failed to fetch search results.');
                }
            });
        }

        function displayResults(results) {
            const container = document.getElementById('results-container');
            container.innerHTML = '';

            if (results.length === 0) {
                container.innerHTML = '<p>No results found.</p>';
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
                <img src="<?= base_url('public/assets/images/pdf.png'); ?>" alt="Thumbnail" class="thumbnail">
                <div class="content ml-3">
                    <h5 class="card-title" style="text-align: left;">${result.no_arsip}</h5>
                    <p class="card-text" style="text-align: left;">${result.perihal}</p>
                    <div class="btn-container">
                        <button class="btn custom-preview">Preview</button>
                        <button class="btn custom-download">Download</button>
                    </div>
                </div>
            </div>
        `;
                mainCard.appendChild(resultElement);
            });

            const pagination = displayPagination(results.length);
            mainCard.appendChild(pagination);

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