<?php
class Main extends CI_Controller {

  public function __construct(){
    parent::__construct();
    //loading models
    $this->load->model('shops_model');
    $this->load->model('categories_model');
    $this->load->model('floors_model');
    $this->load->model('vertexes_model');
    $this->load->model('edges_model');
    $this->load->model('news_model');
    $this->load->model('objects_model');
    //load libraries
    $this->load->library('form_validation');
    $this->load->library('session');
  }

  function index() {
    //admin login
    $this->load->view('login_view');
  }

  function login() {
    $username = $this->input->post('login_username');
    $password = $this->input->post('login_password');
    if($username == "ifan.ilievski@gmail.com" && $password == "predator") {
      $objdata = array('current_obj'  => $this->objects_model->getFirstAvailableObject());
      $this->session->set_userdata($objdata);
      $this->news();
    } else {
      $data['error'] = array("Invalid username or password");
      $this->load->view('login_view',$data);
    }
  }

  function newobj() {
    $name = $this->input->post('obj_name');
    $this->objects_model->insertObject($name);

    $objdata = array('current_obj' => $this->objects_model->findObjectByName($name));
    $this->session->set_userdata($objdata);
    $this->news();
  }

  function deleteObject($objid,$navlink) {
    $this->objects_model->deleteObject($objid);
    $curr_data = $this->session->userdata('current_obj');
    if($curr_data[0]['id'] == $objid) {
      //the current object is being deleted => find new object
      $objdata = array('current_obj'  => $this->objects_model->getFirstAvailableObject());
      //update the session
      $this->session->set_userdata($objdata);
    }

    $this->refresh($navlink);
  }

  function updatesession($id, $name) {
    $esc_name = str_replace("%20", " ", $name);
    $data[0]['name'] = $esc_name;
    $data[0]['id'] = $id;
    $objdata = array('current_obj'  => $data);
    $this->session->set_userdata($objdata);
    echo "OK";
  }

  function refresh($navlink) {
    switch ($navlink) {
      case "nav0":
        $this->news();
        break;
      case "nav1":
        $this->shops();
        break;
      case "nav2":
        $this->categories();
        break;
      case "nav3":
        $this->checkpoints();
        break;
    }
  }

  function news() {
    $data['navlink'] = "nav0";
    //    $data['news'] = $this->news_model->getAllNews(); //$obj['id'] as an argument
    $obj = $this->session->userdata('current_obj');
    $data['news'] = $this->news_model->getAllNewsForObject($obj[0]['id']);
    $data['objects'] = $this->objects_model->getAllObjects();
    $this->load->view('news_view',$data);
  }

  function editnews() {
    $my_action = $this->input->post('submit');
    $id = $this->input->post('det_id');

    if($my_action == "Delete news") {
      $this->news_model->deleteNews($id);
    } else {
      $data['title'] = $this->input->post('details_edit_title');
      $data['date'] = $this->input->post('details_edit_date');
      $data['type'] = $this->input->post('details_edit_type');
      $data['image_url'] = $this->input->post('details_edit_image');
      $data['description'] = $this->input->post('details_edit_description');

      $obj = $this->session->userdata('current_obj');
      $data['object_id'] = $obj[0]['id'];

      if($my_action == "Save") {
        $this->news_model->insertNews($data);
      } else if($my_action == "Save Changes") {
        $this->news_model->modifyNews($data,$id);
      }
    }

    $this->news();
  }

  function shops() {
    $data['navlink'] = "nav1";
    //    $data['data'] = $this->shops_model->getAllShops();
    $obj = $this->session->userdata('current_obj');
    $data['data'] = $this->shops_model->getAllShopsForObject($obj[0]['id']);
    //    $data['categories'] = $this->categories_model->getAllCategories();
    $data['categories'] = $this->categories_model->getAllCategoriesForObject($obj[0]['id']);
//    $data['vertexes'] = $this->vertexes_model->getAllVertexesShort();
    $data['vertexes'] = $this->vertexes_model->getAllVertexesShortForObject($obj[0]['id']);
    $data['objects'] = $this->objects_model->getAllObjects();
    $this->load->view('shops_view',$data);
  }

  function editShops() {
    //detect caller
    $my_action = $this->input->post('submit');

    $id = $this->input->post('details_id');

    if($my_action == "Delete Shop") {
      $this->shops_model->deleteShop($id);
    } else {
      //get post data
      $data = array();
      $data['name'] = $this->input->post('details_edit_name');
      $data['description'] = $this->input->post('details_edit_description');
      $data['picture_url'] = $this->input->post('details_edit_picture_url');
      $data['working_hours'] = $this->input->post('details_edit_working_hours');
      $data['category_id'] = str_replace("cat", "", $this->input->post('details_edit_cat_id'));
      $data['vertex_id'] = str_replace("vert", "", $this->input->post('details_edit_vertex_id'));
      $data['floor'] = $this->input->post('details_edit_floor');
      $data['logo_url'] = $this->input->post('details_edit_logo_url');

      $obj = $this->session->userdata('current_obj');
      $data['object_id'] = $obj[0]['id'];

      //update db
      if($my_action == "Save Shop") {
        $this->shops_model->insertShop($data);
      } else if($my_action == "Save Changes") {
        $this->shops_model->modifyShop($data, $id);
      }

    }
    //refresh data
    $this->shops();
  }

