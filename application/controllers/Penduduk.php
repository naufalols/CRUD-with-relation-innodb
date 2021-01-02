<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penduduk extends CI_Controller 
{

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Penduduk_model');

	
	}
	
	public function index()
	{
		$data['provinsi'] = $this->Penduduk_model->getAll('provinsi');
		$data['kabupaten'] = $this->Penduduk_model->getAlljoin('kabupaten', 'provinsi');
		$this->load->view('index', $data);
		// session_destroy();
	}

	public function laporan()
	{
		# code...
	}

	public function input_prov()
	{
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim', array('required' => 'Mohon diisi') );

		if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('pesanP', '<div class="alert alert-danger" role="alert">Provinsi gagal ditambahkan!</div>');
				redirect('Penduduk/index');
			}
		else
			{
				$provinsi = $this->input->post('provinsi');
				$data = array(
						'nama_provinsi' => $provinsi
				);
				$this->Penduduk_model->insert_data('provinsi', $data);
				$this->session->set_flashdata('pesanP', '<div class="alert alert-primary" role="alert">Provinsi berhasil ditambahkan!</div>');	
				redirect('Penduduk/index');
			}
	}

	public function input_kab()
	{
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim|callback_select_validate', array('required' => 'Mohon diisi') );
		$this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required|trim', array('required' => 'Mohon diisi') );
		$this->form_validation->set_rules('penduduk', 'Penduduk', 'required|trim|numeric', array('required' => 'Mohon diisi') );

		if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('pesanK', '<div class="alert alert-danger" role="alert">Kabupaten gagal ditambahkan!</div>');
				redirect('Penduduk/index');
			}
		else
			{
				$provinsi = $this->input->post('provinsi');
				$kabupaten = $this->input->post('kabupaten');
				$penduduk = $this->input->post('penduduk');
				$data = array(
						'id_provinsi' => $provinsi,
						'nama_kabupaten' => $kabupaten,
						'jumlah_penduduk' => $penduduk
				);
				$this->Penduduk_model->insert_data('kabupaten', $data);
				$this->session->set_flashdata('pesanK', '<div class="alert alert-primary" role="alert">Kabupaten berhasil ditambahkan!</div>');	
				redirect('Penduduk/index');
			}
	}

	public function sunting_kab()
	{
		$this->form_validation->set_rules('Kprovinsi', 'KProvinsi', 'required|callback_select_validate' );
		$this->form_validation->set_rules('Kkabupaten', 'KKabupaten', 'required|trim');
		$this->form_validation->set_rules('Kpenduduk', 'KPenduduk', 'required|trim|numeric' );
		$this->form_validation->set_rules('Kid', 'KId', 'required|trim');

		if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('pesanSK', '<div class="alert alert-danger" role="alert">Kabupaten gagal disunting!</div>');
				redirect('Penduduk/index');
			}
		else
			{
				$provinsi = $this->input->post('Kprovinsi');
				$kabupaten = $this->input->post('Kkabupaten');
				$penduduk = $this->input->post('Kpenduduk');
				$idK = $this->input->post('Kid');
				$data = array(
						'id' => $idK,
						'id_provinsi' => $provinsi,
						'nama_kabupaten' => $kabupaten,
						'jumlah_penduduk' => $penduduk
				);
				// print_r($data);
				$this->Penduduk_model->sunting_data('kabupaten', $data);
				$this->session->set_flashdata('pesanSK', '<div class="alert alert-primary" role="alert">Kabupaten berhasil disunting!</div>');	
				redirect('Penduduk/index');
			}
	}

	public function sunting_prov()
	{
		// $data['kabupaten'] = $this->Penduduk_modal->getById('kabupaten', $id);
		$this->form_validation->set_rules('Pprovinsi', 'PProvinsi', 'required|trim' );
		$this->form_validation->set_rules('Pid', 'PId', 'required|trim');

		if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('pesanSP', '<div class="alert alert-danger" role="alert">Provinsi gagal disunting!</div>');
				redirect('Penduduk/index');
			}
		else
			{
				$provinsi = $this->input->post('Pprovinsi');
				$id = $this->input->post('Pid');
				$data = array(
						// 'id' => $id,
						'nama_provinsi' => $provinsi
				);
				// print_r($data);
				$this->Penduduk_model->sunting_datas($id, 'provinsi', $data);
				$this->session->set_flashdata('pesanSP', '<div class="alert alert-primary" role="alert">Provinsi berhasil disunting!</div>');	
				redirect('Penduduk/index');
			}
	}

	public function hapus_kab($id)
	{
		$hapus = $this->Penduduk_model->hapus_data($id, 'kabupaten');
		
		if ($hapus == 1) {
			$this->session->set_flashdata('pesanH', '<div class="alert alert-primary" role="alert">Data berhasil dihapus!</div>');	
			redirect('Penduduk/index');
		}
		else {
			$this->session->set_flashdata('pesanH', '<div class="alert alert-danger" role="alert">Data gagal dihapus!</div>');	
			redirect('Penduduk/index');
		}
	}

	public function hapus_prov($id)
	{
		$hapus = $this->Penduduk_model->hapus_data($id, 'provinsi');
		// echo $hapus;
		if ($hapus === 1451) {
			$this->session->set_flashdata('pesanHP', '<div class="alert alert-danger" role="alert">Data gagal dihapus karena masih bersangkutan dengan data lain</div>');	
			redirect('Penduduk/index');
		}
		elseif ($hapus === TRUE) {
			$this->session->set_flashdata('pesanHP', '<div class="alert alert-primary" role="alert">Data berhasil dihapus!</div>');	
			redirect('Penduduk/index');
		}
		else {
			$this->session->set_flashdata('pesanHP', '<div class="alert alert-danger" role="alert">Data gagal dihapus!</div>');	
			redirect('Penduduk/index');
		}
	}

	public function select_validate($data)
	{
			if ($data == 0)
			{
					$this->form_validation->set_message('Kprovinsi', '{field} belum dipilih');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
	}
}
