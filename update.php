<?php 
	 header("Access-Control-Allow-Origin: *");
	require 'database.php';

	if (!empty($_GET['id'])) {
            $id = $_REQUEST['id'];
        }
        
        // if data was entered by the user
        if (isset($_POST['update'])) {	
            // get values
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            
            $valid = true;
            if (empty($name) || empty($email) || empty($mobile)) {
                $valid = false;
            } 
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE customers  set name = ?, email = ?, mobile =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$email,$mobile,$id));
			Database::disconnect();
			
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM customers where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['name'];
		$email = $data['email'];
		$mobile = $data['mobile'];
		Database::disconnect();
	}
?>


<div class="title">Update User</div>
<p><a href="customer.html" class="btn btn-primary">Back to Start</a></p>


<div class="control-group">
    <label class="control-label">name</label>
    <div class="controls">
        <input id="name" type="text"  placeholder="name" value="<?php echo !empty($name)?$name:'';?>" required>
    </div>
</div>


<div class="control-group">
    <label class="control-label">email</label>
    <div class="controls">
        <input id="email" type="text"  placeholder="email" value="<?php echo !empty($email)?$email:'';?>" required>
    </div>
</div>


<div class="control-group">
    <label class="control-label">mobile</label>
    <div class="controls">
        <input id="mobile" type="text" placeholder="mobile number" value="<?php echo !empty($mobile)?$mobile:'';?>" required>
    </div>
</div>