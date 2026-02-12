<?php
include "partials/header.php";
include "partials/navigation.php";

if(!is_user_logged_in()){
    redirect("login.php");
}
?>



<h1 style="text-align:center">This is dashboard</h1>

<?php
    include "partials/footer.php";
?>