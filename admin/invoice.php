<?php
session_start();
?> 
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Invoice</b></h3>
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
                    <a onclick="print_inv();" class="btn btn-primary  ">
                        <span class="fa fa-print"></span> &nbsp; Print
                    </a>

                    <a onclick="cancel_inv();" class="btn btn-danger  ">
                        <span class="fa fa-trash"></span> &nbsp; Cancel
                    </a>


                </div>
                <div class="form-group"></div>
                <div class="form-group"></div>
                <div id="msg_box"  class="span12 text-center"  ></div>

                <div class="form-group">
                    <label class="col-md-2" for="txt_usernm">Invoice No</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Invoice No" disabled="" id="invoiceno" class="form-control">
                    </div>
                    <div class="col-sm-1">
                        <a href="search_invoice.php" onclick="NewWindow(this.href, 'mywin', '800', '700', 'yes', 'center');
                                return false" onfocus="this.blur()">
                            <input type="button" name="searchitem" id="searchitem" value="..." class="btn btn-primary btn-sm">
                        </a>
                    </div>
                    <div class="col-sm-1"></div>
                    <label class="col-sm-2 " for="txt_usernm">Applied Date</label>
                    <div class="col-sm-2">
                        <input type="text"  disabled="" value="<?php echo date('Y-m-d'); ?>"   id="sdate" class="form-control">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 " for="txt_usernm">Applicant For</label>
                    <div class="col-sm-1">
                        <input type="checkbox" id="appli_new">New 
                    </div> 
                    <div class="col-sm-1">
                        <input type="checkbox" id="appli_extnd">Extend
                    </div>
                    <div class="col-sm-1">
                        <input type="checkbox" id="appli_renwl">Renewal
                    </div> 
                    <div class="col-sm-1">
                        <input type="checkbox" id="appli_dup">Duplicate
                    </div>
                    <div class="col-sm-2">
                        <input type="checkbox" id="appli_conv">Conversion
                    </div> 
                    <div class="col-sm-2">
                        <input type="checkbox" id="appli_extnd_p">Extend(Public Transport)
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 " for="txt_usernm">Application Type</label>
                    <div class="col-sm-1">
                        <input type="checkbox" id="nomal">Normal 
                    </div> 
                    <div class="col-sm-2">
                        <input type="checkbox" id="sm_day">Same Day 
                    </div> 
                </div> 
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">ID Type</label>
                    <div class="col-sm-1">
                        <input type="checkbox" id="nic_ty">Nic 
                    </div> 
                    <div class="col-sm-2">
                        <input type="checkbox" id="sp_ty">Srilanka Passport 
                    </div> 
                    <div class="col-sm-2">
                        <input type="checkbox" id="fp_ty">Foreign Passport 
                    </div> 
                    <div class="col-sm-2">
                        <input type="checkbox" id="dp_tp">Diplomatic Passport 
                    </div>  
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Surname</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Surname" id="sname" class="form-control">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Other Name</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Other Name" id="oname" class="form-control">
                    </div> 
                    <label class="col-sm-2" for="txt_usernm">Nic</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Nic" id="nic" class="form-control">
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Name To Be Printed Change</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Name To Be Printed Change" id="namepchange" class="form-control">
                    </div> 
                    <label class="col-sm-2" for="txt_usernm">Name To Be Printed On Card</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Name To Be Printed On Card" id="nameocard" class="form-control">
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-2 " for="txt_usernm">Sex</label>
                    <div class="col-sm-1">
                        <input type="checkbox" id="male">Male 
                    </div> 
                    <div class="col-sm-2">
                        <input type="checkbox" id="female">Female
                    </div> 
                    <label class="col-sm-2" for="txt_usernm">Country</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Country" id="country" class="form-control">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Date Of Birth</label>
                    <div class="col-sm-3">
                        <input type="datetime"  id="dob" class="form-control dt">
                    </div> 
                    <label class="col-sm-2" for="txt_usernm">Age</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Age" id="age" class="form-control">
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Parmanent Address</label>
                    <div class="col-sm-3">
                        <textarea style="resize: none" class="form-control" id="paddress" placeholder="Parmanent Address"  rows="2"></textarea> 
                    </div> 
                    <label class="col-sm-2" for="txt_usernm">Postal Code</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Postal Code" id="pos_code" class="form-control">
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Contact</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Contact" id="contact" class="form-control">
                    </div> 
                    <label class="col-sm-2" for="txt_usernm">Divisional Secretariat</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Divisional Secretariat" id="divisec" class="form-control">
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Driver Restrictions</label>
                    <div class="col-sm-1">
                        <input type="checkbox" id="dr_none">None 
                    </div> 
                    <div class="col-sm-2">
                        <input type="checkbox" id="dr_colen">Corrective Lenses 
                    </div> 
                    <div class="col-sm-2">
                        <input type="checkbox" id="dr_artilim">Artificial Limb
                    </div> 
                    <div class="col-sm-2">
                        <input type="checkbox" id="dr_parap">Paraplegic/Handicapped
                    </div>  
                    <div class="col-sm-1">
                        <input type="checkbox" id="dr_oneye">One Eye
                    </div>  
                    <div class="col-sm-1-6">
                        <input type="checkbox" id="dr_hea_aid">Hearing Aid
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Height</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Ft" id="ft" class="form-control">
                    </div> 
                    <div class="col-sm-3">
                        <input type="text" placeholder="Inches" id="inches" class="form-control">
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Blood Group</label>
                    <div class="col-sm-3">
                        <select id="blod_grp" class="form-control">
                            <option value="None">None</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>  
                    <label class="col-sm-2 " for="txt_usernm">Organ Donor</label>
                    <div class="col-sm-1">
                        <input type="checkbox" id="or_yes">Yes 
                    </div> 
                    <div class="col-sm-2">
                        <input type="checkbox" id="or_no">No
                    </div> 
                </div> 
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Visa No</label>
                    <div class="col-sm-3">
                        <input type="text" placeholder="Visa No" id="visano" class="form-control">
                    </div> 
                    <label class="col-sm-2 " for="txt_usernm">Visa Expiry Date</label>
                    <div class="col-sm-3">
                        <input type="text"   id="visaex_date" class="form-control dt">
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-2 " for="txt_usernm">Full Payment</label>
                    <div class="col-sm-3">
                        <input type="number" placeholder="Full Payment" id="tot" class="form-control">
                    </div>
                    <label class="col-sm-2 " for="txt_usernm">Advance</label>
                    <div class="col-sm-2">
                        <input type="number" placeholder="Advance" id="advance" class="form-control">
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="txt_usernm">Driving Licence Class</label>
                    <div class="col-sm-4">
                        <select name="user_name" id="drivi_class"   class="form-control input-sm">
                            <option value=""></option>
                            <?php
                            require_once("./connection_sql.php");

                            $sql = "Select * from driving_class  where active ='0'";
