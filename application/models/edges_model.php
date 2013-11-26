<?php
class Edges_model extends CI_Model {

  function addEdge($data) {
    $this->db->insert('edges',$data);
  }

  function getEdgesForFloor($floor) {
    $query = "SELECT e.id,
	   e.vertex1_id,
	   (SELECT ver1.name FROM vertexes ver1 WHERE ver1.id = e.vertex1_id) as vertex1_name,
	   e.vertex2_id,
	   (SELECT ver2.name FROM vertexes ver2 WHERE ver2.id = e.vertex2_id) as vertex2_name,
       e.weight     
  FROM edges e, vertexes v
 WHERE e.vertex1_id = v.id
   AND v.floor_id = ".$floor;
    $q = $this->db->query($query);
    return $q->result_array();
  }
  
  function removeEdge($vert1Id, $vert2Id) {
    $this->db->where('vertex1_id',$vert1Id);
    $this->db->where('vertex2_id',$vert2Id);
    $this->db->delete('edges');
  }
  
  function deleteEdgesWhereVertexHasId($vertexId) {
    $this->db->where('vertex1_id', $vertexId);
    $this->db->or_where('vertex2_id', $vertexId);
    $this->db->delete('edges');
  }
  
  function getEdgesForObject($objid) {
    $this->db->where('object_id',$objid);
    $q = $this->db->get('edges');
    return $q->result_array();
  }
}