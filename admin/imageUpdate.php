<?php
require_once "../includes/helper/functions.php";
$pdo = require_once '../Database/databaseconfig.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    echo '<script>window.location.href="imageIndex.php"</script>';
    exit;
}
$statement = $pdo->prepare('SELECT * FROM images WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$image = $statement->fetch(PDO::FETCH_ASSOC);
$errors = [];

$title = $image['title'];
$siteurl = $image['siteurl'];
$imageurl = $image['imageurl'];
$alt = $image['alt'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $siteurl = $_POST['siteurl'];
    $imageurl = $_POST['imageurl'];
    $alt = $_POST['alt'];
    
    if (!$title) {
        $errors[] = 'title is required';
    }
    
    if (!$siteurl) {
        $errors[] = 'Site Url is required';
    }
    if (!$imageurl) {
        $errors[] = 'Image Url is required';
    }
    if (!$alt) {
        $errors[] = 'Alt is required';
    }
    

    if (empty($errors)) {
        $statement = $pdo->prepare("UPDATE images SET siteurl = :siteurl, imageurl = :imageurl, alt = :alt,
        title = :title WHERE id = :id");
        $statement->bindValue(':siteurl', $siteurl);
        $statement->bindValue(':imageurl', $imageurl);
        $statement->bindValue(':alt', $alt);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':id', $id);

$statement->execute();
    echo '<script>window.location.href="imageIndex.php"</script>';
    }

}

?>
<section class="body">
	<?php include_once 'includes/header.php'; ?>
<section role="main" class="content-body">
	<header class="page-header">
						<h2>Update Image</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="/admin">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Update Image</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
                    <div class="row">
							<div class="col-lg-12">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
										<h2 class="panel-title">Update Image</h2>
									</header>
                                    <form class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">
                                                <div class="panel-body">
                                                <?php if (!empty($errors)): ?>
                                                                        <div class="alert alert-danger">
                                                                            <?php foreach ($errors as $error): ?>
                                                                                <div><?php echo $error ?></div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                        <?php endif; ?>
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="inputReadOnly">Title</label>
                                                                        <div class="col-md-6">
                                                                                <input type="text" name="title" class="form-control" id="inputReadOnly" value="<?php echo $image['title'] ?>">
                                                                        </div>
                                                                    </div>
                                                            <div class="form-group">
                                                                    <label class="col-md-3 control-label" for="inputReadOnly">Site Url</label>
                                                                    <div class="col-md-6">
                                                                    <input type="text"  name="siteurl" class="form-control" id="inputReadOnly" value="<?php echo $image['siteurl'] ?>" required>
                                                                    </div>
                                                              </div>
                                                            <div class="form-group">
                                                                    <label class="col-md-3 control-label" for="inputReadOnly">Image Url</label>
                                                                    <div class="col-md-6">
                                                                    <input type="text"  name="imageurl" class="form-control" id="inputReadOnly" value="<?php echo $image['imageurl'] ?>" required>
                                                                    </div>
                                                              </div>
                                                            <div class="form-group">
                                                                    <label class="col-md-3 control-label" for="inputReadOnly">Image Alt</label>
                                                                    <div class="col-md-6">
                                                                    <input type="text"  name="alt" class="form-control" id="inputReadOnly" value="<?php echo $image['alt'] ?>" required>
                                                                    </div>
                                                              </div>
                                                                        
                                                </div>
                                                                        <footer class="panel-footer">
                                                                            <button type="submit" class="btn btn-primary">Update Post</button>
                                                                         </footer>
                                    </form>

    
                                </section>
                            </div>
                    </div>
</section>
        </div>


</section>
     

<?php include 'includes/footer.php'; ?>
<h1>Update Image Url</h1>

<form method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $image['title'] ?>">
        
    </div>
    <div class="form-group">
        <label> Site Url</label>
        <input type="text"  name="siteurl" class="form-control" value="<?php echo $image['siteurl'] ?>" required>
    </div>
    <div class="form-group">
        <label> Image Url</label>
        <input type="text"  name="siteurl" class="form-control" value="<?php echo $image['imageurl'] ?>" required>
    </div>
    <div class="form-group">
        <label>Alt</label>
        <input type="text"  name="siteurl" class="form-control" value="<?php echo $image['siteurl'] ?>" required>
    </div>
   <br>
    
    
    <button type="submit" class="btn btn-primary">Update</button>
</form>

