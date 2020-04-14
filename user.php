<?php 
    include 'include/management.php';
    //dynamic title
    function here($where) {
        if ($where == "title") {
            return $_SESSION["user_info"]["Name"] . "'s Porfile";
        } elseif ($where == "nav") {
            return "Your Porfile";
        }
    }
?>
<section>
</section>
<?php 
    include 'include/footer.php';
?>