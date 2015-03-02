<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		
		$nameError = null;
		$priceError = null;
		$photoError = null;
		$countError = null;
		$dateError = null;
		
		
		$name = $_POST['name'];
		$price = $_POST['price'];
		$photo = $_POST['photo'];
		$count = $_POST['count'];
		$date = $_POST['date'];
	
			
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter name of product';
			$valid = false;
		}
		
		if (empty($price)) {
			$priceError = 'Please enter price of product';
			$valid = false;
		}	
		
		if (empty($photo) {
			$photoError = 'Please enter photo of your product';
			$valid = false;
		}			
			
		
		if (empty($count)) {
			$countError = 'How many products do you have?';
			$valid = false;
			
		if (empty($date)) {
			$dateError = 'When did you get this product';
			$valid = false;
		}
		
		
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE crud  set name = ?, price = ?, photo =?, count = ?, date =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name, $price, $photo, $count, $date, $id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM crud where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['name'];
		$price = $data['price'];
		$photo = $data['photo'];
		$count = $data['count'];
		$date = $data['date'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					   <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
					    <label class="control-label">Price</label>
					    <div class="controls">
					      	<input name="price" type="text"  placeholder="price" value="<?php echo !empty($pice)?$price:'';?>">
					      	<?php if (!empty($priceError)): ?>
					      		<span class="help-inline"><?php echo $priceError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					   <div class="control-group <?php echo !empty($photoError)?'error':'';?>">
					    <label class="control-label">Photo</label>
					    <div class="controls">
					      	<input name="photo" type="text"  placeholder="photo" value="<?php echo !empty($photo)?$photo:'';?>">
					      	<?php if (!empty($photoError)): ?>
					      		<span class="help-inline"><?php echo $photoError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($countError)?'error':'';?>">
					    <label class="control-label">count</label>
					    <div class="controls">
					      	<input name="count" type="text" placeholder="count" value="<?php echo !empty($count)?$count:'';?>">
					      	<?php if (!empty($countError)): ?>
					      		<span class="help-inline"><?php echo $countError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
					    <label class="control-label">date</label>
					    <div class="controls">
					      	<input name="date" type="text"  placeholder="date" value="<?php echo !empty($date)?$date:'';?>">
					      	<?php if (!empty($dateError)): ?>
					      		<span class="help-inline"><?php echo $dateError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> 
  </body>
</html>