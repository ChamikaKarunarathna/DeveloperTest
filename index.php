<?php
    include "./php/dbconn.php";

    // Get Data from Database
    $select_query = "SELECT `id`, `name`, `radius`, `start_time`, `end_time`, `laps_count` FROM `running_data`";
    $result = mysqli_query($conn, $select_query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <a href="./input-form.php"><button type="button" class="btn btn-primary mb-3">Add Runner</button></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Runner</th>
                        <th>Speed (kmph)</th>
                        <th>Radius (m)</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Duration (hours)</th>
                        <th>Number of Laps</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row['name'];
                            $radius = $row['radius'];
                            $start_time = $row['start_time'];
                            $end_time = $row['end_time'];
                            $laps_count = $row['laps_count'];

                            // Calculate Distance in kilometeres
                            $distance = ($laps_count*(2*(22/7)*$radius))/1000;
                            
                            // Calculate Duration in hours
                            $duration = number_format(((strtotime($end_time) - strtotime($start_time))/60)/60,2);

                            // Calculate Speed of Runner
                            $speed = number_format($distance / $duration,2);

                            // Formatting time to remove Decimal Part
                            // Start Time
                            $st_time_part = explode(".", $start_time);
                            $formatted_st_time = $st_time_part[0];

                            // End Time
                            $end_time_part = explode(".", $end_time);
                            $formatted_end_time = $end_time_part[0];
                    ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $speed; ?></td>
                        <td><?php echo $radius; ?></td>
                        <td><?php echo $formatted_st_time; ?></td>
                        <td><?php echo $formatted_end_time; ?></td>
                        <td><?php echo $duration; ?></td>
                        <td><?php echo $laps_count; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
        
    </div>
</body>
</html>