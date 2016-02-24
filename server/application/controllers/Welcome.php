<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('User_model', 'User');

		$params = array(
			'active'		=> $this->User->get_active(),
			'active_ignore'	=> $this->User->get_active(TRUE),
			'active_today'	=> $this->User->get_active_today(),
			);

		$this->load->view('welcome_message', $params);
	}

	public function setmac()
	{
		$this->load->model('User_model', 'User');
		$this->load->model('Visitors_model', 'Visitors');

		if ($this->input->post()) {

			$macs = $this->input->post('mac_list');
			$create_date = date('Y-m-d H:i:s');

			// Loop lista de MACs
			foreach ($macs as $value) {

				// Criar novo usuário como GUEST
				if ($this->User->exists($value) == 0) {

					$data = array(
						'last_in' => $create_date,
						'mac' => $value,
						'status' => 1,
						);
					$this->User->update($data);
				}

				// Registrar log de MACs que não estavam online ou são novos 'GUESTs'
				if ($this->Visitors->get_status($value) != '1') {

					$data = array(
						'mac' => $value,
						'status' => 1,
						'create_date' => $create_date,
						);
					$this->Visitors->insert($data);
				}
			}

			// MACs online no banco
			$last_macs = $this->User->get_active();

			// Registrar log de MACs que estavam online e não vieram no último POST
			foreach ($last_macs as $value) {

				if (!in_array($value->mac, $macs)) {
					$data = array(
						'mac' => $value->mac,
						'status' => 0,
						'create_date' => $create_date,
						);
					$this->Visitors->insert($data);
				}
			}
		} else {
			echo "No direct script access allowed";
		}
	}
}
