<?php
class News_model extends CI_Model {

  function getAllNews() {
    $q = $this->db->get('news');
    return $q->result_array();
  }

  function insertNews($data) {
    $this->db->insert('news',$data);
  }

  function deleteNews($id) {
    $this->db->where('id',$id);
    $this->db->delete('news');
  }

  function modifyNews($data, $id) {
    $this->db->where('id', $id);
    $this->db->update('news', $data);
  }

  function getAllNewsForObject($objid) {
    $this->db->where('object_id',$objid);
    $q = $this->db->get('news');
    return $q->result_array();
  }
  //TODO: pagination (show more functionality)
  // load next 10 news etc.
}