<?php 

include "../../admin/inc/db.php";

if(isset($_POST["action"]) && $_POST["action"] == "loadAppointmentsHistoryData"){

    $id = $_POST["id"];

    $sql = "SELECT `appointments`.`id` AS `apt_id`,`appointments`.`apt_no`,`appointments`.`status`,`appointments`.`apt_date`,`users`.`id`,`users`.`name`,`users`.`email`,`users`.`contact`,`appointments_feedback`.`id` AS `feedback_id`, `appointments_feedback`.`appointment_status` FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` LEFT JOIN `appointments_feedback` ON `appointments`.`id`=`appointments_feedback`.`appointment_id` WHERE `appointments`.`doctor_id` = $id AND `appointments`.`status` = 'Booked' ";
    $result = mysqli_query($con,$sql);

    $adminSql="SELECT `appointments`.`id` AS `apt_id`,`appointments`.`apt_no`,`appointments`.`status`,`appointments`.`apt_date`,`admin`.`id`,`admin`.`name`,`admin`.`email`,`admin`.`contact`,`appointments_feedback`.`id` AS `feedback_id`, `appointments_feedback`.`appointment_status` FROM `appointments` INNER JOIN `admin` ON `appointments`.`admin_id` = `admin`.`id` LEFT JOIN `appointments_feedback` ON `appointments`.`id`=`appointments_feedback`.`appointment_id` WHERE `appointments`.`doctor_id` = $id AND `appointments`.`status` = 'Booked' ";
    $adminAppointments = mysqli_query($con,$adminSql);
    

    $output = "";
    $display = "";

    if(mysqli_num_rows($result) > 0 || mysqli_num_rows($adminAppointments) > 0){
        // Todo: normal user appointment data

        if(mysqli_num_rows($result) > 0){
            
            while($row = mysqli_fetch_assoc($result)){
                $appointment_status = '';
                if($row["appointment_status"] == "Completed"){
                    $appointment_status = "<span class='badge text-bg-success mt-1'>COMPLETED</span>";
                }else{
                    $appointment_status = "<span class='badge text-bg-danger mt-1'>UNCOMPLETED</span>";
                }
                $output .= "<tr>
                <td class='text-muted'>{$row['apt_no']}</td>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>{$appointment_status}</td>
                <td>
                    <a href='view_appointment.php?id={$row['apt_id']}' class='text-decoration-none btn btn-sm btn-info shadow-none text-light'>
                        <i class='fa-solid fa-eye'></i> View
                    </a>
                </td>
            </tr>";
            }
            
            echo $output;
        }

        // Todo: admin appointments data show
        if(mysqli_num_rows($adminAppointments) > 0){    
            while($row = mysqli_fetch_assoc($adminAppointments)){
                $appointment_status = '';
                if($row["appointment_status"] == "Completed"){
                    $appointment_status = "<span class='badge text-bg-success mt-1'>COMPLETED</span>";
                }else{
                    $appointment_status = "<span class='badge text-bg-danger mt-1'>UNCOMPLETED</span>";
                }
                $display .= "<tr>
                <td class='text-muted'>{$row['apt_no']}</td>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>{$appointment_status}</td>
                <td>
                    <a href='view_appointment.php?id={$row['apt_id']}' class='text-decoration-none btn btn-sm btn-info shadow-none text-light'>
                        <i class='fa-solid fa-eye'></i> View
                    </a>
                </td>
            </tr>";
            }
            echo $display;
        }
    }
    else{
        echo "<tr><td class='table-danger text-center mt-2' colspan='7'>Not found any appointments</td></tr>";
        exit;
    }

}

// Todo: show data by date

if(isset($_POST["action"]) && $_POST["action"] == "loadDataByDate"){
    $id = $_POST["id"];
    $date = $_POST["date"];

    $sql = "SELECT `appointments`.`id` AS `apt_id`,`appointments`.`apt_no`,`appointments`.`status`,`appointments`.`apt_date`,`users`.`id`,`users`.`name`,`users`.`email`,`users`.`contact`,`appointments_feedback`.`id` AS `feedback_id`, `appointments_feedback`.`appointment_status` FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` LEFT JOIN `appointments_feedback` ON `appointments`.`id`=`appointments_feedback`.`appointment_id` WHERE `appointments`.`doctor_id` = $id AND `appointments`.`apt_date`='{$date}' AND `appointments`.`status` = 'Booked' ";
    $result = mysqli_query($con,$sql);

    $adminSql="SELECT `appointments`.`id` AS `apt_id`,`appointments`.`apt_no`,`appointments`.`status`,`appointments`.`apt_date`,`admin`.`id`,`admin`.`name`,`admin`.`email`,`admin`.`contact`,`appointments_feedback`.`id` AS `feedback_id`, `appointments_feedback`.`appointment_status` FROM `appointments` INNER JOIN `admin` ON `appointments`.`admin_id` = `admin`.`id` LEFT JOIN `appointments_feedback` ON `appointments`.`id`=`appointments_feedback`.`appointment_id` WHERE `appointments`.`doctor_id` = $id AND `appointments`.`apt_date`='{$date}' AND `appointments`.`status` = 'Booked' ";
    $adminAppointments = mysqli_query($con,$adminSql);
    

    $output = "";
    $display = "";

    if(mysqli_num_rows($result) > 0 || mysqli_num_rows($adminAppointments) > 0){
        // Todo: normal user appointment data

        if(mysqli_num_rows($result) > 0){
            
            while($row = mysqli_fetch_assoc($result)){
                $appointment_status = '';
                if($row["appointment_status"] == "Completed"){
                    $appointment_status = "<span class='badge text-bg-success mt-1'>COMPLETED</span>";
                }else{
                    $appointment_status = "<span class='badge text-bg-danger mt-1'>UNCOMPLETED</span>";
                }
                $output .= "<tr>
                <td class='text-muted'>{$row['apt_no']}</td>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>{$appointment_status}</td>
                <td>
                    <a href='view_appointment.php?id={$row['apt_id']}' class='text-decoration-none btn btn-sm btn-info shadow-none text-light'>
                        <i class='fa-solid fa-eye'></i> View
                    </a>
                </td>
            </tr>";
            }
            
            echo $output;
        }

        // Todo: admin appointments data show
        if(mysqli_num_rows($adminAppointments) > 0){    
            while($row = mysqli_fetch_assoc($adminAppointments)){
                $appointment_status = '';
                if($row["appointment_status"] == "Completed"){
                    $appointment_status = "<span class='badge text-bg-success mt-1'>COMPLETED</span>";
                }else{
                    $appointment_status = "<span class='badge text-bg-danger mt-1'>UNCOMPLETED</span>";
                }
                $display .= "<tr>
                <td class='text-muted'>{$row['apt_no']}</td>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>{$appointment_status}</td>
                <td>
                    <a href='view_appointment.php?id={$row['apt_id']}' class='text-decoration-none btn btn-sm btn-info shadow-none text-light'>
                        <i class='fa-solid fa-eye'></i> View
                    </a>
                </td>
            </tr>";
            }
            echo $display;
        }
    }
    else{
        echo "<tr><td class='table-danger text-center mt-2' colspan='7'>Not found any appointments to Selected Date</td></tr>";
        exit;
    }

}

