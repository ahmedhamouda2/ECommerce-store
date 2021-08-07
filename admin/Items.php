<?php

	/*
	================================================
	== Items Page
	================================================
	*/

	session_start();
	$pageTitle = 'Items';
	if (isset($_SESSION['Username'])) {
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		if ($do == 'Manage') {

            echo 'Welcome to Items page';

		} elseif ($do == 'Add') { ?>

            <h2 class="text-center">Add New Item</h2>
            <div class="container">
                <form action="?do=Insert" method="POST">
                    <!-- start Name field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="name" class="form-control" autocomplete="off" required placeholder="Name of Item">
                        </div>
                    </div>
                    <!-- End Name field -->
                    <!-- start Description field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Description</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="description" class="form-control" autocomplete="off" required placeholder="Describe the Item">
                        </div>
                    </div>
                    <!-- End Description field -->
                    <!-- start price field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Price</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="price" class="form-control" autocomplete="off" required placeholder="Price the Item">
                        </div>
                    </div>
                    <!-- End price field -->
                    <!-- start country field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Country</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="country" class="form-control" autocomplete="off" required placeholder="Country of Made">
                        </div>
                    </div>
                    <!-- End country field -->
                    <!-- start status field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Status</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="status">
                                <option value="0">...</option>
                                <option value="1">New</option>
                                <option value="2">Like New</option>
                                <option value="3">Used</option>
                                <option value="4">Very Old</option>
                            </select>
                        </div>
                    </div>
                    <!-- End status field -->
                    <!-- start submit -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <input type="submit" value="Add Item" class="btn btn-primary btn-sm">
                        </div>
                    </div>
                    <!-- end submit -->
                </form>
            </div>
            <?php 
		} elseif ($do == 'Insert') {  // Insert Items page

        echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo "<h2 class='text-center'>Insert Items</h2>";
            echo "<div class='container'>";

            // get variables from the Form [names in form]
            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $price      = $_POST['price'];
            $country    = $_POST['country'];
            $status     = $_POST['status'];

            // validate the Form 
            $formErrors = array();
            if(empty($name)){
                $formErrors[] = 'Name cant be <strong>empty.</strong>';
            }
            if(empty($desc)){
                $formErrors[] = 'Description cant be <strong>empty.</strong>';
            }
            if(empty($price)){
                $formErrors[] = 'Price cant be <strong>empty.</strong>';
            }
            if(empty($country)){
                $formErrors[] = 'Country cant be <strong>empty.</strong>';
            }
            if($status == 0){
                $formErrors[] = 'You must choose the <strong>Status.</strong>';
            }
            // loop into errors array and echo it 
            foreach($formErrors as $error){
                echo  '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }

            // check if there no error proceed the update operation
                if(empty($formErrors)){
                    // Insert user info in database
                    $stmt = $con->prepare("INSERT INTO items(`Name` , `Description` , Price , Country_Made ,`Status` , Add_Date) VALUES(:zname , :zdesc , :zprice , :zcountry , :zstatus , now())");
                    $stmt->execute(array(
                        'zname' => $name,
                        'zdesc' => $desc,
                        'zprice' => $price,
                        'zcountry' => $country,
                        'zstatus' => $status,
                    ));
    
                    // echo success message 
                    $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Inserted</div>';
                    redirectHome($theMsg, 'back');
                }

        } else {
            $theMsg = "<div class='alert alert-danger' role='alert'>Sorry you cant browse this page directly</div>";
            redirectHome($theMsg);
        }
        echo "</div>";

		} elseif ($do == 'Edit') {


		} elseif ($do == 'Update') {


		} elseif ($do == 'Delete') {


		} elseif ($do == 'Approve') {


		}

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}


?>