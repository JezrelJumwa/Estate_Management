<section class="container frmlogin">
    <form class="form-horizontal col-md-6" method="POST" action="<?php echo $url; ?>" id="" name="frmLogin">
        <!--<fieldset disabled="disabled">-->
            <div class="aa-sidebar-widget">
    			<h3>Login</h3>
    		</div>
            <input type="hidden" name="frmName" value="frmLogin" />
            <input type="hidden" name="txtHumanCode" value="4r37061noo" />
            <div class="form-group">
                <label for="inputUsername" class="control-label col-xs-2">User:</label>
                <div class="col-xs-10">
                    <input type="text" class="form-control" name="txtUName" id="inputUsername" placeholder="User Name" required="required" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="control-label col-xs-2">Password:</label>
                <div class="col-xs-10">
                    <input type="password" class="form-control" name="txtPasswd" id="inputPassword" placeholder="Password" required="required" />
                </div>
            </div>
            <!--<div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <div class="checkbox">
                        <label><input type="checkbox"> Remember me</label>
                    </div>
                </div>
            </div>-->
            <div class="aa-sidebar-widget">
                <input class="aa-browse-btn" type="submit" value="Login" /> 
                <input  class="aa-browse-btn" type="reset" value="Clear"  />
            </div>
        <!--</fieldset>-->
    </form>
</section>