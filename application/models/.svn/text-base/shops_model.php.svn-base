<?php
class Shops_model extends CI_Model {

  function getAllShops() {
    $q = $this->db->get('shops');
    return $q->result_array();
  }

  function insertShop($data){
    $this->db->insert('shops',$data);
  }

  function modifyShop($data, $id) {
    $this->db->where('id', $id);
    $this->db->update('shops', $data);
  }

  function deleteShop($id) {
    $this->db->where('id',$id);
    $this->db->delete('shops');
  }

  function getShopsWithNameLike($partial,$objid) {
    $this->db->where('object_id',$objid);
    $this->db->like('name', $partial);
    $q = $this->db->get('shops');
    return $q->result_array();
  }

  function getShopsWithNameLikeSimple($partial,$objid) {
    $this->db->where('object_id',$objid);
    $this->db->like('name',$partial);
    $this->db->select('id, name');
    $q = $this->db->get('shops');
    return $q->result_array();
  }

  function deleteCategoryIdForShopsWithCategoryId($id) {
    $data['category_id'] = 0;
    $this->db->where('category_id', $id);
    $this->db->update('shops',$data);
  }

  function getShopsForVertex($id) {
    $this->db->select('id, name');
    $this->db->where('vertex_id',$id);
    $q = $this->db->get('shops');
    return $q->result_array();
  }

  function removeShopFromVertex($id) {
    $data['vertex_id'] = 0;
    $this->db->where('id', $id);
    $this->db->update('shops',$data);
  }

  function updateVeretxId($id,$vertexId) {
    $data['vertex_id'] = $vertexId;
    $this->db->where('id',$id);
    $this->db->update('shops',$data);
  }

  function resetVertexIdForShopsWithVertexId($vertexId) {
    $data['vertex_id'] = 0;
    $this->db->where('vertex_id',$vertexId);
    $this->db->update('shops',$data);
  }

  function getAllShopsForObject($objid) {
    $this->db->where('object_id',$objid);
    $q = $this->db->get('shops');
    return $q->result_array();
  }

  function getShopsWithCategoryId($categoryId) {
    $this->db->where('category_id',$categoryId);
    $q = $this->db->get('shops');
    return $q->result_array();
  }

  function getShopsNameAndImgByVertexId($vertexId) {
    $this->db->select('id,name,picture_url');
    $this->db->where('vertex_id',$vertexId);
    $q = $this->db->get('shops');
    return $q->result_array();
  }
}