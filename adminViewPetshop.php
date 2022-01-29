<?php
include 'admininclude/verifyLogin.php';
include "admininclude/functions.php";
$_SESSION['NavActive']="adminPetshop";

?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include 'admininclude/headScripts.php';
?>
</head>

<body class="sidebar-menu-collapsed">
    <section>

        <!-- Side bar -->
        <?php
        include 'admininclude/sidebar.php';
        ?>
        <!-- //Side bar -->

        <!-- Navbar -->
        <?php
        include 'admininclude/navbar.php';
        ?>
        <!-- //Navbar -->


        <!-- main content start -->

        <!-- main content end-->
    </section>
    <!--footer section start-->
    <?php
    include 'admininclude/footer.php';
    ?>
    <!--footer section end-->
    <!-- move top -->
    <button onclick="topFunction()" id="movetop" class="bg-primary" title="Go to top">
        <span class="fa fa-angle-up"></span>
    </button>
</body>

</html>
<?php
    include 'admininclude/buttomScripts.php';
?>