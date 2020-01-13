<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Item_types extends CI_Controller {
   /**
    * Get All Data from this method.
    *
    * @return Response
   */
   public function __construct() {
    //load database in autoload libraries 
      parent::__construct(); 
      $this->load->model('Item_typesModel');         
   }
   public function index()
   {
       $Item_types=new Item_typesModel;
       $data['data']=$Item_types->get_Item_types();
       $this->load->view('includes/header');       
       $this->load->view('Item_types/list',$data);
       $this->load->view('includes/footer');
   }
   public function create()
   {
      $this->load->view('includes/header');
      $this->load->view('Item_types/create');
      $this->load->view('includes/footer');      
   }
   /**
    * Store Data from this method.
    *
    * @return Response
   */
   public function store()
   {
       $Item_types=new Item_typesModel;
       $Item_types->insert_Item_type();
       redirect(base_url('Item_types'));
    }
   /**
    * Edit Data from this method.
    *
    * @return Response
   */
   public function edit($id)
   {
       $Item_type = $this->db->get_where('Item_types', array('id' => $id))->row();
       $this->load->view('includes/header');
       $this->load->view('Item_types/edit',array('Item_type'=>$Item_type));
       $this->load->view('includes/footer');   
   }
   /**
    * Update Data from this method.
    *
    * @return Response
   */
   public function update($id)
   {
       $Item_types=new Item_typesModel;
       $Item_types->update_Item_type($id);
       redirect(base_url('Item_types'));
   }
   /**
    * Delete Data from this method.
    *
    * @return Response
   */
   public function delete($id)
   {
       $this->db->where('id', $id);
       $this->db->delete('Item_types');
       redirect(base_url('Item_types'));
   }
}