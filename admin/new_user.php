 
<script type="text/javascript" src="webcam.js"></script> 

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">New User</h3>
        </div>
        <form role="form" class="form-horizontal">
            <div class="box-body">

                <div class="form-group">
                    <a onclick="new_ent();" class="btn btn-default">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>
                    <a onclick="save_user();" class="btn btn-success">
                        <span class="fa fa-save"></span> &nbsp; Save
                    </a>

                </div>

                <div id="msg_box"  class="span12 text-center"  >

                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txt_usernm">User Name</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Name" id="user_name" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txt_usernm">Branch</label>
                    <div class="col-sm-2">
                        <select id="user_depart" class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="Manager">Manager</option>
                            <option value="House Keeping">House Keeping</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <!--<input type="text" id="user_depart" class="form-control" placeholder="User Department" />-->
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txt_password">Password</label>
                    <div class="col-sm-2">
                        <input type="password" placeholder="Password" id="pass1" class="form-control">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txt_password1">Confirm Password</label>
                    <div class="col-sm-2">
                        <input type="password" placeholder="Password" id="pass2" class="form-control">
                    </div>
                </div>	
                <form action="test.php" method="POST" class="form-horizontal form-groups-bordered">
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label">Photo  </label>					
                        <div class="col-sm-5">
                            <script language="JavaScript">
                                document.write(webcam.get_html(300, 220));
                            </script>

                            <input type=button  class="btn btn-primary" value="Take Snapshot" onClick="take_snapshot()">
                        </div>
                    </div>
                </form>
                <div class="form-group">		
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-primary">Save changes</button>	
                    </div>
                </div>				

            </div>
        </form>
    </div>

</section> 
<script language="JavaScript">
    webcam.set_api_url('test.php');
    webcam.set_quality(100); // JPEG quality (1 - 100)
    webcam.set_shutter_sound(true); // play shutter click sound
    webcam.set_hook('onComplete', 'my_completion_handler');

    function take_snapshot() {
        // take snapshot and upload to server
        webcam.snap();
    }
    function new_ent() {
        webcam.reset();
    }
</script>