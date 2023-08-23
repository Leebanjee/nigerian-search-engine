<?php
require_once "../includes/helper/functions.php";
$pdo = require_once '../Database/databaseconfig.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    echo '<script>window.location.href="siteIndex.php"</script>';
    exit;
}
$statement = $pdo->prepare('SELECT * FROM sites WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$site = $statement->fetch(PDO::FETCH_ASSOC);
$errors = [];
$title = $site['title'];
$url = $site['url'];
$description = $site['description'];
$keywords = $site['keywords'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $url = $_POST['url'];
    $description = $_POST['description'];
    $keywords = $_POST['keywords'];
    
    if (!$title) {
        $errors[] = 'title is required';
    }
    
    if (!$url) {
        $errors[] = 'Url is required';
    }
    

    if (empty($errors)) {
        $statement = $pdo->prepare(" UPDATE sites SET url = :url, title = :title, description = :description, keywords = :keywords WHERE id = :id");
        $statement->bindValue(':url', $url);
        $statement->bindValue(':title', $title);
        
        $statement->bindValue(':description', $description);
        $statement->bindValue(':keywords', $keywords);
        $statement->bindValue(':id', $id);

        $statement->execute();
        echo '<script>window.location.href="siteIndex.php"</script>';
    }

}

?>

<section class="body">
	<?php include_once 'includes/header.php'; ?>
<section role="main" class="content-body">
	<header class="page-header">
						<h2>Update Site</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="/admin">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Update Site</span></li>
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
										<h2 class="panel-title">Update Site</h2>
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
                                                                            
                                                                            <input type="text" name="title" id="inputReadOnly" class="form-control" value="<?php echo $site['title'] ?>" required>
                                                                        </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="inputReadOnly">Site Url</label>
                                                                        <div class="col-md-6">
                                                                            
                                                                        <input type="text"  name="url" id="inputReadOnly" class="form-control" value="<?php echo $site['url'] ?>" required>
                                                                        </div>
                                                                </div>
                                                            
                                                                <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="inputReadOnly">Description</label>
                                                                        <div class="col-md-6">
                                                                            
                                                                        <input type="text"  name="description" id="inputReadOnly" class="form-control" value="<?php echo $site['description'] ?>" required>
                                                                        </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                        <label class="col-md-3 control-label" for="inputReadOnly">Keywords</label>
                                                                        <div class="col-md-6">
                                                                            
                                                                        <input type="text"  name="keywords" id="inputReadOnly" class="form-control" value="<?php echo $site['keywords'] ?>" >
                                                                        </div>
                                                                </div>
                                                
                                                        <footer class="panel-footer">
                                                                <button type="submit" class="btn btn-primary">Update Site</button>
                                                            </footer>
                                                </div>
                                                
                                    </form>
                                    
                                </section>
                            </div>
                    </div>
                    

</section>

<?php include_once 'includes/footer.php'; ?>


    
