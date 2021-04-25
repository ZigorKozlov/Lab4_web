<?php

require "Templates/header.php";

if(isset($_SESSION['auth']))
{
    unset($_SESSION["auth"]);
}

echo "<script>document.location.href=\"index.php/\";</script>";

require "Templates/footer.php";