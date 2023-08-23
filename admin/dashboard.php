<?php include("../Database/databaseconfig.php"); ?>

<section class="body">
	
	<?php include_once 'includes/header.php'; ?>
	
<section role="main" class="content-body">

	<header class="page-header" >
						<h2>Dashboard</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="#">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Dashboard</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
					<!-- start: page -->
					<div class="row">
						
						<div class="col-md-6 col-lg-12 col-xl-6">
							<div class="row">
								<div class="col-md-12 col-lg-3 col-xl-3">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-users"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Users</h4>
														<div class="info">
															<strong class="amount">
															<?php
															 $query = $pdo->prepare("SELECT COUNT(1) AS TotalCount FROM `users`");
															 $query->execute();
															 $data = $query->fetch(PDO::FETCH_ASSOC);
															 $count = $data["TotalCount"];
															 echo $count;
															?>	
															</strong>
															<span class="text-primary">Total Users</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="userIndex.php" class="text-muted text-uppercase">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
                                                            
								<div class="col-md-12 col-lg-3 col-xl-3">
									<section class="panel panel-featured-left panel-featured-secondary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
														<i class="fa fa-gear"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Posts</h4>
														<div class="info">
                                                        <strong class="amount">
														<?php
															 $query = $pdo->prepare("SELECT COUNT(1) AS TotalCount FROM `posts`");
															 $query->execute();
															 $data = $query->fetch(PDO::FETCH_ASSOC);
															 $count = $data["TotalCount"];
															 echo $count;
															?>
														</strong>
															<span class="text-primary">Total Posts</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="postIndex.php" class="text-muted text-uppercase">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
							
								<div class="col-md-12 col-lg-3 col-xl-3">
									<section class="panel panel-featured-left panel-featured-tertiary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-tertiary">
														<i class="fa fa-gear"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Sites Results</h4>
														<div class="info">
                                                        <strong class="amount">
														<?php
															 $query = $pdo->prepare("SELECT COUNT(1) AS TotalCount FROM `sites`");
															 $query->execute();
															 $data = $query->fetch(PDO::FETCH_ASSOC);
															 $count = $data["TotalCount"];
															 echo $count;
															?>
														</strong>
															<span class="text-primary">Total Sites</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="siteIndex.php" class="text-muted text-uppercase">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-3 col-xl-3">
									<section class="panel panel-featured-left panel-featured-quaternary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-quaternary">
														<i class="fa fa-image"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Image Results</h4>
														<div class="info">
                                                            <strong class="amount">
															<?php
															 $query = $pdo->prepare("SELECT COUNT(1) AS TotalCount FROM `images`");
															 $query->execute();
															 $data = $query->fetch(PDO::FETCH_ASSOC);
															 $count = $data["TotalCount"];
															 echo $count;
															?>
															</strong>
															<span class="text-primary">Total Images</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="imageIndex.php" class="text-muted text-uppercase">(view all)</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
																						<?php
											require("../Database/config.php");
											$sql ="SELECT * FROM sites";
											$result = mysqli_query($conn,$sql);
											$chart_data="";
											$jsonArray = array();
											while ($row = mysqli_fetch_array($result)) { 
												$jsonArrayItem = array();
												$jsonArrayItem['label'] = $row['url'];
												$jsonArrayItem['y'] = $row['timesvisited'];
												//append the above created object into the main array.
												array_push($jsonArray, $jsonArrayItem);
											}




											
											?>
											<script>
																		window.onload = function() {
																		
																		var chart = new CanvasJS.Chart("chartContainer", {
																			animationEnabled: true,
																			theme: "light2",
																			title:{
																				text: "Sites Chart"
																			},
																			axisY: {
																				title: "Times Visited"
																			},
																			data: [{
																				type: "column",
																				yValueFormatString: "#,##0.## tonnes",
																				dataPoints: <?php echo json_encode($jsonArray, JSON_NUMERIC_CHECK); ?>
																			}]
																		});
																		chart.render();
																		
																		}
																		</script>


																		<div id="chartContainer" style="height: 370px; width: 100%;"></div>
																		<script src="assets/js/canvasjs.min.js"></script>

										</div>
										
									</section>
								</div>
                                                            
                                                            
                                            
                                            
                                            
					</div>
					
					<?php include_once 'includes/footer.php'; ?>			
</body>		