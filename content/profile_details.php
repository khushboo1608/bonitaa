<div class="Address-box-desgin">
    <div class="container" style="margin-top: 50px; margin-bottom:50px;">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-sm-12 col-md-12 col-lg-6">
                <div class="main-address-box">
                    <div class="my_profile_box">

                        <div class="login-form-bd">
                            <div class="form-wrapper">
                                <div class="form-container">
                                    <h3> Update Profile</h3>
                                    <form id="submitForm" name="submitForm" method="post" enctype="multipart/form-data" >

                                        <div class="form-control">
                                            <input required=""  name="user_name" id="user_name" type="text" placeholder="Enter Your Name" />
                                        </div>

                                        <div class="form-control">
                                            <input type="email" name="user_email" id="user_email" required=""  placeholder="Enter Your Email" />
                                        </div>

                                        <div class="form-control">
                                            <input type="text" name="user_phone" id="user_phone" value="<?php echo $_SESSION['user_phone']; ?>" readonly="true" placeholder="Enter Your Mobile number"  />
                                           
                                        </div>


                                        <!--<div class="form-control">-->
                                        <!--    <input required="" name="user_password" id="user_password" placeholder="Enter Your password"   />-->
                                        <!--</div>-->

                                        <div class="form-control">
                                            <input name="user_code" id="user_code" placeholder="Enter  Refferal Code(optional)"   />
                                        </div>
                                        <div class="mb-3">
                                            <input type="file" name="imageurl" id="imageurl" accept="image/*" class="form-control form-control-lg">
                                        </div>
                                        
                                        <div class="">
                                            <select name="city_id" id="city_id" class="form-control form-control-lg" aria-label="Default select example" >
                                              <option selected>Select city</option>
                                              <?php
                                              $qry_state = "SELECT * FROM city order by name";
                                              $results_state = mysqli_query($con, $qry_state);
                    
                                              while ($row_state = mysqli_fetch_array($results_state)) {
                                                if ($row_state['name'] == $_SESSION['city_id']) {
                                                  ?>
                                                  <option selected value="<?php echo $row_state['ID']; ?>"> <?php echo $row_state['name']; ?>
                                                  </option>
                                                <?php } else { ?>
                                                  <option value="<?php echo $row_state['ID']; ?>"> <?php echo $row_state['name']; ?></option>
                                                <?php }
                                              } ?>
                                            </select>
                                        </div>

                                        <button type="submit" class="login-btn" name="submit" value="Submit">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>