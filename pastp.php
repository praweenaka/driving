<!-- ##### Header Area Start ##### -->
<?php include 'header.php'; ?>
<!-- ##### Header Area End ##### -->
<!-- Title page -->
<section class="bg-img-1 bg-overlay-3 p-t-93 p-b-95" style="background-image: url('images/bg-title-01.jpg');">
    <div class="container">
        <div class="flex-w flex-sb-m">
            <div class="p-t-10 p-b-10 p-r-30">
                <div class="flex-w p-b-9">
                    <span>
                        <a href="index.html" class="s-txt19 hov-color-main trans-02">
                            <i class="fa fa-home"></i>
                            Home
                        </a>
                        <span class="s-txt19 p-l-6 p-r-9">/</span>
                    </span>

                    <span>
                        <span class="s-txt19">
                            Our Courses
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    Our Courses
                </h2>
            </div>

            <div class="p-t-10 p-b-10">
                <!-- Button -->
                <a href="#" class="btn-drive size1 m-txt1 bg-main bo-rad-4 trans-03">
                    Book Lesson
                    <i class="fa fa-chevron-right m-l-9 fs-14" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Content -->
<section class="bgwhite p-t-70 p-b-65">
    <div class="container">


        <!-- Course grid -->
        <div class="js-grid">
            <div class="row"> 
                <!--<div class="col-sm-6 col-lg-3 p-b-40">-->
                <?php
                header('Content-Type: text/xml');

                include './admin/connectioni.php';
                $content = "";

                $sql = "select * from docs order by id desc  ";
                $result_v = mysqli_query($GLOBALS['dbinv'], $sql);
                while ($row2 = mysqli_fetch_array($result_v)) {
                    $filetype = pathinfo($row2['loc'], PATHINFO_EXTENSION);
                    $filetype = "application/" . $filetype;

                    $content = "
                    <div class='col-sm-6  '>
                    
                        <div class='block-3 bo2'>
                            <div class='wrap-pic-b3 wrap-pic-w hov5 bo2-b'>

                                 <object width='580px' height='360px' type='" . $filetype . "' data='" . $row2['loc'] . "'>
                            <div  class='file-preview-other '>

                            </div>
                        </object>  
                        </div>
                        <div class='wrap-text-b3 p-l-20 p-r-20 p-t-16 p-b-26'>                                                        
                            <a href='" . $row2['loc'] . "' download='" . $row2['file_name'] . "'><h4 class='m-txt8 hov-color-main trans-04 p-b-12'>
                                   " . $row2['file_name'] . "
                                </h4></a> 
                            <div class='wrap-btn-b3 flex-w p-t-13'>
                                 <div class='m-r-8 p-t-8'>
                                  
                                    <a href='" . $row2['loc'] . "' download='" . $row2['file_name'] . "' class='btn-drive m-txt1 size3 bg-main hov-color-white bo-rad-4'>
                                        Download now
                                    </a>
                                </div> 
                            </div>

                        </div>
                    </div>
                </div>
                
                                         
                      
                   
             ";
                    echo $content;
                }
                ?>


                <!--</div>-->
            </div>
        </div>
    </div>
</section>

<!-- ##### Footer Area Start ##### -->
<?php include 'footer.php'; ?>
<!-- ##### Footer Area End ##### -->
<!-- Back to top -->
<div class="btn-back-to-top hov-bg-main" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </span>
</div>
<!-- <div width='160px' class='file-thumbnail-footer '>
                        <div  title='" . $row2['file_name'] . "' style=\"margin-top:10px;\"  class='file-footer-caption'>" . $row2['file_name'] . "</div>
                        <div  title='" . $row2['c_date'] . "' style=\"margin-top:10px;\"  class='file-footer-caption'>" . $row2['c_date'] . "</div>
                        <div  class='file-actions'>
                            <div class='file-footer-buttons '>
                                
                                <a href='" . $row2['loc'] . "' download='" . $row2['file_name'] . "'><i class='glyphicon glyphicon glyphicon-save-file'></i></a>
                                <a onclick='removefile(" . $row2['id'] . ")'><i class='glyphicon glyphicon glyphicon-trash'></i></a>
                                <div class='col-md-12'> 
                                    <label class=\"col-sm-2\">" . $row['c_date'] . "</label>;
                                </div>
                            </div>
                             
                        </div>
                    </div>-->