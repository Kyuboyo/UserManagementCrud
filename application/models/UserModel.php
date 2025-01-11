<?php
class UserModel  extends CI_Model{
    function make_query(){
        $this->db->select("*");
        $this->db->from("user");
        if(isset($_POST["search"]["value"])){
            $this->db->like("Name", $_POST["search"]["value"]);
            $this->db->or_like("Email", $_POST["search"]["value"]);
        }
        if(isset($_POST["order"])){
            $this->db->order_by("Id", $_POST['order'][0]['dir']);
        } else {
            $this->db->order_by("Id", "ASC");
        }
    }

    function make_datatables(){
        $this->make_query();
        if($_POST["length"] != -1){
            $this->db->limit($_POST["length"], $_POST["start"]);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data(){
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    function get_all_data(){
        $this->db->select("*");
        $this->db->from("user");
        return $this->db->count_all_results();
    }
    
    public function getUserCount(){
        return $this->db->count_all('user');
    }
    public function getUsers($limit = 5, $offset = 0){
        $query = $this->db->query('SELECT * FROM user LIMIT ? OFFSET ?', [$limit, $offset]);
        if($query->num_rows()>0){
            return $query->result_array();
        }
    }

    public function addUser( $data ){
        return $this->db->insert('user', $data);
    }

    public function getUser($user_id){
        $query = $this->db->get_where('user', array('Id'=>$user_id));
        if($query->num_rows() > 0){
            return $query->row_array();
        }
    }

    public function updateUser($user_id, $data){
        return $this->db->where('Id', $user_id)->update('user', $data);
    }

    public function deleteUser($user_id){
        return $this->db->delete('user', array('Id'=>$user_id));
    }
}
?>