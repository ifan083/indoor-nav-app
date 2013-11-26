<?php
class Service extends CI_Controller {
  public function __construct(){
    parent::__construct();
    //loading models
    $this->load->model('shops_model');
    $this->load->model('categories_model');
    $this->load->model('floors_model');
    $this->load->model('vertexes_model');
    $this->load->model('edges_model');
    //load library
    $this->load->library('form_validation');
    $this->load->library('session');
  }

  public function shops($partial = null) {
    $obj = $this->session->userdata('current_obj');
    if(empty($partial)) {
      //      echo json_encode($this->shops_model->getAllShops());
      echo json_encode($this->shops_model->getAllShopsForObject($obj[0]['id']));
    } else {
      //      echo json_encode($this->shops_model->getShopsWithNameLike($partial));
      echo json_encode($this->shops_model->getShopsWithNameLike($partial,$obj[0]['id']));
    }
  }

  public function shopsByCategory($categoryId) {
    echo json_encode($this->categories_model->getShopsByCategoryId($categoryId));
  }

  //rest api
  public function findshops($objectid = null) {
    if(empty($objectid)) {
      echo json_encode($this->shops_model->getAllShops());
    } else {
      echo json_encode($this->shops_model->getAllShopsForObject($objectid));
    }
  }

  //  rest api
  public function browsecategories($objectid = null) {
    if(empty($objectid)) {
      $categories = $this->categories_model->getAllCategories();
    } else {
      $categories = $this->categories_model->getAllCategoriesForObject($objectid);
    }
    for($i = 0;$i<count($categories);$i++) {
      $data[$i]['category'] = $categories[$i]['name'];
      $data[$i]['shops'] = $this->shops_model->getShopsWithCategoryId($categories[$i]['id']);
    }
    echo json_encode($data);
  }

  // rest api
  public function loadblueprint($floorid) {
    $data = $this->floors_model->getFloorById($floorid);
    $this->load->view('blueprint_view',$data[0]);
  }

  public function getVertexesForFloorId($floorid) {
    echo json_encode($this->vertexes_model->getAllVertexesByFloor($floorid));
  }

  // rest api
  public function navigation($objid) {
    //get all floors by id
    $data = $this->floors_model->getAllFloorsSimpleForObject($objid);
    for($i = 0;$i<count($data);$i++) {
      //get all vertexes per floor id
      $data[$i]['vertexes'] = $this->vertexes_model->getAllVertexesByFloor($data[$i]['id']);
      for($j = 0; $j < count($data[$i]['vertexes']); $j++) {
        //get all shops per vertex id
        $data[$i]['vertexes'][$j]['shops'] = $this->shops_model->getShopsNameAndImgByVertexId($data[$i]['vertexes'][$j]['id']);
      }
    }
    echo json_encode($data);
  }

  // rest api
  public function dijkstra($objid) {
    //get all vertexes for object id
    $distinctFloorIds = $this->floors_model->getDiffIdsForObject($objid);
    for($i = 0;$i<count($distinctFloorIds);$i++) {
      $ids[$i] = $distinctFloorIds[$i]['id'];
    }
    $data['vertexes'] = $this->vertexes_model->getVertexesWithFloorInArray($ids);
    //get all edges for object id
    $data['edges'] = $this->edges_model->getEdgesForObject($objid);
    echo json_encode($data);
  }
}