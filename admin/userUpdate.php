<?php
require_once "../includes/helper/functions.php";
$pdo = require_once '../Database/databaseconfig.php';
$id =  $_GET['id'] ?? null;

if (!$id) {
    echo '<script>window.location.href="userIndex.php"</script>';
    exit;
}
$statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);
$errors = [];


$name = $user['name'];
$email = $user['email'];
$password = $user['password'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);;
    $password = $_POST['password'];
    $cpass = $_POST['cpass'];
	$usertype = $_POST['usertype'];
	$status = $_POST['status'];
        
        
        if ($password !== $cpass) {
            $errors[] ='password not matched';
        }else{

           
           require_once '../validate_users.php';
        
            if (empty($errors)) {
              
                $statement = $pdo->prepare("UPDATE users SET name = :name, 
                                        email = :email,
                                        image = :image,
                                        usertype = :usertype,
                                        status = :status,
                                        password = :password,
                                        created_at = :date 
                                        WHERE id = :id");
               $statement->bindValue(':image', $imagePath);
               $statement->bindValue(':name', $name);
               $statement->bindValue(':email', $email);
               $statement->bindValue(':usertype', $usertype);
               $statement->bindValue(':status', $status);
               $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
               $statement->bindValue(':date', date('Y-m-d H:i:s'));
                $statement->bindValue(':id', $id);

                $statement->execute();
        
                
                echo '<script>window.location.href="userIndex.php"</script>';
            }
        }
}

?>


<section class="body">
	<?php include_once 'includes/header.php'; ?>
<section role="main" class="content-body">
	<header class="page-header">
						<h2>Update User</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Update User</span></li>
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
										<h2 class="panel-title">Update User</h2>
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
                                                            <?php if ($user['image']): ?>
                                                                <img src="../public/<?php echo $user['image'] ?>" class="product-img-view" width="50px">
                                                            <?php endif; ?>
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label" for="inputReadOnly">Image</label>
                                                        <div class="col-md-6">
                                                            <input type="file" name="image"  id="inputReadOnly" class="form-control" required>
                                                        </div>
                                                 </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="inputReadOnly">Name</label>
                                                    <div class="col-md-6">
                                                        
                                                        <input name="name" type="text" class="form-control" id="inputReadOnly" value="<?php echo $user['name']?>" required/>
									
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label" for="inputReadOnly">Email</label>
                                                    <div class="col-md-6">
                                                        
                                                        <input name="email" type="email" class="form-control" id="inputReadOnly" value="<?php echo $user['email']?>" required/>
									
                                                    </div>
                                                 </div>
                                                    
                                                 <div class="form-group">
                                                    <label class="col-md-3 control-label" for="inputHelpText">Role</label>
                                                    <div class="col-md-6">
                                                        <select data-plugin-selectTwo class="form-control populate" name="usertype"  required>
                                                                <option value="">Select Role</option>
                                                                <option value="Administrator">Administrator</option>
                                                                <option value="user">User</option>
                                                         </select>
                                                                                                                            
                                                    </div>
											   </div>
                                                 <div class="form-group">
                                                    <label class="col-md-3 control-label" for="inputHelpText">Status</label>
                                                    <div class="col-md-6">
                                                        <select data-plugin-selectTwo class="form-control populate" name="status" required>
                                                                <option value="">Select Status</option>
                                                                <option value="verified">Verified</option>
                                                                <option value="not verified">Not Verified</option>
                                                         </select>
                                                                                                                            
                                                    </div>
											   </div>
                                               
                                               <div class="form-group">
                                                    <label class="col-md-3 control-label" for="inputReadOnly">Password</label>
                                                    <div class="col-md-6">
                                                        
                                                        <input name="password" type="password" class="form-control" id="inputReadOnly"  required/>
									
                                                    </div>
                                                 </div>
                                               <div class="form-group">
                                                    <label class="col-md-3 control-label" for="inputReadOnly">Confirm Password</label>
                                                    <div class="col-md-6">
                                                        
                                                        <input name="cpass" type="password" class="form-control" id="inputReadOnly"  required/>
									
                                                    </div>
                                                 </div>
                                                        
                                                </div>
                                            
                                                            <footer class="panel-footer">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                
                                                            </footer>
                                                            
                                    </form>
                                    
                                </section>
                            </div>
                    </div>
</section>


    

    
    
    
    
    


