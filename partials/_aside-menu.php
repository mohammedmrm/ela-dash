<?php
if(!isset($_SESSION)){
  session_start();
}
$se = $_SESSION['role'];
?>
<style>
.kt-menu__toggle{
 background-color: #11114F !important;
}

</style>
<!-- begin:: Aside Menu -->
<input type="hidden" value="<?php if(isset($_GET['page'])){echo $_GET['page'];}?>" id="page">
<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu"class="kt-aside-menu "data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500" >
        <ul class="kt-menu__nav ">
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--open kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon fa fa-box-open"></i><span class="kt-menu__link-text">اضافه و تحديث</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu ">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                      <?php  if($se == 99){?>
                       <li class="kt-menu__item" aria-haspopup="true">
                          <a href="?page=pages/addorder.php" class="kt-menu__link ">
                              <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                              <span class="kt-menu__link-text">اضافة طلب</span>
                          </a>
                      </li>
                      <?php } ?>
                      <?php  if($se == 1 || $se == 2 || $se == 3 || $se == 5 || $se=6){?>
                      <li class="kt-menu__item " aria-haspopup="true">
                          <a href="?page=pages/addorders-dev.php" class="kt-menu__link ">
                              <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                              <span class="kt-menu__link-text">اضافة</span>
                          </a>
                      </li>
                      <?php } ?>
                      <?php  if($se == 99){?>
                       <li class="kt-menu__item" aria-haspopup="true">
                          <a href="?page=pages/editDeleteOrder.php" class="kt-menu__link ">
                              <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                              <span class="kt-menu__link-text">حذف او تعديل طلبية</span>
                          </a>
                      </li>
                       <?php } ?>
                       <?php  if($se == 1 || $se == 2 || $se == 3 || $se == 5){?>
                        <li class="kt-menu__item" aria-haspopup="true"
                             >
                            <a href="?page=pages/ordersActions.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">تعديل الطلبيات</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--open kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-graphic"></i><span class="kt-menu__link-text">التقارير</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu ">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
<!--                        <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true" >
                            <span class="kt-menu__link"><span class="kt-menu__link-text">احصائيات</span></span>
                        </li>-->
                        <?php  if($se==99){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/dashborad.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">لوحة الاحصاء</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==1 || $se==2 || $se==3 || $se==5){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/reports.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">تقرير الطلبيات</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==1 || $se==2 || $se==3 || $se==5){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/invoices.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">كشوفات العملاء</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==1 || $se==2 || $se==3 || $se==5){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/driverInvoices.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">كشوفات السواق</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==1 || $se==2 || $se==5){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/earnings.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">تقرير الارباح</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==1 || $se==2 || $se==5){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/returnedToCityStore.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">ادخال رواجع المحافظات</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==99){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/returned.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">تقرير رواجع</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==99){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/posponded.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">تقرير مؤجل</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--open kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-settings"></i><span class="kt-menu__link-text">العملاء</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu ">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true" >
                            <span class="kt-menu__link"><span class="kt-menu__link-text flaticon2-settings">العملاء</span></span>
                        </li>
                        <?php  if($se==1 || $se==2 || $se==3 || $se==5){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/clients.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">قائمه العملاء</span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/clientsDetails.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">تفاصيل العملاء</span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/stores.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">الاسواق (الصفحات)</span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/receipt.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">طلبات الوصولات</span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/companyReceipt.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">طباعه وصولات للشركات</span>
                            </a>
                        </li>
                        <?php } ?>
                     </ul>
                </div>
            </li>
            <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--here" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-settings"></i><span class="kt-menu__link-text">الاعدادات</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                <div class="kt-menu__submenu ">
                    <span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                        <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true" >
                            <span class="kt-menu__link"><span class="kt-menu__link-text flaticon2-settings">الاعدادات</span></span>
                        </li>
                        <?php  if($se==1 || $se==5){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/branches.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">الفروع</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==1 || $se==2 || $se==3 || $se==5){?>
                        <li class="kt-menu__item" aria-haspopup="true" >
                            <a href="?page=pages/towns.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">الاقضية والنواحي والاحياء</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==1 || $se==2 || $se==5){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/staff.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">الموظفين</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==1){?>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/emergencyAccoutn.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">حسابات طؤارى</span>
                            </a>
                        </li>
                        <li class="kt-menu__item " aria-haspopup="true" >
                            <a href="?page=pages/companies.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">الشركات</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php  if($se==1 || $se==5){?>
                        <li class="kt-menu__item" aria-haspopup="true"
                            data-toggle="kt-tooltip" title="" data-placement="top" data-original-title="عرض وتعديل حالات الطلب"
                                                   >
                            <a href="?page=pages/orderStatus.php" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                <span class="kt-menu__link-text">الحالات</span>
                            </a>
                        </li>
                        <?php } ?>
                     </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- end:: Aside Menu -->

<script type="text/javascript">
page = $("#page").val();
if(page != ""){
    $("#aside_menu i").removeClass("kt-menu__item--active");
    $("[href='?page="+page+"']").parent().addClass("kt-menu__item--active");
}else{
    $("[href='index.php']").parent().addClass("kt-menu__item--active");
}
</script>