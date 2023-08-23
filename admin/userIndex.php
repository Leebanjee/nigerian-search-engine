<?php
require_once "../includes/helper/functions.php";
$pdo = require_once '../Database/databaseconfig.php';

$statement = $pdo->prepare('SELECT * FROM users ORDER BY created_at DESC');
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="body">
	<?php include_once 'includes/header.php'; ?>
<section role="main" class="content-body">
	<header class="page-header">
                                            <h2>All Users</h2>
                                        
                                            <div class="right-wrapper pull-right">
                                                <ol class="breadcrumbs">
                                                    <li>
                                                        <a href="">
                                                            <i class="fa fa-home"></i>
                                                        </a>
                                                    </li>
                                                    <li><span>All Users</span></li>
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
                                                            <h2 class="panel-title">All Users</h2>
                                                        </header>
                                                        <div class="panel-body">
                                                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                                                        <thead>
                                                            <tr>
                                                            <th>#</th>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Role</th>
                                                            <th>Status</th> 
                                                            <th>Create Date</th>
                                                            <th>Actions</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                    <?php foreach ($users as $num => $user) { ?>
                                                                    <tr>
                                                                        <th><?php echo $num + 1; ?></th>
                                                                        <td>
                                                                        <?php if ($user['image']): ?>
                                                                            <img src="../public/<?php echo $user['image'] ?>" alt="<?php echo $user['name'] ?>" width="50px">
                                                                        <?php endif; ?>
                                                                        </td>
                                                                        <td><?php echo $user['name'] ?></td>
                                                                        
                                                                        <td><?php echo $user['email'] ?></td>
                                                                        <td><?php echo $user['usertype']?></td>
                                                                        
                                                                        <td><?php echo $user['status']?></td>
                                                                        <td><?php echo $user['created_at'] ?></td>
                                                                        <td>
                                                                        <a href="userUpdate.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-pencil"></i></a>
                                                                            <form method="post" action="userDelete.php" style="display: inline-block">
                                                                                <input  type="hidden" name="id" value="<?php echo $user['id'] ?>"/>
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