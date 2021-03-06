<?php
	require_once('conn.php');
	require_once('functions.php');
?>	<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<?php 
	include('head.php');
	$templates = fnglobalquery($PDO, '*', 'templates', 1, 1, 1, 1, 1, 1, 'id', 'ASC');
	$bgimages = fnglobalquery($PDO, '*', 'gallery', 'type', 'bgimage', 1, 1, 1, 1, 'id', 'ASC');
?>
<title>Add Screen</title>

</head>

<body>
<?php include('nav.php'); ?>
 
	<div class="container tjb_container">	
	<div class="page_title">
		<h1>Add New Screen</h1>
	</div>
		
		<form name="addsnewscreen" action="insertscreen.php" method="post">
			
			<div class="col-sm-6">
			
				<div class="form-group">
					<label for="screenName">Screen Name (Not shown on screen)</label>
					<input type="text" class="form-control" id="screenName" name="screenName"  maxlength="20" placeholder="eg. Maths Screen"/>
					<input type="hidden" class="form-control" id="owner" name="owner" value="<?php echo strtoupper($_SESSION['user']['username']); ?>" />
				</div>
				
				<div class="form-group">
					<label for="slideDuration">Slide Duration (Seconds)</label>
					<input type="text" class="form-control" id="slideDuration" name="slideDuration" value="10"/>
				</div>
			<br />
				<button style="margin-top: 3px;" type="submit" class="btn">Update</button>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group">
					<label for="defaultTitle">Default Title (eg. Department or Screen name)</label>
					<input type="text" class="form-control" id="defaultTitle" name="defaultTitle" maxlength="100" placeholder="eg. Maths Department or Maths News"/>
				</div>
				
				<div class="form-group">
						<label for="defaultBackground">Default Background</label>
						
						<select type="text" class="form-control" id="defaultBackground" name="defaultBackground" value="<?php echo htmlspecialchars($row['defaultBackground'], ENT_QUOTES); ?>">
						<?php 
							$bgselected = $row['defaultBackground'];
							foreach($bgimages as $option) {
								if($bgselected == $option['fileName']){
									?>
									<option value="<?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?>" selected="selected"><?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?></option>
								<?php
								} else { ?>
									<option value="<?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($option['fileName'], ENT_QUOTES); ?></option>
									<?php
								}
							}
						?>
						</select>
					</div>
				
				<div class="form-group">
					<label for="defaultTemplate">Default Template</label>
					<select type="text" class="form-control" id="defaultTemplate" name="defaultTemplate">
						<?php foreach($templates as $templatelist) {
						?>
						<option value="<?php echo htmlspecialchars($templatelist['className'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($templatelist['name'], ENT_QUOTES); ?></option>
						<?php
						} ?>
					</select>
				</div>
			</div>
		</form>
	</div>
	<?php include('footer.php'); ;?>
		
		


	
	</body>


	</html>