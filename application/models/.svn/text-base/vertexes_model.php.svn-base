<?php
class Vertexes_model extends CI_Model {

  function getAllVertexesByFloor($floor) {
    $this->db->where('floor_id',$floor);
    $q = $this->db->get('vertexes');
    return $q->result_array();
  }

  function getAllVertexesShort() {
    $this->db->select('id, name');
    $q = $this->db->get('vertexes');
    return $q->result_array();
  }

  function addVertex($data) {
    $this->db->insert('vertexes', $data);
  }

  function modifyVertex($data, $id) {
    $this->db->where('id', $id);
    $this->db->update('vertexes', $data);
  }

  function vertexNotInFloorWithName($floor,$partial,$objid) {
    $query = "SELECT v.* FROM vertexes v, floors f WHERE f.object_id=".$objid." AND f.id = v.floor_id AND v.floor_id<>".$floor." AND v.name LIKE  '%".$partial."%'";
    $q = $this->db->query($query);
    return $q->result_array();
  }

  function deleteVertex($id) {
    $this->db->where('id', $id);
    $this->db->delete('vertexes');
  }

  function getAllVertexesShortForObject($objid) {
    $query = "SELECT v.id, v.name FROM vertexes v, floors f WHERE v.floor_id = f.id AND f.object_id =".$objid;
    $q = $this->db->query($query);
    return $q->result_array();
  }
  
  function getVertexesWithFloorInArray($ids){
    $this->db->where_in('floor_id',$ids);
    $q = $this->db->get('vertexes');
    return $q->result_array();
  }
}