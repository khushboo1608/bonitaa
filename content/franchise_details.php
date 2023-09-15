<div class="Address-box-desgin">
    <div class="container" style="margin-top: 50px; margin-bottom:50px;">
      <div class="row">
        <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
          <div class="main-address-box">
            <div class="address-box">
              <div class="address-first-box">
                <h2>Send us a message</h2>
                <img src="images/line.png" alt="" class="line">
              </div>
              <!--<button class="btn btn-success">Back</button>-->
            </div>
            <div class="my_profile_box">
              <div class="login-form-bd">
                <div class="form-wrapper">
                  <div class="form-container">
                    <form id="add_franchise" action="#" name="add_franchise"  method="post">
                      <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                          <div class="form-control">
                            <input type="text" name="franchise_name" id="franchise_name" value="<?php echo $_SESSION['user_name']; ?>" placeholder="Enter Your Name" style="border-radius: 8px;" required>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                          <div class="form-control">
                            <input type="email" name="franchise_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="franchise_email" placeholder="Enter Your Email" style="border-radius: 8px;" required>
                          </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                          <div class="form-control">
                            <input type="text" name="franchise_number" id="franchise_number" pattern="[7-9]{1}[0-9]{9}" value="<?php echo $_SESSION['user_phone']; ?>" maxlength="10" placeholder="Enter Your Number" required>
                          </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                          <select class="form-select" name="state_id" id="state_id" aria-label="Default select example">
                            <option selected>Select State</option>
                            <?php
                              $qry_state="SELECT * FROM state order by name";
                              $results_state=mysqli_query($con,$qry_state);
                
                              while ($row_state=mysqli_fetch_array($results_state)) 
                              {
                                 if($row_state['name']==$_SESSION['state_name']){
                                ?>
                                <option selected value="<?php echo $row_state['ID'];?>" > <?php echo $row_state['name'];?></option>
                                <?php }else{ ?>
                                <option value="<?php echo $row_state['ID'];?>" > <?php echo $row_state['name'];?></option>
                                <?php } } ?>
                          </select>
                        </div>
                        
                        <div class="col-xl-6 col-lg-4 col-sm-12 col-md-12">
                          <select class="form-select" name="city_id" id="city_id" aria-label="Default select example">
                            <!-- <option selected>Select City</option> -->
                            <?php
                            if( @$_SESSION['city_id'] ) {
                              $res = mysqli_query($con,"SELECT ID,name FROM `city` ORDER BY ID ASC");
                              while ($row = mysqli_fetch_array($res)) {
                                if($row['ID']==$_SESSION['city_id']){
                                  echo "<option selected value=".$row['ID'].">".$row['name']."</option>";  
                                }
                                else{
                                  echo "<option value=".$row['ID'].">".$row['name']."</option>";
                                }
                              }
                            }
                          ?>
                          </select>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                          <div class="form-control">
                            <input type="text" name="franchise_occupation" id="franchise_occupation"  placeholder="Enter Your Occupation" required>
                          </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                          <div class="form-control">
                            <input type="text" name="franchise_age" id="franchise_age"  placeholder="Enter Your Age" required>
                          </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                          <div class="form-control">
                            <input type="text" name="franchise_experience" id="franchise_experience"  placeholder="Enter Your Work experience in years" required>
                          </div>
                        </div>
                     
                  
                   
                  <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                      <div class="radio-box-1">
                        <div class="radio-edit">
                             <span>Owner's Space</span>
                         </div>
                           <div class="radio-edit-2">
                            <div class="form-check">
                                  <input class="franchise_owner_space form-check-input" type="radio" value="1" name="franchise_owner_space" id="franchise_type1">
                                  <label class="form-check-label" for="franchise_type1">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="franchise_owner_space form-check-input" type="radio" value="0" name="franchise_owner_space" id="franchise_type2">
                                <label class="form-check-label" for="franchise_type2">No</label>
                            </div>
                         </div>
                      </div>
                  </div>
                    <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                      <div class="form-control">
                        <input type="text" name="franchise_query" id="franchise_query"  placeholder="Write your query" required>
                      </div>
                    </div>
                  <!--<button class="login-btn">Submit</button>-->
                  </div>
                  <button type="submit" id="submitAddress" class="submitFranchise login-btn">Submit</button>
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
  </div>