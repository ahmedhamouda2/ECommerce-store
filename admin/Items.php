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
        $stmt = $con->prepare("SELECT 
                                    items.* , categories.Name AS catogry_name , users.Username
                                FROM 
                                    items
                                INNER JOIN 
                                    categories 
                                ON 
                                    items.Cat_ID = categories.ID
                                INNER JOIN 
                                    users 
                                ON 
                                    items.Member_ID = users.UserID
                                ORDER BY 
                                    Item_ID DESC");
        $stmt->execute();

        // assign to varible
        $items = $stmt->fetchAll(); 
        if(!empty($items)) {
        ?>
            <h2 class="text-center">Manage Items</h2>
            <div class="container">
                <div class="table-responsive">
                    <table class="main-table text-center table table-bordered">
                        <tr>
                            <td>#ID</td>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Price</td>
                            <td>Adding Date</td>
                            <td>Category</td>
                            <td>Username</td>
                            <td>Control</td>
                        </tr>
                        <?php 
                            foreach ($items as $item) {
                                echo '<tr>';
                                    echo'<td>' . $item['Item_ID'] . '</td>';
                                    echo'<td>' . $item['Name'] . '</td>';
                                    echo'<td>' . $item['Description'] . '</td>';
                                    echo'<td>' . $item['Price'] . '</td>';
                                    echo'<td>' . $item['Add_Date'] . '</td>';
                                    echo'<td>' . $item['catogry_name'] . '</td>';
                                    echo'<td>' . $item['Username'] . '</td>';
                                    echo'<td>
                                            <a href="Items.php?do=Edit&itemid=' . $item['Item_ID'] . '" class="btn btn-success" role="button"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                            
                                            <a href="Items.php?do=Delete&itemid=' . $item['Item_ID'] . '" class="btn btn-danger confirm" role="button"><i class="fas fa-times" aria-hidden="true"></i> Delete</a>';
                                            if($item['Approve'] == 0){
                                                echo '<a href="Items.php?do=Approve&itemid=' . $item['Item_ID'] . '" class="btn btn-info approve" role="button"><i class="fas fa-check" aria-hidden="true"></i> Approval</a>';
                                            }
                                        echo '</td>';
                                echo '</tr>';
                            }
                        ?>

                    </table>
                </div>
                <a href="Items.php?do=Add" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> New Item</a>
            </div>

        <?php } else {
            echo '<div class="container">';
                echo '<div class="alert alert-info" role="alert">There\'s No items to show</div>';
                echo '<a href="Items.php?do=Add" class="btn btn-primary btn-sm" role="button"><i class="fa fa-plus" aria-hidden="true"></i> New Item</a>';
            echo '</div>';
        } ?>

    <?php

		} elseif ($do == 'Add') { ?>
            <h2 class="text-center">Add New Item</h2>
            <div class="container">
                <form action="?do=Insert" method="POST">
                    <!-- start Name field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="name" class="form-control" autocomplete="off" required aria-required="true" placeholder="Name of Item" aria-label="Name of Item">
                        </div>
                    </div>
                    <!-- End Name field -->
                    <!-- start Description field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Description</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="description" class="form-control" autocomplete="off" required aria-required="true" placeholder="Describe the Item" aria-label="Describe the Item">
                        </div>
                    </div>
                    <!-- End Description field -->
                    <!-- start price field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Price</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="price" class="form-control" autocomplete="off" required aria-required="true" placeholder="Price the Item" aria-label="Price the Item">
                        </div>
                    </div>
                    <!-- End price field -->
                    <!-- start country field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Country</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="country" class="form-control" autocomplete="off" required aria-required="true" placeholder="Country of Made" aria-label="Country of Made">
                        </div>
                    </div>
                    <!-- End country field -->
                    <!-- start status field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Status</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="status" aria-label="itemStatus">
                                <option value="0">...</option>
                                <option value="1">New</option>
                                <option value="2">Like New</option>
                                <option value="3">Used</option>
                                <option value="4">Very Old</option>
                            </select>
                        </div>
                    </div>
                    <!-- End status field -->
                    <!-- start members field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Member</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="member" aria-label="members">
                                <option value="0">...</option>
                                <?php
                                    $allmembers = getAllFrom("*" ,"users" ,"" , "" ,  "UserID");
                                    foreach($allmembers as $user) {
                                        echo "<option value='" . $user['UserID'] . "'>". $user['Username'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- End members field -->
                    <!-- start categories field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Category</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="category" aria-label="categories">
                                <option value="0">...</option>
                                <?php
                                    $allCats = getAllFrom("*" ,"categories" ,"WHERE parent = 0" , "" ,  "ID");
                                    foreach($allCats as $cat) {
                                        echo "<option value='" . $cat['ID'] . "'>". $cat['Name'] . "</option>";
                                        $childCats = getAllFrom("*" ,"categories" ,"WHERE parent = {$cat['ID']}" , "" ,  "ID");
                                        foreach($childCats as $child) {
                                            echo "<option value='" . $child['ID'] . "'>--- ". $child['Name'] . "</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- End categories field -->
                    <!-- start Tags field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Tags</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="tags" class="form-control" placeholder="separator tags with comma ( , )" aria-label="separator tags with comma ( , )">
                        </div>
                    </div>
                    <!-- End Tags field -->
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
            $member     = $_POST['member'];
            $cat        = $_POST['category'];
            $tags       = $_POST['tags'];

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
            if($member == 0){
                $formErrors[] = 'You must choose the <strong>Member.</strong>';
            }
            if($cat == 0){
                $formErrors[] = 'You must choose the <strong>Category.</strong>';
            }
            // loop into errors array and echo it 
            foreach($formErrors as $error){
                echo  '<div class="alert alert-danger" role="alert">' . $error . '</div>';
            }

            // check if there no error proceed the update operation
                if(empty($formErrors)){
                    // Insert item info in database
                    $stmt = $con->prepare("INSERT INTO 
                                                items(`Name` , `Description` , Price , Country_Made ,`Status` , Add_Date , Cat_ID , Member_ID , tags) 
                                            VALUES(:zname , :zdesc , :zprice , :zcountry , :zstatus , now() , :zcat , :zmember , :ztags)");
                    $stmt->execute(array(
                        'zname'     => $name,
                        'zdesc'     => $desc,
                        'zprice'    => $price,
                        'zcountry'  => $country,
                        'zstatus'   => $status,
                        'zmember'   => $member,
                        'zcat'      => $cat,
                        'ztags'     => $tags
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
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']): 0;
        // check if user exist in database
        $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ?");
        $stmt->execute(array($itemid));
        $item = $stmt->fetch();
        $count = $stmt->rowCount();
        if($count > 0) { ?>
            <h2 class="text-center">Edit Item</h2>
            <div class="container">
                <form action="?do=Update" method="POST">
                <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
                    <!-- start Name field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="name" class="form-control" autocomplete="off" required aria-required="true" placeholder="Name of Item" aria-label="Name of Item" value="<?php echo $item['Name'] ?>">
                        </div>
                    </div>
                    <!-- End Name field -->
                    <!-- start Description field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Description</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="description" class="form-control" autocomplete="off" required aria-required="true" placeholder="Describe the Item" aria-label="Describe the Item" value="<?php echo $item['Description'] ?>">
                        </div>
                    </div>
                    <!-- End Description field -->
                    <!-- start price field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Price</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="price" class="form-control" autocomplete="off" required aria-required="true" placeholder="Price the Item" aria-label="Price the Item" value="<?php echo $item['Price'] ?>">
                        </div>
                    </div>
                    <!-- End price field -->
                    <!-- start country field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Country</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="country" class="form-control" autocomplete="off" required aria-required="true" placeholder="Country of Made" aria-label="Country of Made" value="<?php echo ucfirst($item['Country_Made']) ?>">
                        </div>
                    </div>
                    <!-- End country field -->
                    <!-- start status field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Status</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="status">
                                <option value="1" <?php if($item['Status'] == 1){echo 'selected';} ?> >New</option>
                                <option value="2" <?php if($item['Status'] == 2){echo 'selected';} ?>>Like New</option>
                                <option value="3" <?php if($item['Status'] == 3){echo 'selected';} ?>>Used</option>
                                <option value="4" <?php if($item['Status'] == 4){echo 'selected';} ?>>Very Old</option>
                            </select>
                        </div>
                    </div>
                    <!-- End status field -->
                    <!-- start members field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Member</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="member">
                                <?php
                                    $allmembers = getAllFrom("*" ,"users" ,"" , "" ,  "UserID");
                                    foreach($allmembers as $user) {
                                        echo "<option value='" . $user['UserID'] . "'";
                                        if($item['Member_ID'] == $user['UserID']){echo 'selected';}
                                        echo ">" . $user['Username'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- End members field -->
                    <!-- start categories field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Category</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="category">
                                <?php
                                    $allCats = getAllFrom("*" ,"categories" ,"" , "" ,  "ID"); 
                                    foreach($allCats as $cat) {
                                        echo "<option value='" . $cat['ID'] . "'";
                                        if($item['Cat_ID'] == $cat['ID']){echo 'selected';}
                                        echo ">". $cat['Name'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- End categories field -->
                    <!-- start Tags field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Tags</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="tags" class="form-control" placeholder="separator tags with comma ( , )" aria-label="separator tags with comma ( , )" value="<?php echo $item['tags'] ?>">
                        </div>
                    </div>
                    <!-- End Tags field -->
                    <!-- start submit -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <input type="submit" value="Save Item" class="btn btn-primary btn-sm">
                        </div>
                    </div>
                    <!-- end submit -->
                </form>
                <?php 
                // select all users except Admin
                $stmt = $con->prepare("SELECT 
                                            comments.* , users.Username 
                                        FROM 
                                            comments 
                                        INNER JOIN
                                            users
                                        ON
                                            users.UserID = comments.user_id
                                        WHERE  Item_id = ?");
                $stmt->execute(array($itemid));

                // assign to varible
                $rows = $stmt->fetchAll();
                if(!empty($rows)) {
                ?>
                    <h2 class="text-center">Manage [ <?php echo $item['Name']  ?> ] Comments</h2>
                    <div class="container">
                        <div class="table-responsive">
                            <table class="main-table text-center table table-bordered">
                                <tr>
                                    <td>Comment</td>
                                    <td>User Name</td>
                                    <td>Added Date</td>
                                    <td>Control</td>
                                </tr>
                                <?php 
                                    foreach ($rows as $row) {
                                        echo '<tr>';
                                            echo'<td>' . $row['comment'] . '</td>';
                                            echo'<td>' . $row['Username'] . '</td>';
                                            echo'<td>' . $row['comment_date'] . '</td>';
                                            echo'<td>
                                                    <a href="comments.php?do=Edit&commentid=' . $row['c_id'] . '" class="btn btn-success" role="button"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                    <a href="comments.php?do=Delete&commentid=' . $row['c_id'] . '" class="btn btn-danger confirm" role="button"><i class="fas fa-times" aria-hidden="true"></i> Delete</a>';
                                                    if($row['status'] == 0){
                                                        echo '<a href="comments.php?do=Approve&commentid=' . $row['c_id'] . '" class="btn btn-info approve" role="button"><i class="fas fa-check" aria-hidden="true"></i> Approve</a>';
                                                    }
                                                echo '</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
    <?php
        }else {
            echo '<div class="container">';
            $theMsg = '<div class="alert alert-danger" role="alert">There\'s No such ID</div>';
            redirectHome($theMsg);
            echo '</div>';
        }

		} elseif ($do == 'Update') {
            echo "<h2 class='text-center'>Update Item</h2>";
            echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // get variables from the Form [names in form]
                $id         = $_POST['itemid'];
                $name       = $_POST['name'];
                $desc       = $_POST['description'];
                $price      = $_POST['price'];
                $country    = $_POST['country'];
                $status     = $_POST['status'];
                $cat        = $_POST['category'];
                $member     = $_POST['member'];
                $tags       = $_POST['tags'];

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
                if($member == 0){
                    $formErrors[] = 'You must choose the <strong>Member.</strong>';
                }
                if($cat == 0){
                    $formErrors[] = 'You must choose the <strong>Category.</strong>';
                }
                // loop into errors array and echo it 
                foreach($formErrors as $error){
                    echo  '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                }

                // check if there no error proceed the update operation
                    if(empty($formErrors)){
                        // Update the database with this info
                        $stmt = $con->prepare("UPDATE 
                                                    items 
                                                SET 
                                                    `Name` = ? , `Description` = ? , Price = ? , Country_made = ? , `status` = ?, Cat_ID = ? , Member_ID = ? , tags = ?
                                                WHERE 
                                                    Item_ID = ?");
                        $stmt->execute(array($name , $desc , $price ,$country , $status , $cat , $member , $tags , $id));
            
                        // echo success message 
                        $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Updated</div>';
                        redirectHome($theMsg, 'back');
                    }

            } else {
                $theMsg = "<div class='alert alert-danger' role='alert'>Sorry you cant browse this page directly</div>";
                redirectHome($theMsg);
            }
            echo "</div>";

		} elseif ($do == 'Delete') {
            // Delete Item page
            echo "<h2 class='text-center'>Delete Item</h2>";
            echo "<div class='container'>";
                // Check if eet request itemid Is Numeric & Get its integer value   
                $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']): 0;
                // check if Item exist in database
                $check = checkItem("Item_ID", "items", $itemid);
                if($check > 0) {
                    $stmt = $con->prepare("DELETE FROM items WHERE Item_ID = :zid");
                    $stmt->bindParam(":zid", $itemid);
                    $stmt->execute();
                    $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Deleted</div>';
                    redirectHome($theMsg , 'back');
                } else {
                    $theMsg = "<div class='alert alert-danger' role='alert'>This id is <strong>not exist</strong></div>";
                    redirectHome($theMsg);
                }
            echo "</div>";

		} elseif ($do == 'Approve') {
            // Approve Item page
            echo "<h2 class='text-center'>Approve Item</h2>";
            echo "<div class='container'>";
                // Check if eet request itemid Is Numeric & Get its integer value   
                $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']): 0;
                // select all data depend on this ID 
                $check = checkItem("Item_ID", "items", $itemid);
                if($check > 0) {
                    $stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE Item_ID = ?");
                    $stmt->execute(array($itemid));
                    $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Approved</div>';
                    redirectHome($theMsg , 'back');
                } else {
                    $theMsg = "<div class='alert alert-danger' role='alert'>This id is <strong>not exist</strong></div>";
                    redirectHome($theMsg);
                }
            echo "</div>";
		}

		include $tpl . 'footer.php';
	} else {
		header('Location: index.php');
		exit();
	}
?>
