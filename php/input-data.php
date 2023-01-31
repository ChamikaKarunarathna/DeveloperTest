<?php
    include "./dbconn.php";
    $max_radius = 100;
    if (isset($_REQUEST['submit'])) {
        $name = mysqli_real_escape_string($conn,$_REQUEST['name']);
        $radius = mysqli_real_escape_string($conn,$_REQUEST['radius']);
        $st_time = mysqli_real_escape_string($conn,$_REQUEST['st_time']);
        $end_time = mysqli_real_escape_string($conn,$_REQUEST['end_time']);
        $laps = mysqli_real_escape_string($conn,$_REQUEST['laps']);

        if ($radius>$max_radius) {
            echo "<script>
                    window.location.href = '../input-form.php';
                    alert('Maximum Radius Exceeded !!');
                </script>";
        } else {
            $inp_query = "INSERT INTO `running_data`( `name`, `radius`, `start_time`, `end_time`, `laps_count`) VALUES ('$name','$radius','$st_time','$end_time','$laps')";
            $result = mysqli_query($conn,$inp_query);
            if ($result) {
                header("Location: ../");
            } else {
                echo "<script>
                    window.location.href = '../input-form.php';
                    alert('Database ERROR !! Please contact site Admin !');
                </script>";
            }
        }
    }
?>