  function categories() {
    $data['navlink'] = "nav2";
    $data['objects'] = $this->objects_model->getAllObjects();
    //    $data['data'] = $this->categories_model->getAllCategories();
    $obj = $this->session->userdata('current_obj');
    $data['data'] = $this->categories_model->getAllCategoriesForObject($obj[0]['id']);
    $this->load->view('categories_view',$data);
  }

  function editCategories() {
    $my_action = $this->input->post('submit');

    $id = $this->input->post('cat_id');

    if($my_action == "Delete Category") {
      $this->categories_model->deleteCategory($id);

      //also remove this index from all the shops that have it as a foreign key
      $this->shops_model->deleteCategoryIdForShopsWithCategoryId($id);

    } else {
      $name = $this->input->post('cat_name');

      if($my_action == "Save Category") {
        $obj = $this->session->userdata('current_obj');
        $this->categories_model->insertCategory($name,$obj[0]['id']);
      } else if($my_action == "Save Changes") {
        $this->categories_model->modifyCategory($id,$name);
      }

    }

    $this->categories();
  }

  function removeshopfromcategory($id) {
    $data['category_id'] = 0;
    $this->shops_model->modifyShop($data, $id);
    echo "OK";
  }

  function checkpoints() {
    $obj = $this->session->userdata('current_obj');
    $data['navlink'] = "nav3";
    $data['objects'] = $this->objects_model->getAllObjects();
    //    $data['floors'] = $this->floors_model->getAllFloors();
    $data['floors'] = $this->floors_model->getAllFloorsForObject($obj[0]['id']);
    $this->load->view('checkpoints_view',$data);
  }

  function uploadblueprint() {
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'jpg|png';
    $config['max_size']	= ' 2048';
    $config['max_width']  = '1024';
    $config['max_height']  = '768';

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload())
    {
      $data['navlink'] = "nav3";
      $data['error'] = array('error' => $this->upload->display_errors());
      $this->load->view('checkpoints_view',$data);
    }
    else
    {
      //insert into db
      $upload_data = $this->upload->data();
      $new_data['flooor_num'] = $this->input->post('floor_number_edit');
      $new_data['name'] = $this->input->post('floor_name_edit');
      $new_data['blueprint_map_url'] = $upload_data['file_name'];
      $obj = $this->session->userdata('current_obj');
      $new_data['object_id'] = $obj[0]['id'];
      $this->floors_model->insertFloor($new_data);

      //refresh page
      $this->checkpoints();
    }
  }

  function vertexes($floor) {
    echo json_encode($this->vertexes_model->getAllVertexesByFloor($floor));
  }

  function addVertex() {
    $data['x'] = $this->input->post('x');
    $data['y'] = $this->input->post('y');
    $data['name'] = $this->input->post('name');
    $data['floor_id'] = $this->input->post('floor');
    $data['checkpoint_url'] = $this->input->post('img_url');

    if(!empty($id)) {
      $this->vertexes_model->modifyVertex($data, $id);
    } else {
      $this->vertexes_model->addVertex($data);
    }
  }

  function shopsForVertex($id) {
    echo json_encode($this->shops_model->getShopsForVertex($id));
  }

  function removeshopfromvertex($id) {
    $this->shops_model->removeShopFromVertex($id);
    echo "OK";
  }

  function getSimpleShopsLikeName($partial) {
    $obj = $this->session->userdata('current_obj');
    echo json_encode($this->shops_model->getShopsWithNameLikeSimple($partial,$obj[0]['id']));
  }

  function changeVertexIdForShop($id,$vertexId) {
    $this->shops_model->updateVeretxId($id,$vertexId);
    echo "OK";
  }

  function vertexNotInFloorWithName($floor,$partial) {
    //FIXME: add object_id
    $obj = $this->session->userdata('current_obj');
    echo json_encode($this->vertexes_model->vertexNotInFloorWithName($floor,$partial,$obj[0]['id']));
  }

  function addNewEdge($vert1id, $vert2id, $weight) {
    $obj = $this->session->userdata('current_obj');
    
    $data1['vertex1_id'] = $vert1id;
    $data1['vertex2_id'] = $vert2id;
    $data1['weight'] = $weight;
    $data1['object_id'] = $obj[0]['id'];
    $this->edges_model->addEdge($data1);
     
    $data2['vertex1_id'] = $vert2id;
    $data2['vertex2_id'] = $vert1id;
    $data2['weight'] = $weight;
    $data2['object_id'] = $obj[0]['id'];
    $this->edges_model->addEdge($data2);
    echo "OK";
  }

  function getAllEdgesForFloor($floor) {
    echo json_encode($this->edges_model->getEdgesForFloor($floor));
  }

  function removeEdge($vert1Id, $vert2Id) {
    $this->edges_model->removeEdge($vert1Id,$vert2Id);
    $this->edges_model->removeEdge($vert2Id,$vert1Id);
    echo "OK";
  }

  function removeFullVertex($vertexId) {
    //delete all the vertex info
    $this->vertexes_model->deleteVertex($vertexId);
    //delete all the shops with vertex_id == vertex.id
    $this->shops_model->resetVertexIdForShopsWithVertexId($vertexId);
    //delete all edges where vertex.id is e.vertex1_id || e.vertex2_id
    $this->edges_model->deleteEdgesWhereVertexHasId($vertexId);
    echo "OK";
  }


}