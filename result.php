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
                            Result
                        </span>
                    </span>
                </div>

                <h2 class="m-txt6 respon1">
                    Result
                </h2>
            </div>
 
        </div>
    </div>
</section>

<!-- Content -->
<section class="bgwhite p-t-70 p-b-65">
    <div class="container">
        <!--  -->
        <div class="bg1 flex-sb-m flex-w p-t-7 p-b-7 p-r-6 p-l-28 m-b-40 p-lr-15-sm">
            <div class="pos-relative w-size8">
                <input class="size15 bo2 s-txt10 p-l-15 p-r-40" type="text" id="nic" name="nic" placeholder="ex: 962453058v">
                <button class="flex-c-m size16 ab-t-r fs-15 color5 hov-color-main trans-03">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <div class="flex-m flex-w p-t-10 p-b-10">
                <a href="#" onclick="getresult();" class="btn-drive size1 m-txt1 bg-main bo-rad-4 trans-03">
                    Search
                    <i class="fa fa-chevron-right m-l-9 fs-14"  aria-hidden="true"></i>
                </a>  
            </div>


            <div class="p-t-10 p-b-10">
                <!-- Button -->

            </div>
            <div class="p-t-10 p-b-10">
                <!-- Button -->

            </div>
            <div class="p-t-10 p-b-10">
                <!-- Button -->

            </div>
        </div>
        <div id="item_details"></div>

        <!-- Course list -->
        <div class="js-list dis-none">
            <div class="row">

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
<script>
    function GetXmlHttpObject() {
        var xmlHttp = null;
        try {
            // Firefox, Opera 8.0+, Safari
            xmlHttp = new XMLHttpRequest();
        } catch (e) {
            // Internet Explorer
            try {
                xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
        }
        return xmlHttp;
    }

    function getresult() {

        xmlHttp = GetXmlHttpObject();
        if (xmlHttp == null) {
            alert("Browser does not support HTTP Request");
            return;
        }

        var url = "result_data.php";
        url = url + "?Command=" + "getresult";
        url = url + "&nic=" + document.getElementById('nic').value;

        xmlHttp.onreadystatechange = res_getresult;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
    }



    function res_getresult() {
        var XMLAddress1;
        if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("getdata");
            document.getElementById('item_details').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
        }
    }

</script>