<?php
require_once "includes/helper/functions.php";
$pdo = require_once '../Database/databaseconfig.php';
$statement = $pdo->prepare('SELECT * FROM sites');
$statement->execute();
$sites = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="body">
	<?php include_once 'includes/header.php'; ?>
<section role="main" class="content-body">
	<header class="page-header">
						<h2>All Sites</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="/admin">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>All Sites</span></li>
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
										<h2 class="panel-title">All Sites</h2>
									</header>
                                    <div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
                                              
                                            <th>#</th>
                                            
                                            <th>Title</th>
                                        
                                        <th> Site Url</th> 
                                        <th>Description</th> 
                                        <th>Keywords</th>
                                        <th>Times Visited</th>
                                        <th>Actions</th>
                                             
										</tr>
									</thead>
									<tbody>
                                    <?php foreach ($sites as $i => $site) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $i + 1 ?></th>
                                                <!-- <td>
                                                    
                                                </td> -->
                                                
                                                
                                                
                                                <td><?php echo $site['title']?></td>
                                                <td><?php echo $site['url']?></td>
                                                
                                                <td><?php echo $site['description']?></td>
                                                <td><?php echo $site['keywords'] ?></td>
                                                <td><?php echo $site['timesvisited'] ?></td>
                                                <td>
                                                <a href="siteUpdate.php?id=<?php echo $site['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-pencil"></i></a>
                                                    <form method="post" action="siteDelete.php" style="display: inline-block">
                                                        <input  type="hidden" name="id" value="<?php echo $site['id'] ?>"/>
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

