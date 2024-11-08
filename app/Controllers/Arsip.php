<?php

namespace App\Controllers;

use App\Models\ModelArsip;
use App\Models\ModelPencipta;
use App\Models\ModelUnit;
use App\Models\ModelKlasifikasi;
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

    public function __construct()
    {
        helper('form');
        $this->ModelArsip = new ModelArsip();
        $this->ModelPencipta = new ModelPencipta();
        $this->ModelUnit = new ModelUnit();
        $this->ModelKlasifikasi = new ModelKlasifikasi();
    }

    public function index()
    {
        $data = [
            'title' => 'E-Arsip',
            'sub'   => 'Manajemen Arsip',
            'content' => 'arsip/v_index',
            'arsip' => $this->ModelArsip->allData(),
            'pencipta' => $this->ModelPencipta->allData(),
            'unit' => $this->ModelUnit->allData(),
            'klasifikasi' => $this->ModelKlasifikasi->allData(),
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
                'rules' => 'uploaded[nama_file]|max_size[nama_file,51200]|mime_in[nama_file,application/pdf,image/jpeg,image/jpg,image/png,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]',
                'errors' => [
                    'uploaded' => '{field} harus berupa file!',
                    'max_size' => '{field} maksimal 50MB!',
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
                } else {
                    session()->setFlashdata('error', 'Format file tidak didukung untuk diunggah.');
                    return redirect()->to(base_url('manajemen/arsip'));
                }

                // Data untuk disimpan ke database
                $data = [
                    'no_arsip' => $this->request->getPost('no_arsip'),
                    'tgl_doktrin' => $this->request->getPost('tgl_doktrin'),
                    'id_pencipta' => $this->request->getPost('id_pencipta'),
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
}
