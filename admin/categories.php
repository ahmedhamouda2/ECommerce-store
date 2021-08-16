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
            $sort = 'ASC';
            $sort_array = array('ASC ', 'DESC');
            if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
				$sort = $_GET['sort'];
			}
            $stmt2 = $con->prepare("SELECT * FROM categories WHERE parent = 0 ORDER BY Ordering $sort");
            $stmt2->execute();
            $cats = $stmt2->fetchAll(); 
            if(!empty($cats)) {
                ?>
                <h2 class="text-center">Manage Categories</h2>
                <div class="container categories">
                    <div class="card">
                        <div class="card-header">
                        <i class="fa fa-edit"></i> Manage Categories
                            <div class="option float-right">
                                <a class="<?php if($sort == 'ASC'){echo 'active';} ?>" href="?sort=ASC"><i class="fas fa-sort-alpha-down fa-lg"></i></a> :
                                <a class="<?php if($sort == 'DESC'){echo 'active';} ?>"  href="?sort=DESC"><i class="fas fa-sort-alpha-down-alt fa-lg"></i></a> |
                                <span class="active" data-view="full"><i class="fas fa-eye"></i></span> :
                                <span data-view="classic"><i class="fas fa-eye-slash"></i></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php 
                                foreach($cats as $cat) {
                                    echo '<div class="cat">';
                                        echo "<div class='hidden-buttons'>";
                                            echo "<a href='categories.php?do=Edit&catid=" . $cat['ID'] . "' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Edit</a>";
                                            echo "<a href='categories.php?do=Delete&catid=" . $cat['ID'] . "'  class='confirm btn btn-xs btn-danger'><i class='fa fa-times'></i> Delete</a>";
                                        echo "</div>";

                                        echo '<h3>' . $cat['Name'] . '</h3>';
                                        echo '<div class="full-view">';
                                            echo "<p>"; if($cat['Description'] == '') { echo 'This category has no description'; } else { echo $cat['Description']; } echo "</p>"; '</p>';
                                            if($cat['Visibility'] == 1) { echo '<span class="visibility cat-span"><i class="fa fa-eye"></i> Hidden</span>'; }
                                            if($cat['Allow_comment'] == 1) { echo '<span class="commenting cat-span"><i class="fa fa-times"></i> Comment Disabled</span>'; }
                                            if($cat['Allow_Ads'] == 1) { echo '<span class="advertises cat-span"><i class="fa fa-times"></i> Ads Disabled</span>';}
                                            // get child categories
                                            $childCats = getAllFrom("*","categories","WHERE parent = {$cat['ID']}" , "" , "ID" , "ASC");
                                            if(!empty($childCats)) {
                                                echo '<h6 class="child-head">Child Categories</h6>';
                                                echo '<ul class="list-unstyled child-cats">';
                                                    foreach($childCats as $c) {
                                                        echo "<li class='child-link'>
                                                                <a href='categories.php?do=Edit&catid=" . $c['ID'] . "'>" . $c['Name'] . "</a>
                                                                <a href='categories.php?do=Delete&catid=" . $c['ID'] . "'  class='show-delete confirm'>Delete</a>
                                                            </li>";
                                                    }
                                                echo '</ul>';
                                            }
                                        echo '</div>'; 
                                    echo '</div>';
                                    echo '<hr>';
                                }
                            ?>
                        </div>
                    </div>
                    <a href="categories.php?do=Add" class="btn btn-primary btn-sm add-category"><i class="fa fa-plus"></i> New Category</a>
                </div>
            <?php } else {
                        echo '<div class="container">';
                            echo '<div class="alert alert-info">There\'s No categories to show</div>';
                            echo '<a href="categories.php?do=Add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> New catgory</a>';
                        echo '</div>';
            } ?>

        <?php

		} elseif ($do == 'Add') { ?>

            <h2 class="text-center">Add New Category</h2>
            <div class="container">
                <form action="?do=Insert" method="POST">
                    <!-- start Name field -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Name</label>
                        <div class="col-sm-10 col-md-6">
                            <input type="text" name="name" class="form-control" autocomplete="off" required  placeholder="Name of category">
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
                    <!-- start category type -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Parent Catgory ?</label>
                        <div class="col-sm-10 col-md-6">
                            <select name="parent">
                                <option value="0">None</option>
                                <?php $allcats = getAllFrom("*" , "categories" ,"WHERE parent= 0" , "" ,  "ID" , "ASC");
                                    foreach($allcats as $cat) {
                                        echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                                    }
                                
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- end category type -->
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
                            <input type="submit" value="Add Category" class="btn btn-primary btn-sm">
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
            $parent       = $_POST['parent'];
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
                $stmt = $con->prepare("INSERT INTO categories(`Name`, `Description`, parent, Ordering, Visibility, Allow_Comment, Allow_Ads) VALUES(:zname, :zdesc, :zparent, :zorder, :zvisible, :zcomment, :zads)");
                $stmt->execute(array(
                    'zname' 	=> $name,
                    'zdesc' 	=> $desc,
                    'zparent' 	=> $parent,
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
            // check if get request catid is numeric & get its integer value
            $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']): 0;
            // check if category exist in database
            $stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");
            $stmt->execute(array($catid));
            $cat = $stmt->fetch();
            $count = $stmt->rowCount();

            if($count > 0) { ?>

                <h2 class="text-center">Edit Category</h2>
                <div class="container">
                    <form action="?do=Update" method="POST">
                        <input type="hidden" name="catid" value="<?php echo $catid ?>">
                        <!-- start Name field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Name</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="name" class="form-control" required  placeholder="Name of category" value="<?php echo $cat['Name'] ?>">
                            </div>
                        </div>
                        <!-- End Name field -->
                        <!-- start Description field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Description</label>
                            <div class="col-sm-10 col-md-6">
                                <textarea name="description" class="form-control" placeholder="Describe the category"><?php echo $cat['Description'] ?></textarea>
                            </div>
                        </div>
                        <!-- end Description field -->
                        <!-- start Ordering field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Ordering</label>
                            <div class="col-sm-10 col-md-6">
                                <input type="text" name="ordering" class="form-control" placeholder="Number to Arrange the categories" value="<?php echo $cat['Ordering'] ?>">
                            </div>
                        </div>
                        <!-- end Ordering field -->
                        <!-- start category type -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Parent Catgory ?</label>
                            <div class="col-sm-10 col-md-6">
                                <select name="parent">
                                    <option value="0">None</option>
                                    <?php $allcats = getAllFrom("*" , "categories" ,"WHERE parent= 0" , "" ,  "ID" , "ASC");
                                        foreach($allcats as $c) {
                                            echo "<option value='" . $c['ID'] . "'";
                                            if($cat['parent'] == $c['ID']){ echo ' selected'; }
                                            
                                            echo ">" . $c['Name'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- end category type -->  
                        <!-- start Visibility field -->
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label d-flex justify-content-sm-end">Visibility</label>
                            <div class="col-sm-10 col-md-6">
                                <div>
                                    <input id="vis-yes" type="radio" name="visibility" value="0" <?php if($cat['Visibility'] == 0){echo 'checked';}?> >
                                    <label for="vis-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="vis-no" type="radio" name="visibility" value="1" <?php if($cat['Visibility'] == 1){echo 'checked';}?> >
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
                                    <input id="com-yes" type="radio" name="commenting" value="0" <?php if($cat['Allow_comment'] == 0){echo 'checked';}?>>
                                    <label for="com-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="com-no" type="radio" name="commenting" value="1" <?php if($cat['Allow_comment'] == 1){echo 'checked';}?>>
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
                                    <input id="ads-yes" type="radio" name="ads" value="0" value="1" <?php if($cat['Allow_Ads'] == 0){echo 'checked';}?>>
                                    <label for="ads-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="ads-no" type="radio" name="ads" value="1" value="1" <?php if($cat['Allow_Ads'] == 1){echo 'checked';}?>>
                                    <label for="ads-no">No</label>
                                </div>
                            </div>
                        </div>
                        <!-- end Ads field -->
                        <!-- start submit -->
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <input type="submit" value="Save" class="btn btn-primary btn-sm>
                            </div>
                        </div>
                        <!-- end submit -->
                    </form>
                </div>

        <?php
        }else {
            echo '<div class="container">';
            $theMsg = '<div class="alert alert-danger" role="alert">There\'s No such ID</div>';
            redirectHome($theMsg);
            echo '</div>';
        }

		} elseif ($do == 'Update') {

            echo "<h2 class='text-center'>Update Category</h2>";
            echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // get variables from the Form
                $id         = $_POST['catid'];
                $name       = $_POST['name'];
                $desc       = $_POST['description'];
                $order      = $_POST['ordering'];
                $parent     = $_POST['parent'];
                $visible    = $_POST['visibility'];
                $comment    = $_POST['commenting'];
                $ads        = $_POST['ads'];
    
            // Update the database with this info
            $stmt = $con->prepare("UPDATE 
                                        categories 
                                    SET 
                                        `Name` = ?,
                                        `Description` = ?,
                                        parent = ?,
                                        Ordering = ?,
                                        Visibility = ?,
                                        Allow_comment = ?,
                                        Allow_Ads = ? 
                                    WHERE 
                                        ID = ?");
            $stmt->execute(array($name , $desc , $parent , $order  , $visible , $comment , $ads , $id));

            // echo success message 
            $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Updated</div>';
            redirectHome($theMsg, 'back');
    
            } else {
                $theMsg = "<div class='alert alert-danger' role='alert'>Sorry you cant browse this page directly</div>";
                redirectHome($theMsg);
            }
            echo "</div>";

		} elseif ($do == 'Delete') {

        // Delete Category page
        echo "<h2 class='text-center'>Delete Category</h2>";
        echo "<div class='container'>";
            // Check if get request catid Is Numeric & Get its integer value   
            $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']): 0;
            // check if Category exist in database
            $check = checkItem("ID", "categories", $catid);

            if($check > 0) {
                $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zid");
                $stmt->bindParam(":zid", $catid);
                $stmt->execute();
                $theMsg = "<div class='alert alert-success' role='alert'>" . $stmt->rowCount() . ' Record Deleted</div>';
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