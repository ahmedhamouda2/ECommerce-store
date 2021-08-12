<?php
session_start();
$pageTitle = 'Create New Item';
include 'init.php';
if (isset($_SESSION['user'])) {
    $getUser = $con->prepare("SELECT * FROM users WHERE Username = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();
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
                                        <input type="username" name="name" class="form-control live" autocomplete="off" required placeholder="Name of Item" data-class=".live-title">
                                    </div>
                                </div>
                                <!-- End Name field -->
                                <!-- start Description field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Description</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="username" name="description" class="form-control live" autocomplete="off" required placeholder="Describe the Item" data-class=".live-desc">
                                    </div>
                                </div>
                                <!-- End Description field -->
                                <!-- start price field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Price</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="username" name="price" class="form-control live" autocomplete="off" required placeholder="Price the Item" data-class=".live-price">
                                    </div>
                                </div>
                                <!-- End price field -->
                                <!-- start country field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Country</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input type="username" name="country" class="form-control" autocomplete="off" required placeholder="Country of Made">
                                    </div>
                                </div>
                                <!-- End country field -->
                                <!-- start status field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Status</label>
                                    <div class="col-sm-10 col-md-9">
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
                                <!-- start categories field -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label d-flex justify-content-sm-end">Category</label>
                                    <div class="col-sm-10 col-md-9">
                                        <select name="category">
                                            <option value="0">...</option>
                                            <?php
                                            $stmt2 = $con->prepare("SELECT * FROM categories");
                                            $stmt2->execute();
                                            $cats = $stmt2->fetchAll();
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
                                    <div class="d-flex justify-content-around">
                                        <button type="button" class="btn btn-light price-tag">$<span class="live-price">0</span></button>
                                        <a href="#" class="btn btn-primary">See More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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