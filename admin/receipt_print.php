<?php
session_start();
?> 
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Receipt</b></h3>
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
                    <div class="col-md-9">

                        <div class="form-group">
                            <label class="col-md-2" for="txt_usernm">Receipt No</label>
                            <div class="col-sm-3">
                                <input type="text" placeholder="Receipt No" disabled="" id="receiptno" class="form-control">
                            </div>
                            
                            <div class="col-sm-2"></div>
                            <label class="col-sm-2 " for="txt_usernm">Date</label>
                            <div class="col-sm-2">
                                <input type="text"  disabled="" value="<?php echo date('Y-m-d'); ?>"   id="sdate" class="form-control">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 " for="txt_usernm">Name</label>
                            <div class="col-sm-5">
                                <input type="text" disabled="" placeholder="Name" id="fname" class="form-control">
                            </div>
                            <div class="col-sm-1">
                                <a href="search_customer.php" onclick="NewWindow(this.href, 'mywin', '800', '700', 'yes', 'center');
                                        return false" onfocus="this.blur()">
                                    <input type="button" name="searchitem" id="searchitem" value="..." class="btn btn-primary btn-sm">
                                </a>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 " for="txt_usernm">Nic</label>
                            <div class="col-sm-4">
                                <input type="text" disabled="" placeholder="Nic" id="nic" class="form-control">
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-md-2" for="contact">Address</label>
                            <div class="col-md-4">
                                <textarea disabled="" style="resize: none" class="form-control" id="address" placeholder="Address"  rows="2"></textarea> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 " for="txt_usernm">Payment</label>
                            <div class="col-sm-3">
                                <input type="number" placeholder="Payment" id="payment" class="form-control">
                            </div> 
                        </div>

                        <div class="form-group">
                            <label class="col-md-2" for="contact">Note</label>
                            <div class="col-md-4">
                                <textarea style="resize: none" class="form-control" id="note" placeholder="Note"  rows="2"></textarea> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div id="lpaytable" class="well">

                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>

</section> 

<script src="js/receipt.js" type="text/javascript"></script>
<script>newent();</script>
