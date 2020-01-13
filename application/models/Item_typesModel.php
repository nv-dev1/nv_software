<?php
class Item_typesModel extends CI_Model{
    
    public function get_Item_types(){
        if(!empty($this->input->get("search"))){
          $this->db->like('item_type_name', $this->input->get("search"));
          $this->db->or_like('item_type_shortname', $this->input->get("search")); 
        }
        $query = $this->db->get("Item_types");
        return $query->result();
    }
    public function insert_Item_type()
    {    
        $data = array(
            'item_type_name' => $this->input->post('item_type_name'),
            'item_type_shortname' => $this->input->post('item_type_shortname')
        );
        return $this->db->insert('Item_types', $data);
    }
    public function update_Item_type($id) 
    {
        $data=array(
            'item_type_name' => $this->input->post('item_type_name'),
            'item_type_shortname'=> $this->input->post('item_type_shortname')
        );
        if($id==0){
            return $this->db->insert('Item_types',$data);
        }else{
            $this->db->where('id',$id);
            return $this->db->update('Item_types',$data);
        }        
    }
}
?>