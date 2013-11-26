<?php
class Categories_model extends CI_Model {

  function getAllCategories() {
    $q = $this->db->get('categories');
    return $q->result_array();
  }

  function getShopsByCategoryId($categoryId) {
    $this->db->select('id,name');
    $this->db->where('category_id', $categoryId);
    $q = $this->db->get('shops');
    return $q->result_array();
  }
  
  function deleteCategory($id) {
    $this->db->where('id', $id);
    $this->db->delete('categories');
  }
  
  function insertCategory($name,$objid) {
    $data['name'] = $name;
    $data['object_id'] = $objid;
    $this->db->insert('categories',$data);
  }
  
  function modifyCategory($id,$name) {
    $data['name'] = $name;
    $this->db->where('id', $id);
    $this->db->update('categories', $data);
  }
  
  function getAllCategoriesForObject($objid){
    $this->db->where('object_id',$objid);
    $q = $this->db->get('categories');
    return $q->result_array();
  }
}