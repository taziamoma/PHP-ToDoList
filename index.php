<?php
include_once("includes/connection.php");

$errors = "";

if (isset($_POST['submit'])) {
	if (empty($_POST['task'])) {
		$errors = "You must fill in the task";
	} else {
		try {
			$task = $_POST['task'];
			$sql = "INSERT INTO todopost (title) VALUES ('$task')";
			$db->exec($sql);;
			header('Location: index.php');
		} catch(PDOException $e) {
			echo $sql. "<br>". $e->getMessage();
		}
		
	}
}

if (isset($_GET['del_task'])) {
	$stmt = $db->prepare("DELETE FROM todopost WHERE id = :id");
	$stmt->execute(array(':id' => $_GET['del_task']));
	header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

</style>
</head>
<body>
<div class="outside">
	<div class="container">
		<div id="myDIV" class="header">
		  <h2 style="margin:5px">My To Do List</h2>
		  <form method="post" action="index.php" class="input_form">
		  	<?php if (isset($errors)) { ?>
			<p><?php echo $errors; ?></p>
			<?php } ?>
			<input type="text" name="task" class="input">
			<button type="submit" name="submit" class="addBtn">Add</button>
		</form>
		</div>


		<ul id="myUL">
			<?php 
			try {
				$stmt = $db->query('SELECT id, title FROM  todopost ORDER BY id DESC');
				while($row = $stmt->fetch()) { ?>
					<div class="li_cont">
						<li><?php echo $row['title']; ?></li>
						<a class="right" href="index.php?del_task=<?php echo $row['id'] ?>">x</a>
					</div>
				<?php }
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		  
		  	?>
		</ul>

	</div>
</div>

</body>
</html>
