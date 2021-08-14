<?php
session_start();
$pageTitle = 'Create New Item';
include 'init.php';
if (isset($_SESSION['user'])) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formErrors = array();
        $name       = filter_var($_POST['name'] , FILTER_SANITIZE_STRING);
        $desc       = filter_var($_POST['description'] , FILTER_SANITIZE_STRING);
        $price      = filter_var($_POST['price'] , FILTER_SANITIZE_NUMBER_INT);
        $country     = filter_var($_POST['country'] , FILTER_SANITIZE_STRING);
        $status     = filter_var($_POST['status'] , FILTER_SANITIZE_NUMBER_INT);
        $category   = filter_var($_POST['category'] , FILTER_SANITIZE_NUMBER_INT);
        if(strlen($name) < 4) {
            $formErrors[] = 'Item title must be at least <strong>4</strong> characters';
        }
        if(strlen($desc) < 10) {
            $formErrors[] = 'Item description must be at least <strong>10</strong> characters';
        }
        if(strlen($country) < 2) {
            $formErrors[] = 'Country must be at least <strong>2</strong> characters';
        }
        if(empty($price)) {
            $formErrors[] = 'Item price must be not empty';
        }
        if(empty($status)) {
            $formErrors[] = 'Item status must be not empty';
        }
        if(empty($category)) {
            $formErrors[] = 'Item category must be not empty';
        }
        // check if there no error proceed the update operation
        if(empty($formErrors)){
            // Insert item info in database
            $stmt = $con->prepare("INSERT INTO items(`Name` , `Description` , Price , Country_Made ,`Status` , Add_Date , Cat_ID , Member_ID) VALUES(:zname , :zdesc , :zprice , :zcountry , :zstatus , now() , :zcat , :zmember)");
            $stmt->execute(array(
                'zname' => $name,
                'zdesc' => $desc,
                'zprice' => $price,
                'zcountry' => $country,
                'zstatus' => $status,
                'zcat' => $category,
                'zmember' => $_SESSION['uid']
            ));

            // echo success message
            if($stmt) {
                $successMsg = 'Item <strong>Success</strong>added';
            }
        }
    }

?>
    <h2 class="text-center"><?php echo $pageTitle ?></h2>
    <div class="create-ad block">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <?php echo $pageTitle ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="main-form">
                                <!-- start Name field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Name</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" pattern=".{4,}" title="Require at least 4 characters" name="name" class="form-control live" autocomplete="off" required placeholder="Name of Item" data-class=".live-title">
                                    </div>
                                </div>
                                <!-- End Name field -->
                                <!-- start Description field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Description</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" pattern=".{10,}" title="Require at least 10 characters" name="description" class="form-control live" autocomplete="off" required placeholder="Describe the Item" data-class=".live-desc">
                                    </div>
                                </div>
                                <!-- End Description field -->
                                <!-- start price field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Price</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="price" class="form-control live" autocomplete="off" required placeholder="Price the Item" data-class=".live-price">
                                    </div>
                                </div>
                                <!-- End price field -->
                                <!-- start country field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Country</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="text" name="country" class="form-control" autocomplete="off" required placeholder="Country of Made">
                                    </div>
                                </div>
                                <!-- End country field -->
                                <!-- start status field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Status</label>
                                    <div class="col-sm-10 col-md-9">
                                        <select name="status" required>
                                            <option value="">...</option>
                                            <option value="1">New</option>
                                            <option value="2">Like New</option>
                                            <option value="3">Used</option>
                                            <option value="4">Very Old</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- End status field -->
                                <!-- start categories field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Category</label>
                                    <div class="col-sm-10 col-md-9">
                                        <select name="category" required>
                                            <option value="">...</option>
                                            <?php
                                            $cats = getAllFrom('categories', 'ID');
                                            foreach ($cats as $cat) {
                                                echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- End categories field -->
                                <!-- start submit -->
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <input type="submit" value="Add Item" class="btn btn-primary btn-sm">
                                    </div>
                                </div>
                                <!-- end submit -->
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="card live-preview">
                                <img class="card-img-top img-fluid" src="https://picsum.photos/250" alt="Card image">
                                <div class="card-body" style="border:none;">
                                    <h4 class="card-title live-title">Title</h4>
                                    <p class="card-text live-desc">Description</p>
                                    <span class="price">$<span class="live-price">0</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- start looping through errors -->
                    <?php
                        if(!empty($formErrors)){
                            foreach($formErrors as $error) {
                                echo '<div class="alert alert-danger">' . $error . '</div>';
                            }
                        }
                        if(isset($successMsg)){
                            echo '<div class="alert alert-success">' . $successMsg . '</div>';
                        }
                    ?>
                    <!-- end looping through errors -->
                </div>
            </div>
        </div>
    </div>

<?php
} else {
    header('location:login.php');
    exit();
}
include $tpl . 'footer.php';
?>