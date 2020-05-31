<?php
class Tags extends Controller
{
  public function __construct(){
    $this->tagModel = $this->model('Tag');
  }

  public function index() {
    if($this->tagModel->getallTags() !== false) {
      $tags = $tags = $this->tagModel->getallTags();
      $data = array(
        'tags' => $tags
      );
      $this->view('tags/index', $data);
    } else {
      redirect();
    }
  }
  public function show($id)
  {
    if ($this->tagModel->getTagPosts($id) !== false ){
      $posts = $this->tagModel->getTagPosts($id);
      $data = array(
        'posts' => $posts,
      );
      $this->view('tags/show', $data);
    } else {
      redirect('tags');
    }
  }
}