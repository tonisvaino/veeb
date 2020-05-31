<?php require_once APPROOT.'/views/inc/header.php';?>
  <div class="row mb-3">
    <div class="col">
      <h1>Tags</h1>
      <ul class="list-group">
        <?php foreach ($data['tags'] as $tag) :?>
          <a href="<?php echo URLROOT?>/tags/show/<?php echo $tag->id;?>" class="list-group-item"><?php echo $tag->name;?></a>
        <?php endforeach;?>
      </ul>
    </div>
  </div>
<?php require_once APPROOT.'/views/inc/footer.php';?>