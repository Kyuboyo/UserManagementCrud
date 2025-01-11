<?php
defined('BASEPATH') OR exit('No direct script access allowed');
log_message('debug', 'Home controller and index method loaded');

class Home extends CI_Controller{

    public function index(){
        $this->load->model('UserModel');
        // $users = $this->UserModel->getUsers();
        // $this->load->view('home', ['users'=>$users]);
        $this->load->view('home');
    }

    public function getPaginatedUsers(){
        $this->load->model('UserModel');
        $limit = $_POST['limit'] ?? 5;
        $offset = $_POST['offset'] ?? 0;
        // $users = $this->UserModel->getUsers($limit, $offset);
        $users = $this->UserModel->make_datatables();

        $data = array();
        foreach($users as $user){
            $sub_array = array();
            $sub_array[] = $user->Id; //$user['Id'];
            $sub_array[] = $user->Name; //$user['Name'];
            $sub_array[] = $user->Email; //$user['Email'];
            $sub_array[] = $user->Phone; //$user['Phone'];
            $sub_array[] = '<?php echo anchor("home/update/'.$user->Id.'", "Update", ["class"=>"btn btn-primary me-2"]); ?>';
            $sub_array[] = '<?php echo anchor("home/delete/'.$user->Id.'", "Delete", ["class"=>"btn btn-danger"]); ?>';

            $data[] = $sub_array;
        }

        $output = array(
            "draw" => intval($_POST["draw"]) ?? 1,
            "recordsTotal" => $this->UserModel->get_all_data(),
            "recordsFiltered" => $this->UserModel->get_filtered_data(),
            "data" => $users
        );
        echo json_encode($output);
    }

    public function create(){
        $this->load->view('create');
    }

    public function save(){
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('Email', 'Email', 'required');
        $this->form_validation->set_rules('Phone', 'Phone', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run()) {
            $data = $this->input->post();
            $this->load->model('UserModel');
            if ($this->UserModel->addUser($data)) {
                $this->session->set_flashdata('response', 'User Saved');
            } else {
                $this->session->set_flashdata('response', 'User Save Failed');
            }
            return redirect('home');
        } else {
            $this->load->view('create');
        }
    }

    public function update( $user_id){
        $this->load->model('UserModel');
        $user = $this->UserModel->getUser($user_id);
        $this->load->view('update', ['user'=>$user]);
    }

    public function edit( $user_id){
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('Email', 'Email', 'required');
        $this->form_validation->set_rules('Phone', 'Phone', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run()) {
            $data = $this->input->post();
            $this->load->model('UserModel');
            if ($this->UserModel->updateUser($user_id, $data)) {
                $this->session->set_flashdata('response', 'User Edited');
            } else {
                $this->session->set_flashdata('response', 'User Edit Failed');
            }
            return redirect('home');
        } else {
            $this->load->view('update');
        }
    }

    public function delete($user_id){
        $this->load->model('UserModel');
        if($this->UserModel->deleteUser($user_id)){
            $this->session->set_flashdata('response', 'User Deleted');
        } else {
            $this->session->set_flashdata('response', 'User Delete Failed');
        }        
        return redirect('home');
    }
}
?>