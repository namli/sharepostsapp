<?php require APPROOT.'/views/inc/header.php'; ?>
<div class="row">
  <div class="col-md-6">
    <h1>
      Posts
    </h1>
  </div>
  <div class="col-md-6">
    <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
    <i class="fa fa-pencil" ></i> Add post
    </a>
  </div>
</div>
<?php getFlash('posts_added'); ?>
<?php getFlash('post_message'); ?>
<?php foreach ($data['posts'] as $post) { ?>
    <div class="card card-body mb-3">
    <h4 class="card-title"> <?php echo $post->title; ?></h4>
    <div class="bg-light mb-3 p-2">
    Writen by <?php echo $post->name; ?> at <?php echo  $post->postCreated; ?>
  </div>
  <p class="card-text"><?php echo  $post->body; ?></p>
  <a href="<?php echo  URLROOT; ?>/posts/show/<?php echo  $post->postId; ?>" class="btn btn-dark">More</a>
    </div>
  <?php } ?>
<?php require APPROOT.'/views/inc/footer.php'; ?>