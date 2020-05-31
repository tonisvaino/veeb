<?php require_once APPROOT.'/views/inc/header.php';?>
  <a href="<?php echo URLROOT?>/tags" class="btn btn-light pull-left"><i class="fa fa-caret-left"
                                                                         aria-hidden="true"></i></a>
  <div class="row mb-3">
    <div class="col">
      <h1><?php echo $data['posts'][0]->tagName;?></h1>
    </div>
  </div>
  <div class="row mb-3">
  <div class="col">
    <?php foreach ($data['posts'] as $post):?>
      <div class="car card-body mb-3">
        <h4 class="card-title"><?php echo $post->postTitle;?></h4>
        <div class="bg-light p-2 mb-3">Written by <?php echo $post->userName;?> on <?php echo $post->postCreated;?></div>
        <div class="card-text mb-3"><?php echo substr($post->postContent, 0, 300);?>...</div>
        <a href="<?php echo URLROOT?>/posts/show/<?php echo $post->postId;?>" class="btn btn-info">Read More</a>
      </div>
    <?php endforeach;?>
  </div>
<?php require_once APPROOT.'/views/inc/footer.php';?>