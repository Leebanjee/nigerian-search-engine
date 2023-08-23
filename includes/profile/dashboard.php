<?php session_start(); 
if (!isset($_SESSION['user_name']) ) {
  header('location: ../login/Login.php');
  die();
}
$pdo = require_once '../../Database/databaseconfig.php';
$id = $_SESSION["id"];
$statement = $pdo->prepare("SELECT * FROM posts WHERE user_id = $id");
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/cerulean.theme.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title><?php $_SESSION['user_name']?> Dashboard</title>
  </head>
  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="#"
          >Project NSE</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
            <div class="input-group">
              <input
                class="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle ms-2"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-person-fill"></i>
              </a>
             
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
          
            <li>
              <a href="updateProfile.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Update Profile</span>
              </a>
            </li>
            <li>
              <a href="updatePassword.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Change Password</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Addons
              </div>
            </li>
            <li>
              <a href="postCreate.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-user"></i></span>
                <span>Submit Site</span>
              </a>
            </li>
           
            <li>
              <a href="../logout/Logout.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                <span>Logout</span>
              </a>
            </li>
           
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <h4>Dashboard</h4>
            </div>
          </div>
        
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card h-100">
              <div class="card-header">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                personal Information
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col">

                    <img src="../../public/<?php echo $_SESSION['image']?>" alt="<?php echo $_SESSION['user_name'] ?>"  data-lock-picture="<?php $_SESSION['image'] ; ?>" width="50%" />
                  </div>
                  <div class="col">
                    <table>
                      <td><tr><span>Name:<h6><?php echo $_SESSION['user_name']; ?></h6></span></tr></td>
                      <hr>
                      <td><tr><span>Email:</span>  <h6><?php echo $_SESSION['email']; ?></h6></tr></td>
                      
                    </table>
                  </div>
                 </div>
                </div>
                
              </div>
            </div>
          
          
        </div>
        <div class="row">
          <div class="container">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> My Posts
              </div>
              <div class="card-body">
              <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-sm table-striped table-bordered table-hover data-table"
                    style="width: 100%"
                  >
                  <thead>
                      <tr>
                        <th>ID</th>
                        <th>Email</th>
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
                                            
                                            
                                            
                                            <td><?php echo $post['email']?></td>
                                            <td><?php echo $post['title']?></td>
                                            <td><?php echo $post['siteurl']?></td>
                                            
                                            <td><?php echo $post['body']?></td>
                                            <td><?php echo $post['created_at'] ?></td>

                                            <td>
                                            <a href="postUpdate.php?id=<?php echo $post['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form method="post" action="postDelete.php" style="display: inline-block">
                                                    <input  type="hidden" name="id" value="<?php echo $post['id'] ?>"/>
                                                    <button type="submit" data-toggle="tooltip" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                  </table>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
