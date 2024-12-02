<?php

namespace App\Controllers;

use App\Models\ModelArsip;
use App\Models\ModelPencipta;
use App\Models\ModelUnit;
use App\Models\ModelKlasifikasi;
use App\Models\ModelNotifikasi;
use CodeIgniter\View\Parser;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\Text;
use PhpOffice\PhpWord\Element\TextRun;
use thiagoalessio\TesseractOCR\TesseractOCR;
use PhpOffice\PhpWord\Settings;

Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
Settings::setPdfRendererPath('vendor/dompdf/dompdf');

class Arsip extends BaseController
{
    protected $ModelArsip;
    protected $ModelPencipta;
    protected $ModelUnit;
    protected $ModelKlasifikasi;
    protected $ModelNotifikasi;

    public function __construct()
    {
        helper('form');
        $this->ModelArsip = new ModelArsip();
        $this->ModelPencipta = new ModelPencipta();
        $this->ModelUnit = new ModelUnit();
        $this->ModelKlasifikasi = new ModelKlasifikasi();
        $this->ModelNotifikasi = new ModelNotifikasi();
    }

    public function index()
    {
        $unreadNotifications = $this->ModelNotifikasi->getUnreadNotifications(session()->get('id_pengguna'));
        $unreadCount = count($unreadNotifications);
        $data = [
            'title' => 'E-Arsip',
            'sub'   => 'Manajemen Arsip',
            'content' => 'arsip/v_index',
            'arsip' => $this->ModelArsip->allData(),
            'pencipta' => $this->ModelPencipta->allData(),
            'unit' => $this->ModelUnit->allData(),
            'klasifikasi' => $this->ModelKlasifikasi->allData(),
            'unreadNotifications' => $unreadNotifications,
            'unreadCount' => $unreadCount
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        if ($this->validate([
            'no_arsip' => [
                'label' => 'Nomor Doktrin',
                'rules' => 'required|is_unique[tb_arsip.no_arsip]|max_length[50]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 50 karakter!'
                ]
            ],
            'tgl_doktrin' => [
                'label' => 'Tanggal Doktrin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'no_kode' => [
                'label' => 'Nomor Kode',
                'rules' => 'required|max_length[25]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'max_length' => '{field} maksimal terdiri dari 25 karakter!'
                ]
            ],
            'no_reg' => [
                'label' => 'Nomor Registrasi',
                'rules' => 'required|max_length[25]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'max_length' => '{field} maksimal terdiri dari 25 karakter!'
                ]
            ],
            'kategori' => [
                'label' => 'Klasifikasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_pencipta' => [
                'label' => 'Asal Doktrin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_klasifikasi' => [
                'label' => 'Jenis Doktrin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'perihal' => [
                'label' => 'Perihal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'tgl_masuk' => [
                'label' => 'Tanggal Surat Masuk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_unit' => [
                'label' => 'Unit Organisasi',
                'rules' => 'permit_empty',
                'errors' => [
                    'permit_empty' => '{field} boleh kosong!'
                ]
            ],
            'nama_file' => [
                'label' => 'File',
                'rules' => 'uploaded[nama_file]|max_size[nama_file,102400]|mime_in[nama_file,application/pdf,image/jpeg,image/jpg,image/png,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                'errors' => [
                    'uploaded' => '{field} harus berupa file!',
                    'max_size' => '{field} maksimal 100MB!',
                    'mime_in' => '{field} hanya berupa file PDF, JPEG, PNG, DOC, dan DOCX!'
                ]
            ],
            'created_by' => [
                'label' => 'Ditambahkan Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $file = $this->request->getFile('nama_file');
            if ($file->isValid() && !$file->hasMoved()) {
                $fileType = $file->getClientMimeType();
                $fileName = $file->getRandomName();
                $filePath = WRITEPATH . 'uploads/' . $fileName;

                if ($fileType === 'application/pdf') {
                    // Jika sudah PDF, simpan langsung
                    $file->move(WRITEPATH . 'uploads', $fileName);
                    $text = $this->extractTextFromPDF($filePath);
                } elseif ($fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                    // Konversi .docx ke PDF
                    $phpWord = IOFactory::load($file->getTempName());
                    $pdfFile = WRITEPATH . 'uploads/' . pathinfo($fileName, PATHINFO_FILENAME) . '.pdf';
                    $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
                    $pdfWriter->save($pdfFile);

                    // Update path ke file PDF hasil konversi
                    $filePath = $pdfFile;

                    // Ekstraksi teks dari file PDF hasil konversi
                    if (file_exists($filePath)) {
                        $text = $this->extractTextFromPDF($filePath);
                    } else {
                        $text = '';
                        session()->setFlashdata('error', 'Gagal mengekstrak teks dari file yang dikonversi.');
                    }
                } elseif (in_array($fileType, ['image/jpeg', 'image/jpg', 'image/png'])) {
                    // Konversi gambar ke PDF
                    $pdfFile = WRITEPATH . 'uploads/' . pathinfo($fileName, PATHINFO_FILENAME) . '.pdf';

                    // Menggunakan FPDF
                    $pdf = new \FPDF();
                    $pdf->AddPage();

                    // Periksa jika format tidak didukung langsung oleh FPDF
                    $tempImagePath = WRITEPATH . 'uploads/' . pathinfo($fileName, PATHINFO_FILENAME) . '.png';
                    if ($this->convertImageToPNG($file->getTempName(), $tempImagePath)) {
                        $pdf->Image($tempImagePath, 10, 10, 190);
                    } else {
                        session()->setFlashdata('error', 'Gagal mengonversi gambar ke format yang didukung.');
                        return redirect()->to(base_url('manajemen/arsip'));
                    }

                    $pdf->Output($pdfFile, 'F'); // Simpan PDF

                    // Update path ke file PDF hasil konversi
                    $filePath = $pdfFile;

                    // Tidak ada teks yang dapat diekstrak dari gambar
                    $text = '';
                } else {
                    session()->setFlashdata('error', 'Format file tidak didukung untuk diunggah.');
                    return redirect()->to(base_url('manajemen/arsip'));
                }

                // Data untuk disimpan ke database
                $data = [
                    'no_arsip' => $this->request->getPost('no_arsip'),
                    'no_kode' => $this->request->getPost('no_kode'),
                    'no_reg' => $this->request->getPost('no_reg'),
                    'tgl_doktrin' => $this->request->getPost('tgl_doktrin'),
                    'id_pencipta' => $this->request->getPost('id_pencipta'),
                    'kategori' => $this->request->getPost('kategori'),
                    'id_klasifikasi' => $this->request->getPost('id_klasifikasi'),
                    'perihal' => $this->request->getPost('perihal'),
                    'tgl_masuk' => $this->request->getPost('tgl_masuk'),
                    'id_unit' => $this->request->getPost('id_unit'),
                    'nama_file' => pathinfo($filePath, PATHINFO_BASENAME),
                    'tipe_file' => 'application/pdf',
                    'path_file' => $filePath,
                    'isi_file' => $text,
                    'created_by' => $this->request->getPost('created_by')
                ];

                $this->ModelArsip->add($data);
                session()->setFlashdata('success', 'Data arsip berhasil ditambahkan.');
                return redirect()->to(base_url('manajemen/arsip'));
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('manajemen/arsip'));
        }
    }

    public function edit($id_arsip)
    {
        if ($this->validate([
            'no_arsip' => [
                'label' => 'Nomor Doktrin',
                'rules' => 'required|max_length[50]|is_unique[tb_arsip.no_arsip,id_arsip,' . $id_arsip . ']',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 50 karakter!'
                ]
            ],
            'tgl_doktrin' => [
                'label' => 'Tanggal Doktrin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_pencipta' => [
                'label' => 'Asal Doktrin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_klasifikasi' => [
                'label' => 'Jenis Doktrin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'perihal' => [
                'label' => 'Perihal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'tgl_masuk' => [
                'label' => 'Tanggal Surat Masuk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'id_unit' => [
                'label' => 'Unit Organisasi',
                'rules' => 'permit_empty'
            ],
            'nama_file' => [
                'label' => 'File',
                'rules' => 'permit_empty|max_size[nama_file,51200]|mime_in[nama_file,application/pdf,image/jpeg,image/jpg,image/png,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                'errors' => [
                    'max_size' => '{field} maksimal 50MB!',
                    'mime_in' => '{field} hanya berupa file PDF, JPEG, PNG, DOC, dan DOCX!'
                ]
            ],
            'edited_by' => [
                'label' => 'Diubah Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $file = $this->request->getFile('nama_file');
            $arsipLama = $this->ModelArsip->find($id_arsip);
            $filePath = $arsipLama->path_file;
            $text = $arsipLama->isi_file;

            if ($file->isValid() && !$file->hasMoved()) {
                // Hapus file lama jika ada file baru diunggah
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $fileType = $file->getClientMimeType();
                $fileName = $file->getRandomName();
                $filePath = WRITEPATH . 'uploads/' . $fileName;

                if ($fileType === 'application/pdf') {
                    $file->move(WRITEPATH . 'uploads', $fileName);
                    $text = $this->extractTextFromPDF($filePath);
                } elseif ($fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                    $phpWord = IOFactory::load($file->getTempName());
                    $pdfFile = WRITEPATH . 'uploads/' . pathinfo($fileName, PATHINFO_FILENAME) . '.pdf';
                    $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
                    $pdfWriter->save($pdfFile);

                    $filePath = $pdfFile;
                    if (file_exists($filePath)) {
                        $text = $this->extractTextFromPDF($filePath);
                    } else {
                        $text = '';
                        session()->setFlashdata('error', 'Gagal mengekstrak teks dari file yang dikonversi.');
                    }
                } else {
                    session()->setFlashdata('error', 'Format file tidak didukung untuk diunggah.');
                    return redirect()->to(base_url('manajemen/arsip'));
                }
            }

            $data = [
                'no_arsip' => $this->request->getPost('no_arsip'),
                'tgl_doktrin' => $this->request->getPost('tgl_doktrin'),
                'id_pencipta' => $this->request->getPost('id_pencipta'),
                'id_klasifikasi' => $this->request->getPost('id_klasifikasi'),
                'perihal' => $this->request->getPost('perihal'),
                'tgl_masuk' => $this->request->getPost('tgl_masuk'),
                'id_unit' => $this->request->getPost('id_unit'),
                'nama_file' => $fileName ?? $arsipLama->nama_file,
                'tipe_file' => 'application/pdf',
                'path_file' => $filePath,
                'isi_file' => $text,
                'edited_by' => $this->request->getPost('edited_by')
            ];

            $this->ModelArsip->update($id_arsip, $data);
            session()->setFlashdata('success', 'Data arsip berhasil diubah.');
            return redirect()->to(base_url('manajemen/arsip'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('manajemen/arsip'));
        }
    }

    public function delete($id_arsip)
    {
        $data = [
            'id_arsip' => $id_arsip
        ];
        $this->ModelArsip->delete_data($data);
        session()->setFlashdata('success', 'Data arsip berhasil dihapus!');
        return redirect()->to(base_url('manajemen/arsip'));
    }

    private function extractTextFromPDF($filePath)
    {
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($filePath);
        $text = $pdf->getText();
        return $text;
    }

    public function extractTextFromDocx($filePath)
    {
        // Muat dokumen
        $phpWord = IOFactory::load($filePath);
        $text = '';

        // Iterasi melalui semua bagian dokumen
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                // Jika elemen adalah teks langsung
                if ($element instanceof Text) {
                    $text .= $element->getText() . " ";
                }
                // Jika elemen adalah kumpulan teks (TextRun)
                elseif ($element instanceof TextRun) {
                    foreach ($element->getElements() as $childElement) {
                        if ($childElement instanceof Text) {
                            $text .= $childElement->getText() . " ";
                        }
                    }
                }
            }
        }

        return $text;
    }

    private function extractTextFromImage($filePath)
    {
        $ocr = new TesseractOCR($filePath);
        $ocr->lang('ind');
        return $ocr->run();
    }

    public function convertImageToPNG($sourcePath, $destinationPath)
    {
        $image = imagecreatefromstring(file_get_contents($sourcePath));
        if ($image === false) {
            return false; // Gagal memuat gambar
        }
        imagepng($image, $destinationPath); // Simpan sebagai PNG
        imagedestroy($image); // Hapus dari memori
        return true;
    }
}
