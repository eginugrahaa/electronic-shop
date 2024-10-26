<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function index()
    {
        $data['content'] = 'produk/index';
        $data['products'] = $this->Product_model->get_all_products();
        $this->load->view('templates/template', $data);
    }

    public function create()
    {
        $data['content'] = 'produk/create';
        $this->load->view('templates/template', $data);
    }

    public function edit($id)
    {
        $data['content'] = 'produk/edit';
        $data['product'] = $this->Product_model->get_product_by_id($id);
        $this->load->view('templates/template', $data);
    }

    public function store()
    {
        // Validasi input
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->create(); // Jika validasi gagal, tampilkan kembali form
        } else {
            // Jika validasi sukses
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('thumbnail')) {
                $upload_data = $this->upload->data();
                $data['thumbnail'] = $upload_data['file_name'];
            } else {
                $data['thumbnail'] = ''; // Set ke empty jika upload gagal
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
            }

            $data['kategori'] = $this->input->post('kategori');
            $data['produk'] = $this->input->post('produk');
            $data['harga'] = $this->input->post('harga');

            $this->Product_model->insert_product($data);
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
            redirect('product');
        }
    }


    public function update($id)
    {
        // Validasi input
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['product'] = $this->Product_model->get_product_by_id($id);
            $this->load->view('produk/edit', $data); // Tampilkan kembali form edit jika validasi gagal
        } else {
            // Jika validasi sukses
            $data = [];
            
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('thumbnail')) {
                $upload_data = $this->upload->data();
                $data['thumbnail'] = $upload_data['file_name'];
            }

            $data['kategori'] = $this->input->post('kategori');
            $data['produk'] = $this->input->post('produk');
            $data['harga'] = $this->input->post('harga');

            $this->Product_model->update_product($id, $data);
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui!');
            redirect('product');
        }
    }

    public function delete($id)
    {
        $this->Product_model->delete_product($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus!');
        redirect('product');
    }
    
}
