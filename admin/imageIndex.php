<?php
require_once "../includes/helper/functions.php";
$pdo = require_once '../Database/databaseconfig.php';

$statement = $pdo->prepare('SELECT * FROM images');
$statement->execute();
$images = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="body">
	<?php include_once 'includes/header.php'; ?>
<section role="main" class="content-body">
	<header class="page-header">
						<h2>All Images</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>All Images</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
                    <div class="row">
							
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
										<h2 class="panel-title">All Images</h2>
									</header>
                                    <div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
                                              
                                        <th>#</th>
                                        <th>Site Url</th> 
                                        <th>Image Url</th> 
                                        <th>Alt</th> 
                                        <th>Time Visited</th> 
                                        
                                        <th>Actions</th>
                                             
										</tr>
									</thead>
									<tbody>
                                    <?php foreach ($images as $i => $image) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
             <!-- <td>
                
            </td> -->
            
            
            
            
            <td><?php echo $image['siteurl']?></td>
            <td><?php echo $image['imageurl']?></td>
            
            <td><?php echo $image['alt']?></td>
            <td><?php echo $image['timesvisited'] ?></td>
            <td>
            <a href="imageUpdate.php?id=<?php echo $image['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-pencil"></i></a>
                <form method="post" action="imageDelete.php" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $image['id'] ?>"/>
                    <button type="submit" data-toggle="tooltip"><i class="fa fa-trash" style="color: red;"></i></button>
                </form>
            </td>
        </tr>
    <?php } ?>
                                    </tbody>
                                </section>
                            

                    </div>
</section>


<?php include_once 'includes/footer.php'; ?>


