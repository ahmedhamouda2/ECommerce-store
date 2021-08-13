<?php
    session_start();
    $pageTitle = 'Show Items';
    include 'init.php';
    $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']): 0;
    // check if user exist in database
    $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ?");
    $stmt->execute(array($itemid));
    $item = $stmt->fetch();

?>
    <h2 class="text-center"><?php echo $item['Name']?></h2>

<?php 
    include $tpl . 'footer.php';
?>