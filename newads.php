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
            $country    = filter_var($_POST['country'] , FILTER_SANITIZE_STRING);
            $status     = filter_var($_POST['status'] , FILTER_SANITIZE_NUMBER_INT);
            $category   = filter_var($_POST['category'] , FILTER_SANITIZE_NUMBER_INT);
            $tags       = filter_var($_POST['tags'] , FILTER_SANITIZE_STRING);
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
                $stmt = $con->prepare("INSERT INTO 
                                            items(`Name` , `Description` , Price , Country_Made ,`Status` , Add_Date , Cat_ID , Member_ID , tags) 
                                        VALUES(:zname , :zdesc , :zprice , :zcountry , :zstatus , now() , :zcat , :zmember , :ztags)");
                $stmt->execute(array(
                    'zname'     => $name,
                    'zdesc'     => $desc,
                    'zprice'    => $price,
                    'zcountry'  => $country,
                    'zstatus'   => $status,
                    'zcat'      => $category,
                    'zmember'   => $_SESSION['uid'],
                    'ztags'     => $tags
                ));

                // echo success message
                if($stmt) {
                    $successMsg = 'Item <strong>Success</strong>added';
                }
            }
        }

    ?>
        <h2 class="text-center"><?php echo $pageTitle ?></h2>
        <section class="create-ad block">
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
                                        <label for="name" class="col-sm-3 col-form-label d-flex justify-content-sm-end">Name</label>
                                        <div class="col-sm-10 col-md-9">
                                            <input id="name" type="text" pattern=".{4,}" title="Require at least 4 characters" aria-describedby="Name-length-error" aria-invalid="true" name="name" class="form-control live" autocomplete="off" required aria-required="true" placeholder="Name of Item" aria-label="Name of Item" data-class=".live-title">
                                        </div>
                                    </div>
                                    <!-- End Name field -->
                                    <!-- start Description field -->
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 col-form-label d-flex justify-content-sm-end">Description</label>
                                        <div class="col-sm-10 col-md-9">
                                            <input id="description" type="text" pattern=".{10,}" aria-describedby="Description-length-error" aria-invalid="true" title="Require at least 10 characters" name="description" class="form-control live" autocomplete="off" required aria-required="true" placeholder="Describe the Item" aria-label="Describe the Item" data-class=".live-desc">
                                        </div>
                                    </div>
                                    <!-- End Description field -->
                                    <!-- start price field -->
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-3 col-form-label d-flex justify-content-sm-end">Price</label>
                                        <div class="col-sm-10 col-md-9">
                                            <input id="price" type="text" name="price" class="form-control live" autocomplete="off" required aria-required="true" placeholder="Price the Item" aria-label="Price the Item" data-class=".live-price">
                                        </div>
                                    </div>
                                    <!-- End price field -->
                                    <!-- start country field -->
                                    <div class="form-group row">
                                        <label for="country" class="col-sm-3 col-form-label d-flex justify-content-sm-end">Country</label>
                                        <div class="col-sm-10 col-md-9">
                                            <input id="country" type="text" name="country" class="form-control" autocomplete="off" required aria-required="true" placeholder="Country of Made" aria-label="Country of Made">
                                        </div>
                                    </div>
                                    <!-- End country field -->
                                    <!-- start status field -->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label d-flex justify-content-sm-end" for="Status">Status</label>
                                        <div class="col-sm-10 col-md-9">
                                            <select name="status" required aria-required="true" aria-label="Status" id="Status">
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
                                        <label class="col-sm-3 col-form-label d-flex justify-content-sm-end" for="Category">Category</label>
                                        <div class="col-sm-10 col-md-9">
                                            <select name="category" required aria-label="Category" id="Category" aria-required="true">
                                                <option value="">...</option>
                                                <?php
                                                $cats = getAllFrom('*','categories','','', 'ID');
                                                foreach ($cats as $cat) {
                                                    echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End categories field -->
                                    <!-- start Tags field -->
                                    <div class="form-group row">
                                        <label for="tags" class="col-sm-3 col-form-label d-flex justify-content-sm-end">Tags</label>
                                        <div class="col-sm-10 col-md-9">
                                            <input id="tags" type="text" name="tags" class="form-control" placeholder="separator tags with comma ( , )" aria-label="separator tags with comma ( , )">
                                        </div>
                                    </div>
                                    <!-- End Tags field -->
                                    <!-- start submit -->
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-9">
                                            <input type="submit" value="Add Item" class="btn btn-primary btn-sm" role="button">
                                        </div>
                                    </div>
                                    <!-- end submit -->
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="card live-preview">
                                    <img class="card-img-top img-fluid" src="https://picsum.photos/250" alt="Card image">
                                    <div class="card-body border-0">
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
                                    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                                }
                            }
                            if(isset($successMsg)){
                                echo '<div class="alert alert-success" role="alert">' . $successMsg . '</div>';
                            }
                        ?>
                        <!-- end looping through errors -->
                    </div>
                </div>
            </div>
        </section>

    <?php
    } else {
        header('location:login.php');
        exit();
    }
    include $tpl . 'footer.php';
?>
