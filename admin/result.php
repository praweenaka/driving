<?php
session_start();
?> 
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Result Update</b></h3>
            <h4 style="float: right;height: 3px;"><b id="time"></b></h4> 
        </div>
        <form name= "form1" role="form" class="form-horizontal">

            <div class="box-body">

                <input type="hidden" id="uniq" class="form-control">

                <input type="hidden" id="item_count" class="form-control">
                <div class="form-group">

                    <a onclick="newent();" class="btn btn-default  ">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>

                    <a onclick="save_inv();" class="btn btn-success  ">
                        <span class="fa fa-save"></span> &nbsp; Save
                    </a>

                    <a onclick="cancel_inv();" class="btn btn-danger  ">
                        <span class="fa fa-trash"></span> &nbsp; Cancel
                    </a>


                </div>
                <div class="form-group"></div>
                <div class="form-group"></div>
                <div id="msg_box"  class="span12 text-center"  ></div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="col-md-1" for="txt_usernm">Result No</label>
                            <div class="col-sm-2">
                                <input type="text" placeholder="Result No" disabled="" id="resultno" class="form-control">
                            </div>
                            <div class="col-sm-1">
                                <a href="search_result.php" onclick="NewWindow(this.href, 'mywin', '800', '700', 'yes', 'center');
                                        return false" onfocus="this.blur()">
                                    <input type="button" name="searchitem" id="searchitem" value="..." class="btn btn-primary btn-sm">
                                </a>
                            </div>
                            <div class="col-sm-2"></div>


                        </div> 
                        <div class="form-group">
                            <label class="col-sm-1 " for="txt_usernm">Nic</label>
                            <div class="col-sm-3">
                                <input type="text"  placeholder="Nic" id="nic" class="form-control">
                            </div>
                            <div class="col-sm-1">
                                <input type="number"  placeholder="Mark" id="mark" class="form-control">
                            </div>

                            <div class="col-sm-2">
                                <select id="action" class="form-control">
                                    <option value="Pass">Pass</option>
                                    <option value="Fail">Fail</option> 
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="button" name="additem_tmp" id="additem_tmp" value="Add" onclick="add_item();" class="btn btn-primary">
                                </a>
                            </div>
                        </div>

                        <div id="itemdetails"  ></div>

                    </div>


                </div>
        </form>
    </div>

</section> 

<script src="js/result.js" type="text/javascript"></script>
<script>newent();

function add_item()
{

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }

    if (document.getElementById('nic').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Plz Type Nic..</span></div>";
        return false;
    }

    var url = "result_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";

    url = url + "&resultno=" + document.getElementById('resultno').value;
    url = url + "&nic =" + document.getElementById('nic').value;
    url = url + "&mark =" + document.getElementById('mark').value;
    url = url + "&action=" + document.getElementById('action').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
 
    document.getElementById('msg_box').innerHTML = "";

    xmlHttp.onreadystatechange = re_add_item;

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}


function re_add_item()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

        document.getElementById('nic').value = "";
         document.getElementById('mark').value = "";
        document.getElementById('nic').focus();

    }
}

 

</script>
