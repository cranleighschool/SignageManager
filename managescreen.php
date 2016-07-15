<!DOCTYPE html>
<html>
<head>

<?php 
	include('head.php');
	include('conn.php');
	include('functions.php');
	
	$screens = fnglobalquery($PDO, '*', 'screens', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	
	if(!isset($_REQUEST['id'])) {
		$id = $screens[0]['id'];
	} else {
		$id = $_REQUEST['id'];
	}
	
	$screen = fnglobalquery($PDO, '*', 'screens', 'id', $id, 1, 1, 1, 1, 'id', 'ASC');
	$tableName = 'screen' . $id;
	$slides = fnglobalquery($PDO, '*', $tableName, 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$defaultTitle = $screen[0]['defaultTitle'];
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
?>

<title>Digital Signage Manager</title>
	
	<style>
	</style>
	
</head>

<body>
 <!-- Navigation -->
   <nav class="navbar navbar-default navbar-fixed-top" style="border-bottom: 1px solid #0C223F;">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="signagemanager.php"><i class="cranfont cranfont-logo"></i> Digital Signage Manager</a>
			</div>
			
				<div id="navbar" class="navbar-collapse collapse">
						
				<ul class="nav navbar-nav">
					<li><a href="#menu-toggle" id="menu-toggle" onClick="setPadding()"><i class="fa fa-bars"></i></a></li>
					<li><a  href="signagemanager.php">Home</a></li>				
					<li class="dropdown active">
						<a href="reporting.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<?php foreach($screens as $navscreens) {
									?>
									<li><a href="editscreen.php?id=<?php echo $navscreens['id']; ?>"><?php echo $navscreens['screenName']; ?></a></li>
									
									<?php
								} ?>
								
								
							</ul>
					</li>
					<li class="dropdown ">
						<a href="reporting.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Preview Screen<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="reporting.php">Dining Hall Screens</a></li>
								<li><a href="report_budget.php">History Screen</a></li>
								<li><a href="report_supplier.php">Music Screen</a></li>
							</ul>
					</li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li><a href="?logout">Sign Out (TJB) <i class="fa fa-fw fa-sign-out"></i></a></li>
					<li style="padding-top: 8px;">
					

					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	
	
	
	<div class="container tjb_container">
	<div class="page_title">	
	<h1><?php echo $screen[0]['screenName']; ?> - Manage Screen</h1>
	</div>
	
	<div class="addnew">
		<a href="#">Add New Slide</a>
	</div>
	
		<div class="table-responsive">
			<table class="table text-center table-striped table-hover">
				<tr>
					<th class="text-center">Screen Name</th>
					<th class="text-center">Default Title</th>
					<th class="text-center">Slide Duration</th>
					<th class="text-center">Default Background</th>
					<th class="text-center">Default Template</th>
					<th class="text-center">Manage Slides</th>
					<th class="text-center">Preview</th>
					<th class="text-center">Delete</th>
				</tr>
				<tr>
					<?php foreach($screen as $row) {
						?>
						<td><?php echo $row['screenName']; ?></td>
						<td><?php echo $row['defaultTitle']; ?></td>
						<td><?php echo $row['slideDuration']; ?></td>
						<td><?php echo $row['defaultBackground']; ?></td>
						<td><?php echo $row['defaultTemplate']; ?></td>
						<td><a href="screenmanager.php?id=<?php echo $row['id']; ?>"><i class="fa fa-th-list"></i></a></td>
						<td><a href="previewscreen.php?screenName=<?php echo $row['id']; ?>"<i class="fa fa-play-circle-o"></i></a></td>
						<td><a href="deleteslide.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash-o"></i></a></td>
						
					
					
				</tr>
					<?php
					} ?>
			</table>
		</div>
		<br />
			<hr />
		<br />
		<form name="addsnewscreen" action="updatescreen.php" method="post">
			
			<div class="col-sm-6">
			
				
			
				<div class="form-group">
					<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id'] ?>">
					<label for="screenName">Screen Name</label>
					<input type="text" class="form-control" id="screenName" name="screenName" value="<?php echo $row['screenName'] ?>"/>
				</div>
				
				<div class="form-group">
					<label for="slideDuration">Slide Duration (Seconds)</label>
					<input type="text" class="form-control" id="slideDuration" name="slideDuration" value="<?php echo $row['slideDuration'] ?>"/>
				</div>
			<br />
				<button style="margin-top: 3px;" type="submit" class="btn">Update</button>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label for="defaultTitle">Default Title</label>
					<input type="text" class="form-control" id="defaultTitle" name="defaultTitle" value="<?php echo $row['defaultTitle'] ?>"/>
				</div>
				
				<div class="form-group">
					<label for="defaultBackground">Default Background</label>
					<input type="text" class="form-control" id="defaultBackground" name="defaultBackground" value="<?php echo $row['defaultBackground'] ?>"/>
				</div>
				
				<div class="form-group">
					<label for="defaultTemplate">Default Template</label>
					<select type="text" class="form-control" id="defaultTemplate" name="defaultTemplate" value="<?php echo $row['defaultTemplate']; ?>">
						<?php 
						$dtSelected = $row['defaultTemplate'];
						$templateName = fnglobalquery($PDO, 'name', 'templates', 'className', $row['defaultTemplate'], 1, 1, 1, 1, 'id', 'ASC');
						
						foreach($templates as $templatelist) {
						if ($dtSelected == $templatelist['className']) {
							?>
							<option value="<?php echo $templatelist['className']; ?>" selected="selected"><?php echo $templatelist['name']; ?></option>
							<?php
						} else {
						?>
						
						<option value="<?php echo $templatelist['className']; ?>" ><?php echo $templatelist['name']; ?></option>
						<?php	
						}
						
						} ?>
					</select>
				</div>
			</div>
		</form>
		

	
	
	
	

	<?php #var_dump($templates); ?>
	</div>
	<?php include('footer.php'); ?>

	
	
	</body>
	</html>
	