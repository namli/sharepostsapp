<?php require APPROOT.'/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['post']->title; ?></h1>
<div class="bg-secondary mb-3 p-2 text-white">
    Writen by <?php echo $data['user']->name; ?> at <?php echo  $data['post']->created_ad; ?>
  </div>
  <p>
  <?php echo  $data['post']->body; ?>
  </p>
  <?php if ($data['post']->user_id == $_SESSION['user_id']) {?>
    <div class="row">
      <div class="col">
        <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit post</a>
      </div>
      <div class="col">
        <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
        <input type="submit" value="Delete post" class="btn btn-danger">
      </form>
      </div>
    </div>
  <?php } ?>
<?php require APPROOT.'/views/inc/footer.php'; ?>