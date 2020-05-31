<?php


class Posts extends Controller
{
  public function __construct(){
    $this->postModel = $this->model('Post');
    $this->userModel = $this->model('User');
  }
  public function index(){
    if($this->postModel->getAllPosts() !== false){
      $data = $this->postModel->getAllPosts();
      $this->view('posts/index', $data);
    }
    $this->view('posts/index');
  }
  public function show($id){
    $post = $this->postModel->getPostById($id);
    $user = $this->userModel->getUserById($post->user_id);
    $data = array(
      'post' => $post,
      'user' => $user
    );
    $this->view('posts/show', $data);
  }
  public function add(){
    // check post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // process form
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // init data
      $data = array(
        'title' => trim($_POST['title']),
        'content' => trim($_POST['content']),
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'content_err' => ''
      );
      // validate title
      if(empty($data['title'])){
        $data['title_err'] = 'Please enter the title';
      }
      // validate content
      if(empty($data['content'])){
        $data['content_err'] = 'Please enter the content';
      }
      // if errors are empty - submit post
      if(empty($data['title_err']) and empty($data['content_err']) ) {
        $postSubmited = $this->postModel->addPost($data);
        if($postSubmited){
          flashSet('post_message', 'Post is Added');
          redirect('posts');
        } else {
          die('Something went wrong');
        }
      } else {
        // load view with errors
        $this->view('posts/add', $data);
      }
      } else {
      $this->view('posts/add');
    }
  }
//edit post
  public function edit($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //Data check
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = array(
        'id' => $id,
        'title' => trim($_POST['title']),
        'content' => trim($_POST['content']),
        'user_id' => $_SESSION['user_id'],
        'title_err' => '',
        'content_err' => ''
      );
      // controls for form inputs
      if (empty($data['title'])) {
        $data['title_err'] = 'Please enter title';
      }
      if (empty($data['content'])) {
        $data['content_err'] = 'Please enter content text';
      }
      // No error
      if (empty($data['title_err']) and empty($data['content_err'])) {
        if ($this->postModel->editPost($data)) {
          flashSet('post_message', 'Post Updated');
          redirect('posts');
        } else {
          die('Something went wrong');
        }
      } else {
        // error
        $this->view("posts/edit", $data);
      }
    } else {
      $post = $this->postModel->getPostById($id);
      if ($post->user_id != $_SESSION['user_id']) {
        redirect('posts');
      }
      $data = array(
        'id' => $id,
        'title' => $post->title,
        'content' => $post->content
      );
      $this->view("posts/edit", $data);
    }
  }
    // delete function
    public function delete($id) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $post = $this->postModel->getPostById($id);
        if ($post->user_id != $_SESSION['user_id']) {
          redirect('posts');
        }

        if ($this->postModel->deletePost($id)) {
          flashSet('post_message', 'Post Deleted');
          redirect('posts');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('posts');
      }
    }
}