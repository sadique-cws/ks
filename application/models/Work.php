<?php 


class Work extends CI_model{
    
  public function insertData($table,$query){
      $data = $this->db->insert($table,$query);
      return $data;
  }  
  public function callingData($table,$where=null){
      if($where==null){
          $query = $this->db->get($table);
      }
      else{
          $query = $this->db->get_where($table,$where);
      }
      
      if(count($query->result())==1){
          return $query->row();
      }
      else{
        return $query->result();
      }
  }   
  public function callingQuery($query){
      $query = $this->db->query($query);
      return $query->result();
  }  
  public function countData($table,$where=null) {
        if($where==null){
            
        $query = $this->db->select("*")->get($table);
        }
        else{
            
        $query = $this->db->select("*")->where($where)->get($table);
        }
        return $query->num_rows();
      }
  public function check_data($table,$data) { 
        $query = $this->db->where($data)->get($table);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
      } 
  public function update($table,$data,$where) { 
         if ($this->db->update($table, $data,$where)) { 
            return true; 
         } 
      }   
  public function insert_get_lastid($table,$data) { 
         if ($this->db->insert($table, $data)) { 
            $id = $this->db->insert_id();
             return $id;
         } 
      } 
  public function deleteData($table,$cond){
        $query = $this->db->delete($table,$cond);
        
        return $query;
    }  

}
?>