if(isset($_POST["action"]) && $_POST["action"] == "loadDataBySearch"){
    $id = $_POST["id"];
    $value = $_POST["value"];

    $sql = "SELECT `appointments`.`id` AS `apt_id`,`appointments`.`apt_no`,`appointments`.`status`,`appointments`.`apt_date`,`users`.`id`,`users`.`name`,`users`.`email`,`users`.`contact`,`appointments_feedback`.`id` AS `feedback_id`, `appointments_feedback`.`appointment_status` FROM `users` INNER JOIN `appointments` ON `users`.`id` = `appointments`.`patient_id` LEFT JOIN `appointments_feedback` ON `appointments`.`id`=`appointments_feedback`.`appointment_id` WHERE `appointments`.`doctor_id` = $id  AND `appointments`.`status` = 'Booked' AND `users`.`name` LIKE '%{$value}%' ";
    $result = mysqli_query($con,$sql);

    $adminSql="SELECT `appointments`.`id` AS `apt_id`,`appointments`.`apt_no`,`appointments`.`status`,`appointments`.`apt_date`,`admin`.`id`,`admin`.`name`,`admin`.`email`,`admin`.`contact`,`appointments_feedback`.`id` AS `feedback_id`, `appointments_feedback`.`appointment_status` FROM `appointments` INNER JOIN `admin` ON `appointments`.`admin_id` = `admin`.`id` LEFT JOIN `appointments_feedback` ON `appointments`.`id`=`appointments_feedback`.`appointment_id` WHERE `appointments`.`doctor_id` = $id  AND `appointments`.`status` = 'Booked' AND `admin`.`name` LIKE '%{$value}%' ";
    $adminAppointments = mysqli_query($con,$adminSql);
    

    $output = "";
    $display = "";

    if(mysqli_num_rows($result) > 0 || mysqli_num_rows($adminAppointments) > 0){
        // Todo: normal user appointment data

        if(mysqli_num_rows($result) > 0){
            
            while($row = mysqli_fetch_assoc($result)){
                $appointment_status = '';
                if($row["appointment_status"] == "Completed"){
                    $appointment_status = "<span class='badge text-bg-success mt-1'>COMPLETED</span>";
                }else{
                    $appointment_status = "<span class='badge text-bg-danger mt-1'>UNCOMPLETED</span>";
                }
                $output .= "<tr>
                <td class='text-muted'>{$row['apt_no']}</td>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>{$appointment_status}</td>
                <td>
                    <a href='view_appointment.php?id={$row['apt_id']}' class='text-decoration-none btn btn-sm btn-info shadow-none text-light'>
                        <i class='fa-solid fa-eye'></i> View
                    </a>
                </td>
            </tr>";
            }
            
            echo $output;
        }

        // Todo: admin appointments data show
        if(mysqli_num_rows($adminAppointments) > 0){    
            while($row = mysqli_fetch_assoc($adminAppointments)){
                $appointment_status = '';
                if($row["appointment_status"] == "Completed"){
                    $appointment_status = "<span class='badge text-bg-success mt-1'>COMPLETED</span>";
                }else{
                    $appointment_status = "<span class='badge text-bg-danger mt-1'>UNCOMPLETED</span>";
                }
                $display .= "<tr>
                <td class='text-muted'>{$row['apt_no']}</td>
                <td class='text-muted'>{$row['apt_date']}</td>
                <td class='text-muted'>{$row['name']}</td>
                <td class='text-muted'>{$row['email']}</td>
                <td class='text-muted'>{$row['contact']}</td>
                <td>{$appointment_status}</td>
                <td>
                    <a href='view_appointment.php?id={$row['apt_id']}' class='text-decoration-none btn btn-sm btn-info shadow-none text-light'>
                        <i class='fa-solid fa-eye'></i> View
                    </a>
                </td>
            </tr>";
            }
            echo $display;
        }
    }
    else{
        echo "<tr><td class='table-danger text-center mt-2' colspan='7'>Not found any appointments this search name</td></tr>";
        exit;
    }

}

?>