//                            echo $sql;
                            foreach ($conn->query($sql) as $row) {
                                echo "<option value='" . $row["code"] . "'>" . $row["code"] . " - " . $row["name"] . "</option>";
                            }
                            ?>
                        </select>
                    </div> 
                    <label class="col-sm-2 " for="txt_usernm">Training Date</label>
                    <div class="col-sm-2">
                        <input type="text"   id="train_date" class="form-control dt">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2" for="contact">Note</label>
                    <div class="col-md-4">
                        <textarea style="resize: none" class="form-control" id="note" placeholder="Note"  rows="2"></textarea> 
                    </div> 
                </div>

                <div class="form-group" id="filup" style="visibility: visible;">
                    <label class="col-sm-2" for="file-3">Image</label>&nbsp;&nbsp;&nbsp;
                    <label class="btn btn-default" for="file-3">
                        <input id="file-3" onchange="readURL(this);" name="file-3" multiple="true" type="file">
                        Select Files

                    </label>
                    <a class="btn btn-primary" onclick="imgup('img');">Upload</a>
                </div>
                <div class="form-group" >
                    <label class="col-md-2" for="contact"> </label>&nbsp;&nbsp;&nbsp;
                    <img id="blah" src="http://placehold.it/180" style="width: 300px;height: 300px;" alt="your image" />
                </div>

            </div>
        </form>
    </div>

</section> 
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                        .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<style>
    img{
        max-width:280px;
    }
    input[type=file]{
        padding:10px;
        background:white;}
</style>
<script src="js/invoice.js" type="text/javascript"></script>
<script>newent();</script>
