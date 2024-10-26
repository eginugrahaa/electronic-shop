<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function get_all_products()
    {
        return $this->db->get('produk')->result();
    }

    public function insert_product($data)
    {
        return $this->db->insert('produk', $data);
    }

    public function get_product_by_id($id)
    {
        return $this->db->get_where('produk', ['id' => $id])->row();
    }

    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('produk', $data);
    }

    public function delete_product($id)
    {
        return $this->db->delete('produk', ['id' => $id]);
    }
}
