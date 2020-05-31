<?php require_once APPROOT.'/views/inc/header.php';?>
<a href="<?php echo URLROOT?>/posts" class="btn btn-light">Back</a>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
  Written by <?php echo $data['user']->name;?> on <?php echo $data['post']->created_at;?>
</div>
<?php if($data['post']->user_id == $_SESSION['user_id']) :?>
  <div class="row justify-content-around">
    <div class="col-8">
      <a href="<?php echo URLROOT?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-success">Edit</a>
    </div>
    <div class="col-4">
      <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
        <input type="submit" value="Delete" class="btn btn-danger">
      </form>
    </div>
  </div>
<?php endif;?>
<p><?php echo $data['post']->content;?></p>
<?php require_once APPROOT.'/views/inc/footer.php';?>

