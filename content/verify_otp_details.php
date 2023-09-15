<div class="Address-box-desgin">
    <div class="container" style="margin-top: 50px; margin-bottom:50px">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-sm-12 col-md-12 col-lg-6">
                <div class="main-address-box">
                    <div class="my_profile_box">

                        <div class="login-form-bd">
                            <div class="form-wrapper">
                                <div class="form-container" >
                                    <h3>Verify Otp</h3>
                                    <form id="form" name="form" method="post">
                                        <div class="verify-input-number">
                                            <span>+91</span>
                                            <div class="form-control" style="border-radius: 0px 8PX 8PX 0PX !IMPORTANT;">
                                                <input type="text" required="true" name="user_phone"  id="user_phone" value="<?php echo $_SESSION['user_phone'] ?>" readonly placeholder="Please Enter Phone No" />
                                            </div>
                                              
                                        </div>
                                        <div class="form-control " style="margin-top:15px !important;">
                                            <input type="text" required="true" name="user_otp" id="user_otp" required placeholder="Enter Valid OTP" />
                                           
                                        </div>
                                        <span class="otp-message" style="color: red; margin-bottom:20px;"></span>
                                         <br>
                                        <a id="resendOTP" href=""><i class="fi-rs-send-alt mr-5 text-muted" ></i><span>Didn't received OTP ? </span>  Resend OTP</a>  
                                        <button type="submit" id="verifyOtp" class="login-btn" name="login">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
