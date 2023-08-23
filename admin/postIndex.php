<?php
require_once "../includes/helper/functions.php";
$pdo = require_once '../Database/databaseconfig.php';


$statement = $pdo->prepare('SELECT * FROM posts ORDER BY created_at DESC');
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="body">
	<?php include_once 'includes/header.php'; ?>
<section role="main" class="content-body">
	<header class="page-header">
						<h2>All Posts</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>All Posts</span></li>
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
										<h2 class="panel-title">All Posts</h2>
									</header>
                                    <div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
                                              
                                        <th>#</th>
         
        
                                        <th>Title</th>
                                        
                                        <th>Url</th> 
                                        <th>Body</th> 
                                        <th>Create Date</th>
                                        <th>Actions</th>
                                             
										</tr>
									</thead>
									<tbody>
                                    <?php foreach ($posts as $i => $post) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $i + 1 ?></th>
                                            <!-- <td>
                                                
                                            </td> -->
                                            
                                            
                                            
                                            <td><?php echo $post['title']?></td>
                                            <td><?php echo $post['siteurl']?></td>
                                            
                                            <td><?php echo $post['body']?></td>
                                            <td><?php echo $post['created_at'] ?></td>

                                            <td>
                                            
                                                <form method="post" action="postDelete.php" style="display: inline-block">
                                                    <input  type="hidden" name="id" value="<?php echo $post['id'] ?>"/>
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






