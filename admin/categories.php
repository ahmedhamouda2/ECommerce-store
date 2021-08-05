<?php

	/*
	================================================
	== categories Page
	================================================
	*/

	session_start();
	$pageTitle = 'Categories';
	if (isset($_SESSION['Username'])) {
		include 'init.php';
		$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
		if ($do == 'Manage') {

            $stmt2 = $con->prepare('SELECT * FROM categories');
            $stmt2->execute();
            $cats = $stmt2->fetchAll(); ?>

                <h2 class="text-center">Manage Categories</h2>
                <div class="container categories">
                    <div class="card">
                        <div class="card-header">Manage Categories</div>
                        <div class="card-body">
                            <?php 
                                foreach($cats as $cat) {
                                    echo '<div class="cat">';
                                        echo "<div class='hidden-buttons'>";
                                            echo "<a href='#' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Edit</a>";
                                            echo "<a href='#' class='confirm btn btn-xs btn-danger'><i class='fa fa-times'></i> Delete</a>";
                                        echo "</div>";

                                        echo '<h3>' . $cat['Name'] . '</h3>';
                                        echo "<p>"; if($cat['Description'] == '') { echo 'This category has no description'; } else { echo $cat['Description']; } echo "</p>"; '</p>';
                                        if($cat['Visibility'] == 1) { echo '<span class="visibility cat-span"><i class="fa fa-eye"></i> Hidden</span>'; }
                                        if($cat['Allow_comment'] == 1) { echo '<span class="commenting cat-span"><i class="fa fa-times"></i> Comment Disabled</span>'; }
                                        if($cat['Allow_Ads'] == 1) { echo '<span class="advertises cat-span"><i class="fa fa-times"></i> Ads Disabled</span>';} 
                                    echo '</div>';
                                    echo '<hr>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <?php

		} elseif ($do == 'Add') { ?>

            <h2 class="text-center">Add New Category</h2>
            <div class="container">
                <form action="?do=Insert" method="POST">
                    <!-- start Name field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="username" name="name" class="form-control" autocomplete="off" required  placeholder="Name of category">
                        </div>
                    </div>
                    <!-- End Name field -->
                    <!-- start Description field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Description</label>
                        <div class="col-sm-10 col-md-6">
                            <textarea name="description" class="form-control" placeholder="Describe the category"></textarea>
                        </div>
                    </div>
                    <!-- end Description field -->
                    <!-- start Ordering field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Ordering</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="ordering" class="form-control" placeholder="Number to Arrange the categories">
                        </div>
                    </div>
                    <!-- end Ordering field -->
                    <!-- start Visibility field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Visibility</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="vis-yes" type="radio" name="visibility" value="0" checked>
                                <label for="vis-yes">Yes</label>
                            </div>
                            <div>
                                <input id="vis-no" type="radio" name="visibility" value="1">
                                <label for="vis-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- end Visibility field -->
                    <!-- start commenting field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Allow Commenting</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="com-yes" type="radio" name="commenting" value="0" checked>
                                <label for="com-yes">Yes</label>
                            </div>
                            <div>
                                <input id="com-no" type="radio" name="commenting" value="1">
                                <label for="com-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- end commenting field -->
                    <!-- start Ads field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Allow Ads</label>
                        <div class="col-sm-10 col-md-6">
                            <div>
                                <input id="ads-yes" type="radio" name="ads" value="0" checked>
                                <label for="ads-yes">Yes</label>
                            </div>
                            <div>
                                <input id="ads-no" type="radio" name="ads" value="1">
                                <label for="ads-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- end Ads field -->
                    <!-- start submit -->
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <input type="submit" value="Add Category" class="btn btn-primary btn-lg">
                        </div>
                    </div>
                    <!-- end submit -->
                </form>
            </div>
            
            <?php 
		} elseif ($do == 'Insert') {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo "<h2 class='text-center'>Insert Category</h2>";
            echo "<div class='container'>";

            // get variables from the Form
            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $order      = $_POST['ordering'];
            $visible    = $_POST['visibility'];
            $comment    = $_POST['commenting'];
            $ads        = $_POST['ads'];
            // check if Category exist to database
            $check = checkItem("Name", "categories", $name);
            if($check == 1) {
                $theMsg = '<div class="alert alert-danger" role="alert"> Sorry , This Category is <strong>exist</strong></div>';
                redirectHome($theMsg , 'back');
            } else {
                // Insert Category info in database
                $stmt = $con->prepare("INSERT INTO categories(Name, Description, Ordering, Visibility, Allow_Comment, Allow_Ads) VALUES(:zname, :zdesc, :zorder, :zvisible, :zcomment, :zads)");
                $stmt->execute(array(
                    'zname' 	=> $name,
                    'zdesc' 	=> $desc,
                    'zorder' 	=> $order,
                    'zvisible' 	=> $visible,
                    'zcomment' 	=> $comment,
                    'zads'		=> $ads
                ));

                // echo success message 
                $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Inserted</div>';
                redirectHome($theMsg, 'back');
            }

        } else {
            echo "<div class='container'>";
            $theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';
            redirectHome($theMsg, 'back');
            echo "</div>";
        }
        echo "</div>";

		} elseif ($do == 'Edit') {


		} elseif ($do == 'Update') {


		} elseif ($do == 'Delete') {


        }

		include $tpl . 'footer.php';

	} else {

		header('Location: index.php');

		exit();
	}


?>