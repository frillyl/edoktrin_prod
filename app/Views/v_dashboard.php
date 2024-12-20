<div class="home">
    <div class="container-home">
        <div class="card card-waves mb-4 mt-5 card-red">
            <div class="card-body p-3">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <h2 class="greetings"><b>Selamat Datang, <?= session('nama') ?>!</b></h2>
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
                        <div class="top-text"><?= $jmlKategori1 ?></div>
                        <div class="bottom-text">TOTAL ARSIP KATEGORI SANGAT RAHASIA</div>
                    </div>
                    <div class="right-home"></div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-2 mx-1">
                <div class="card custom-card d-flex flex-row">
                    <div class="left-home alt-left">
                        <div class="top-text"><?= $jmlKategori2 ?></div>
                        <div class="bottom-text">TOTAL ARSIP KATEGORI RAHASIA</div>
                    </div>
                    <div class="right-home alt-right"></div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-2 mx-1">
                <div class="card custom-card d-flex flex-row">
                    <div class="left-home">
                        <div class="top-text"><?= $jmlKategori3 ?></div>
                        <div class="bottom-text">TOTAL ARSIP KATEGORI UMUM</div>
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
                                    <input type="text" id="search-input" placeholder="Masukkan kata kunci pencarian Anda disini...">
                                    <button onclick="performSearch()">Cari</button>
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

<!-- Modal untuk Preview PDF -->
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
        <div class="custom-modal-body" style="overflow-y: auto;">
            <iframe id="pdfViewer" style="width: 100%; height: 500px;" src=""></iframe>
        </div>
    </div>
</div>
<!-- END OF MODAL SHOW PDF -->