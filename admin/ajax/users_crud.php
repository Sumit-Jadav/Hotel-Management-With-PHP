<?php
    require("../inc/essentials.php");
    require("../inc/db_config.php");
    adminLogin();

    if(isset($_POST['get_users'])){
        $res = selectAll("user_cred");
        $i = 1;
        $path = USERS_IMG_PATH;
        $data = "";
        while($row = mysqli_fetch_assoc($res)){

            $del_btn = " <button onclick=\"remove_user($row[id])\" class='btn btn-danger btn-sm shadow-none' type='button'><i class='bi bi-trash'></i></button>";


            $is_varified = "<span class='badge bg-warning text-dark'><i class='bi bi-x-lg'></i></span>";
            if ($row["is_verified"]) {
                $is_varified = "<span class='badge bg-success text-dark'><i class='bi bi-check-lg'></i></span>";
                $del_btn = "";
            }
            //  0 = inactive and 1 = active
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>Active</button>";
            if (!$row["status"]) {
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>Inactive</button>";
            }
            $date = date("d-m-Y : H:m:s",strtotime($row["datentime"]));
           echo "
              <tr class='align-middle'>
                <td>$i</td>
                <td>
                    <img src='$path$row[profile]' width='55px' /><br>
                    $row[name]
                </td>
                <td>$row[email]</td>
                <td>$row[phonenum]</td>
                <td>$row[address]</td>
                <td>$row[dob]</td>
                <td>$is_varified</td>
                <td>$status</>
                <td>$date</>
                <td>$del_btn</td>

                
              </tr>           
            ";
          $i++;
        }
    }

    if (isset($_POST["toggle_status"])) {
      $frm_data = filteration($_POST);
      $q = "UPDATE `user_cred` SET `status`=? WHERE `id`=?";
      $v = [$frm_data["value"],$frm_data["toggle_status"]];
      if (update($q,$v,"ii")) {
        echo 1;

      }
      else{
        echo 0;
      }
    }

    if (isset($_POST["remove_user"])) {
        $frm_data = filteration($_POST);
        
        $res = deleteq("DELETE FROM `user_cred`  WHERE `id`=? AND `is_verified`=?",[$frm_data["user_id"],0],"ii");

        if ($res) {
          echo 1;
        }
        else{
          echo 0;
        }
    }

    if(isset($_POST['search_user'])){
        $frm_data = filteration($_POST);
        $q = "SELECT * FROM `user_cred` WHERE `name` LIKE ?";
        $values = ["%$frm_data[name]%"];
        $res = select($q,$values,"s");
        $i = 1;
        $path = USERS_IMG_PATH;
        $data = "";
        while($row = mysqli_fetch_assoc($res)){

            $del_btn = " <button onclick=\"remove_user($row[id])\" class='btn btn-danger btn-sm shadow-none' type='button'><i class='bi bi-trash'></i></button>";


            $is_varified = "<span class='badge bg-warning text-dark'><i class='bi bi-x-lg'></i></span>";
            if ($row["is_verified"]) {
                $is_varified = "<span class='badge bg-success text-dark'><i class='bi bi-check-lg'></i></span>";
                $del_btn = "";
            }
            //  0 = inactive and 1 = active
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>Active</button>";
            if (!$row["status"]) {
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>Inactive</button>";
            }
            $date = date("d-m-Y : H:m:s",strtotime($row["datentime"]));
           echo "
              <tr class='align-middle'>
                <td>$i</td>
                <td>
                    <img src='$path$row[profile]' width='55px' /><br>
                    $row[name]
                </td>
                <td>$row[email]</td>
                <td>$row[phonenum]</td>
                <td>$row[address]</td>
                <td>$row[dob]</td>
                <td>$is_varified</td>
                <td>$status</>
                <td>$date</>
                <td>$del_btn</td>

                
              </tr>           
            ";
          $i++;
        }
    }


?>