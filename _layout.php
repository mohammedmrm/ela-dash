<?php
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page ="";
}

?>
<?php include ("partials/_header-base-mobile.php"); ?>
<!-- begin:: Root -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <!-- begin:: Page -->
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <?php include("partials/_aside-base.php"); ?>
        <!-- begin:: Wrapper -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <?php include ("partials/_header-base.php" ); ?>
            <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                <?php
                  if(file_exists($page)){
                    include_once ($page);
                   }else{
                    include_once ("pages/dashboard.php" );
                  }
                 ?>
            </div>
            <?php include ("partials/_footer-base.php" ); ?>
        </div>
        <!-- end:: Wrapper -->
    </div>
    <!-- end:: Page -->
</div>
<!-- end:: Root -->
<!-- begin:: Topbar Offcanvas Panels -->
<?php include ("partials/_offcanvas-quick-actions.php" ); ?>
<!-- end:: Topbar Offcanvas Panels -->
<?php include("partials/_layout-quick-panel.php" ); ?>
<?php include("partials/_layout-scrolltop.php" ); ?>
<?php include("partials/_layout-demo-panel.php" ); ?>