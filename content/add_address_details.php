<div class="Address-box-desgin">
  <div class="container" style="margin-top: 50px; margin-bottom:50px;">
    <div class="row">
      <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
        <div class="main-address-box">
          <div class="address-box">
            <div class="address-first-box">
              <h2>Add Address</h2>
              <img src="images/line.png" alt="" class="line">
            </div>
            <!--<button class="btn btn-success">Back</button>-->
          </div>
          <div class="my_profile_box">

            <div class="login-form-bd">
              <div class="form-wrapper">
                <div class="form-container">

                  <form id="add_address" name="add_address" method="post">
                    <div class="row">
                      <div class="col-xl-6 col-lg-4 col-sm-12 col-md-12">
                        <div class="form-control">
                          <input type="text" name="address_name" id="address_name"
                            value="<?php echo $_SESSION['user_name']; ?>" placeholder="Enter Your Name"
                            style="border-radius: 8px;" required>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-4 col-sm-12 col-md-12">
                        <div class="form-control">
                          <input type="text" name="address_number" id="address_number"
                            value="<?php echo $_SESSION['user_phone']; ?>" placeholder="Enter Your Number" required>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-4 col-sm-12 col-md-12">
                        <div class="form-control">
                          <input type="text" name="address_houser_no" id="address_houser_no"
                            placeholder=" House No / Street Area" required>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-4 col-sm-12 col-md-12">
                        <div class="form-control">
                          <input type="text" name="address_lendmark" id="address_lendmark" placeholder="Landmark"
                            required>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                        <select class="form-select" name="state_id" id="state_id" aria-label="Default select example" required>
                          <option selected>Select State</option>
                          <?php
                          $qry_state = "SELECT * FROM state order by name";
                          $results_state = mysqli_query($con, $qry_state);

                          while ($row_state = mysqli_fetch_array($results_state)) {
                            if ($row_state['name'] == $_SESSION['state_name']) {
                              ?>
                              <option selected value="<?php echo $row_state['ID']; ?>"> <?php echo $row_state['name']; ?>
                              </option>
                            <?php } else { ?>
                              <option value="<?php echo $row_state['ID']; ?>"> <?php echo $row_state['name']; ?></option>
                            <?php }
                          } ?>
                        </select>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                        <select class="form-select" name="city_id" id="city_id" aria-label="Default select example" required>
                          <!-- <option selected>Select City</option> -->
                          <?php
                          if (@$_SESSION['city_id']) {
                            $res = mysqli_query($con, "SELECT ID,name FROM `city` ORDER BY ID ASC");
                            while ($row = mysqli_fetch_array($res)) {
                              if ($row['ID'] == $_SESSION['city_id']) {
                                echo "<option selected value=" . $row['ID'] . ">" . $row['name'] . "</option>";
                              } else {
                                echo "<option value=" . $row['ID'] . ">" . $row['name'] . "</option>";
                              }
                            }
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                        <div class="mb-3">
                          <input name="address" id="searchInput11" class="form-control" type="text"
                            placeholder="Enter a location" value="" required>
                          <div id="map1"></div>
                          <ul class="geo-data">
                          </ul>
                        </div>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                        <div class="radio-box">
                          <div class="radio-edit">
                            <span>Type</span>
                          </div>
                          <div class="radio-edit-2">
                            <div class="form-check">
                              <input class="address_type form-check-input" type="radio" value="Home" <?php
                              if ($data_address['addersstype'] == "Home") {
                                echo "checked";
                              } ?> name="address_type"
                                id="address_type1" required>
                              <label class="form-check-label" for="address_type1">
                                Home
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="address_type form-check-input" type="radio" value="Work" <?php
                              if ($data_address['addersstype'] == "Work") {
                                echo "checked";
                              } ?> name="address_type"
                                id="address_type2" required>
                              <label class="form-check-label" for="address_type2">
                                Work
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="address_type form-check-input" type="radio" value="Other" <?php
                              if ($data_address['addersstype'] == "Other") {
                                echo "checked";
                              } ?> name="address_type"
                                id="address_type3" required>
                              <label class="form-check-label" for="address_type3">
                                Other
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                </div>


                <input type="hidden" class="form-control" placeholder="lattitude" aria-describedby="basic-addon1"
                  id="lattitude1" name="lattitude">
                <input type="hidden" class="form-control" placeholder="Pincode" aria-describedby="basic-addon1"
                  id="postal_code1" name="postal_code">
                <input type="hidden" class="form-control" placeholder="longitude" aria-describedby="basic-addon1"
                  id="longitude1" name="longitude" value="">
                <input type="hidden" class="form-control" placeholder="Enter a location" name="address" id="address1"
                  value="">



                <!--<button class="login-btn">Submit</button>-->
                <button type="submit" id="submitAddress" class="submitAddress login-btn">Submit</button>
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