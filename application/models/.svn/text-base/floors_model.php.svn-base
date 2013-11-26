<?php
class Floors_model extends CI_Model {

  function getAllFloors() {
    $q = $this->db->get('floors');
    return $q->result_array();
  }

  function insertFloor($data) {
    $this->db->insert('floors', $data);
  }

  function getAllFloorsForObject($objid) {
    $this->db->where('object_id', $objid);
    $q = $this->db->get('floors');
    return $q->result_array();
  }

  function getFloorById($floorid) {
    $this->db->where('id',$floorid);
    $q = $this->db->get('floors');
    return $q->result_array();
  }

  function getAllFloorsSimpleForObject($objid) {
    $this->db->select('id,name');
    $this->db->where('object_id', $objid);
    $q = $this->db->get('floors');
    return $q->result_array();
  }
  
  function getDiffIdsForObject($objid) {
    $this->db->select('id');
    $this->db->group_by('id');
    $this->db->where('object_id',$objid);
    $q = $this->db->get('floors');
    return $q->result_array();
  }
}