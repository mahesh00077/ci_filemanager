<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mass extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('model_tool_image');
	}
	public function index() {
		$data = array();
		$data['image'] = 'image/placeholder.png';
		$data['placeholder'] = 'image/placeholder.png';

		$thumb = 'placeholder.png';
		$data['thumb'] = $this->model_tool_image->resize($thumb, 100, 100);

		$this->load->view('welcome_message', $data);
	}public function yes() {
		$data = array();
		$data['image'] = 'image/placeholder.png';
		$data['placeholder'] = 'image/placeholder.png';

		$thumb = 'placeholder.png';
		$data['thumb'] = $this->model_tool_image->resize($thumb, 100, 100);

		$this->load->view('add', $data);
	}
}
