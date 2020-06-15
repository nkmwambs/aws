<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
	 public $write_db = null;
	 public $read_db = null;
 
	 function __construct(){
		 parent::__construct();
 
		 $this->read_db = $this->load->database('read_db',true);
		 $this->write_db = $this->load->database('write_db',true);
	 }

	public function index()
	{
		$this->load->view('welcome_message');
	}

	function add_department(){
		//$post = $this->input->post();

		$data['name'] = $_POST['department_name'];
		$data['created_by'] = 1;
		$data['created_date'] = '2020-06-11';
		$data['last_modified_by'] = 1;

		$this->write_db->insert('department',$data);

		//$this->load->view('welcome_message');
		redirect(base_url().'index.php/welcome/index','refresh');
	}

	function delete_department($id){
		$this->write_db->where(array('department_id'=>$id));
		$this->write_db->delete('department');

		redirect(base_url().'index.php/welcome/index','refresh');
	}

	function update_department($id = 0){

		if(isset($_POST['department_name'])){
			$this->write_db->where(array('department_id'=>$id));
			$data['name'] = $_POST['department_name'];
			$this->write_db->update('department',$data);
			redirect(base_url().'index.php/welcome/index','refresh');
		}else{
			$department = $this->read_db->get_where('department',array('department_id'=>$id))->row();
			$data['department_name'] = $department->name;
			$data['department_id'] = $department->department_id;
			$this->load->view('update',$data);
		}
		

		
	}
}
