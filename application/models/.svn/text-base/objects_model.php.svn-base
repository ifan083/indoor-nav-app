<?php
class Objects_model extends CI_Model {
  
  function getAllObjects() {
    $q = $this->db->get('objects');
    return $q->result_array();
  }
  
  function insertObject($name) {
    $data['name'] = $name;
    $this->db->insert('objects',$data);
  }
  
  function deleteObject($id) {
    $this->db->where('id', $id);
    $this->db->delete('objects');
  }
  
  function getFirstAvailableObject() {
    $this->db->limit(1);
    $this->db->order_by("id", "asc");
    $q = $this->db->get('objects');
    return $q->result_array();
  }
  
  function findObjectByName($name) {
    $this->db->where('name',$name);
    $q = $this->db->get('objects');
    return $q->result_array();
  }
}