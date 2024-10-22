<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Buku extends RestController {

    public function __construct() {
        parent::__construct();
        $this->load->database();  // Memuat database
        $this->load->model('Buku_model');  // Memuat model Buku
    }

    // GET: api/buku
    public function index_get($id = NULL) {
        // $id = $this->get('id_buku');
        if ($id === NULL) {
            // Jika tidak ada ID, ambil semua buku
            $buku = $this->Buku_model->getBuku();
        } else {
            // Ambil buku berdasarkan ID
            $buku = $this->Buku_model->getBuku($id);
        }

        if ($buku) {
            $this->response($buku, RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Buku tidak ditemukan'
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    // POST: api/buku
    public function index_post() {
        $data = [
            'judul_buku' => $this->post('judul_buku'),
            'penerbit' => $this->post('penerbit'),
            'tahun_terbit' => $this->post('tahun_terbit'),
            'isbn' => $this->post('isbn'),
            'nomor_rak_buku' => $this->post('nomor_rak_buku')
        ];

        if ($this->Buku_model->insertBuku($data)) {
            $this->response([
                'status' => TRUE,
                'message' => 'Buku berhasil ditambahkan'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Gagal menambahkan buku'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // PUT: api/buku
    public function index_put($id) {
        $data = [
            'judul_buku' => $this->put('judul_buku'),
            'penerbit' => $this->put('penerbit'),
            'tahun_terbit' => $this->put('tahun_terbit'),
            'isbn' => $this->put('isbn'),
            'nomor_rak_buku' => $this->put('nomor_rak_buku')
        ];

        if ($this->Buku_model->updateBuku($id,$data)) {
            $this->response([
                'status' => TRUE,
                'message' => 'Buku berhasil diupdate'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Gagal mengupdate buku'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // DELETE: api/buku/id
    public function index_delete($id) {
        if ($this->Buku_model->deleteBuku($id)) {
            $this->response([
                'status' => TRUE,
                'message' => 'Buku berhasil dihapus'
            ], 200);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Gagal menghapus buku'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}
