<!-- SIGNUP -->

<div id="register" class="log_reg">
  <!-- Modal content -->
    <div class="">
        <form id="Join_form" method="post">
         <div class="label"><p>Create new account</p></div><br/>
         
         <div class="wrapHight">
            <p class="left">
                Email
            </p>
            <input class="right no_outline" type="email" name="email" id="email" placeholder="email@primer.com" />
        </div>
         <div class="wrapHight">
            <p class="left">
                Username
            </p>
            <input class="right no_outline" type="text" name="fname" id="username" placeholder="" />
        </div>   
        
         <div class="wrapHight">
            <p class="left">
                Password
            </p>
            <input class="right no_outline" type="password" name="password_1" id="password_1" placeholder="( min. 8 )" />
        </div>    
        <div class="wrapHight">
            <p class="left">
                re-enter Password
            </p>
            <input class="right no_outline" type="password" name="password_2" id="password_2" placeholder="( min. 8 )" />
        </div>

         <div class="wrapHight hight40"><input type="checkbox" class="checkbox" name="agree" id="agree" value="I agree" required="on" />I accept <a href="#">user agriment</a></div>
        <div class="wrapHight">
            <p class="left">
                Security question
            </p>
        <input class="right" type="text" name="question" id="question" placeholder="name of my dog?" />
        </div>
        <div class="wrapHight">
            <p class="left">
                PIN
            </p>
        <input class="right red_pholer" type="password" name="pin" id="pin" placeholder="( 6 )" />
        </div>

         <input type="submit"  name="createacc" id="createacc" value="Create account" class="btn btn-submit" />
        
        </form>
    <input type="submit"  name="redirect_log" id="redirect_log" value="Sign in" class="btn btn-redirect" />

    </div>
</div>

<!-- SIGN IN -->

<div id="login" class="log_reg">
  <!-- Modal content -->
    <div class="">
    <form id="Login_form" method="post">
     <div class="label"><p>SIGN IN</p></div><br/>
    <div class="wrapHight">
        <p class="left">Email</p><input class="right no_outline" type="email" name="email" id="email_Login" placeholder="email@primer.com" />
    </div>
    <div class="wrapHight">
     <p class="left">Password</p><input class="right no_outline" type="password" name="password" id="password_Login" placeholder=""/>
    </div>
    <div class="wrapHight">
        <p class="left">
                PIN
        </p>
           <input class="right red_pholer" type="password" name="pin_log" id="pin_log" placeholder="(2 pokusaja)" />
        </div> 
     <input type="submit"  name="Login" id="Login" value="Sign in" class="btn btn-submit" />
    </form>
    <input type="submit"  name="redirect_reg" id="redirect_reg" value="Create account" class="btn btn-redirect" />
    </div>
</div>