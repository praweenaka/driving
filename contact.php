<!-- ##### Header Area Start ##### -->
<?php include 'header.php'; ?>
<!-- ##### Header Area End ##### -->

<!-- Breadcrumb -->
<div class="bg1 p-t-29 p-b-29">
    <div class="container">
        <div class="flex-w">
            <span>
                <a href="index.html" class="s-txt21 hov-color-main trans-02">
                    <i class="fa fa-home"></i>
                    Home
                </a>
                <span class="s-txt21 p-l-6 p-r-9">/</span>
            </span>

            <span>
                <span class="s-txt21">
                    Contact
                </span>
            </span>
        </div>
    </div>
</div>

<!-- Content page -->
<section class="p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8 p-b-50">
                <div>
                    <h3 class="m-txt28 rs1-color p-b-40">
                        Send Us a Message
                    </h3>

                    <form id="contact-form" class="flex-w flex-sb validate-form" method="post" action="http://templates.aucreative.co/drive/includes/contact-form.php" name="contact" >
                        <div class=" size25 w-full-lg m-b-20 validate-input" data-validate = "Name is required">
                            <input class="s-txt31 size-full cl-ph-1 bo6 input-focus-1 bo-rad-2 p-l-18 p-r-18" type="text" name="name" placeholder="Your Name">
                        </div>

                        <div class=" size25 w-full-lg m-b-20 validate-input" data-validate = "Valid email is: ex@abc.xyz">
                            <input class="s-txt31 size-full cl-ph-1 bo6 input-focus-1 bo-rad-2 p-l-18 p-r-18" type="text" name="email" placeholder="Your Email">
                        </div>

                        <div class=" size25 w-full-lg m-b-20">
                            <input class="s-txt31 size-full cl-ph-1 bo6 input-focus-1 bo-rad-2 p-l-18 p-r-18" type="text" name="phone" placeholder="Phone number">
                        </div>

                        <div class="w-full m-b-20 validate-input" data-validate = "Message is required">
                            <textarea class="s-txt31 size22 cl-ph-1 bo6 input-focus-1 bo-rad-2 p-l-18 p-r-18 p-t-12" name="msg" placeholder="Your Message"></textarea>
                        </div>


                        <div>
                            <!-- Button -->
                            <button class="btn-drive m-txt1 size26 bg-main hov-color-white bo-rad-4">
                                Send EMail
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-5 col-lg-4 p-b-50">
                <div class="p-l-20 p-l-0-lg">
                    <h3 class="m-txt28 rs1-color p-b-35">
                        Contact Info
                    </h3>

<!--						<p class="s-txt2">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque metus arcu, malesuada a est eget, maximus efficitur sapien. 
                                                </p>-->

                    <ul class="p-t-26">
                        <li class="s-txt32 rs2-color p-b-10">
                            <i class="m-r-5 fa fa-home" aria-hidden="true"></i>
                            1st floor, Panchikawaththa, Sri Lanka
                        </li>

                        <li class="s-txt32 rs2-color p-b-10">
                            <i class="m-r-5 fa fa-phone" aria-hidden="true"></i>
                            011-1515155
                        </li>

                        <li class="s-txt32 rs2-color p-b-10">
                            <i class="m-r-5 fa fa-fax" aria-hidden="true"></i>
                            011-1515155
                        </li>

                        <li class="s-txt32 rs2-color p-b-10">
                            <i class="m-r-5 fa fa-envelope-o" aria-hidden="true"></i>
                            learners@gmail.com
                        </li>

                        <li class="s-txt32 rs2-color p-b-10">
                            <i class="m-r-5 fa fa-clock-o" aria-hidden="true"></i>
                            Mon-Fri 09:00 - 17:00
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Map -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.657507409508!2d79.8622248642678!3d6.931476470210174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2590541e8f747%3A0x65132a18a4946ffc!2sPanchikawatta%2C+Colombo+01000!5e0!3m2!1sen!2slk!4v1554953590708!5m2!1sen!2slk" width="100%" height="390" frameborder="0" style="border:0" allowfullscreen></iframe>
    <!--		<div class="contact-map h-size1" id="google_map" data-map-x="40.648578" data-map-y="-73.962730" data-pin="images/icons/favicon.png" data-scrollwhell="0" data-draggable="1"  data-zoom="15"></div>-->
</div>



<!-- ##### Footer Area Start ##### -->
<?php include 'footer.php'; ?>
<!-- ##### Footer Area End ##### -->
<!-- Back to top -->
<div class="btn-back-to-top hov-bg-main" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
    </span>
</div>
