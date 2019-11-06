<!-- needs to be given css - Gabriel -->

<?php

function paginate() {

    session_start();
    if (!isset($_SESSION['username'])) {
        echo "<script>alert('Please login first!')</script>";
        echo "<script>window.open('../pages/login.php','_self')</script>";
        exit();
    }
    require 'db.php';

    $logged_on = $_SESSION['username'];
    try {
        $stmt = $conn->query("SELECT * FROM feed WHERE username= '$logged_on' LIMIT 5");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();      //dont need for final?
        echo "<script>alert('SQL ERROR: 1')</script>";
    }
    if (!$posts) {
        echo "<h2>No posts to view here yet!</h2>";
        exit();
    }
    foreach ($posts as $row) {
        $encoded_image = base64_encode($row['img']);
        $display = "<img src='data:image/jpeg;base64,{$encoded_image}' width='40%' height='40%' >";
        echo "<h4>@" . $row['username'] . "</h4>";
        echo $display;
        echo "<h4>Likes " . $row['likes'] . "</h4>";
        echo "<h4>Comments " . $row['comments'] . "</h4>";
        echo "<i>Posted " . $row['upload_date'] . "</i>";
        echo '<hr />';
    }
    $conn = NULL;    
}
?>

<!-- needs testing infinite scrolling -->

<script type="text/javascript">
    window.addEventListener('scroll', function() {
        if (window.scrollY + window.innerHeight + 100 >= document.documentElement.scrollHeight) {
            <?php paginate(); ?>
        }
    })
</script>