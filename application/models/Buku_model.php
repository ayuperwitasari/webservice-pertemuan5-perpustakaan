<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {

    // Mengambil buku dari database
    public function getBuku($id = NULL) {
        if ($id === NULL) {
            return $this->db->get('buku')->result_array();  // Mengambil semua buku
        } else {
            return $this->db->get_where('buku', ['id_buku' => $id])->row_array();  // Mengambil buku berdasarkan ID
        }
    }

    // Menambahkan buku ke database
    public function insertBuku($data) {
        return $this->db->insert('buku', $data);
    }

    // Mengupdate buku ke database
    public function updateBuku($id,$data) {
        $this->db->where('id_buku', $id);
        return $this->db->update('buku', $data);
    }

    // Menghapus buku berdasarkan ID
    public function deleteBuku($id) {
        return $this->db->delete('buku', ['id_buku' => $id]);
    }
}
