<?php
    ob_start();
    session_start();

?>




<?php

/////// Check GET or POST ////////////

        // Check id from GET
        if(empty($_GET['id'])) {
          //  echo "Month from GET <br>";
          //  echo "GetId=: ".$_GET['id']."<br>";

            // One month from today
            $next = date('Y-m-d', strtotime('+1 month'));
            $prev = date('Y-m-d', strtotime('-1 month'));

        }   else

        {
            // One month from GET date
            //$next = date('Y-m-d', strtotime('+1 month'));
            //$prev = date('Y-m-d', strtotime('-1 month'));
            $time = strtotime($_GET['id']);
            $next = date("Y-m-d", strtotime("+1 month", $time));
            $prev = date("Y-m-d", strtotime("-1 month", $time));
        }



    //    echo "Next month: ".$next."<br>";
    //    echo "Previous month: ".$next."<br>";

//echo date("m-Y", strtotime("first day of previous month"));

?>


<?php

/////// Calendar /////////////////////

/* Set the default timezone */
date_default_timezone_set("America/Montreal");

/* Set the date */
//$date = strtotime(date("Y-m-d"));

    // Check id from GET
        if(empty($_GET['id'])) {

            $date = strtotime(date("Y-m-d"));
          //  echo "Month from GET <br>";
          //  echo "GetId=: ".$_GET['id']."<br>";
        }
            else {

                //$date = strtotime(date("Y-m-d"));
                $tempDate = $_GET['id'];
                //$date=date_create($tempDate);
                //$date=date_create_from_format("Y-m-d", $tempDate);
                $date = strtotime(date("Y-m-d", strtotime($tempDate)));
                //$date = date('Y-m-d', $tempDate);
              //  echo "GET: ".$_GET['id']."<br>";
              //  print_r($date);
              //  echo "<br>";
            }


$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);
$firstDay = mktime(0,0,0,$month, 1, $year);
$title = strftime('%B', $firstDay);
$dayOfWeek = date('D', $firstDay);
$daysInMonth = cal_days_in_month(0, $month, $year);

/* Get the name of the week days */
$timestamp = strtotime('next Sunday');
$weekDays = array();

for ($i = 0; $i < 7; $i++) {
    $weekDays[] = strftime('%a', $timestamp);
    $timestamp = strtotime('+1 day', $timestamp);
}

$blank = date('w', strtotime("{$year}-{$month}-01"));
//echo "Blank: ".$blank."<br>";

//////// Contractor  //////////////////////

 $workorders = array();

 $data = WorkorderImpl::acceptedWorkorders($_SESSION['contractor_id']);

    foreach( $data as $row ) {

       $workorder = new Workorder($row['id'],$row['description'], $row['estimate'], $row['location'], $row['received'], $row['scheduled'], $row['compleated'], $row['location_id']);

            $workorders[] = $workorder;
    }

    // Test: print an array of workorders
    // Check if workorder is empty
/*
    foreach($workorders as $key => $workorder) {
        echo "W: ".$workorder->scheduled." Desc:".$workorder->description."<br>";
    }
*/
    $date1=date_create("2013-03-12");
    $date2=date_create("2013-03-12");

    compareDates($date1, $date2);

    // Compare dates function
    function compareDates($date1, $date2) {

        $diff=date_diff($date1,$date2);

       // echo "Month: ".$diff->m."<br>";
       // echo "Day: ".$diff->d."<br>";
        //print_r($diff);

        if($diff->m == $diff->y && $diff->d == 0 && $diff->m == 0) {
           // echo "We found a match!<br>";
            return true;
        }
            return false;
    }



?>


<!doctype html>
<html>
 <head>

    <title>Calendar</title>
 <meta charset="utf-8">
 <!--   <link rel="stylesheet" href="styles.css"> -->
 <style><?php include 'CSS/calendar.css'; ?></style>

</head>


    <body>
    <main>
    <div id="calendar-wrap">

    <div class="month">
  <ul>

 <!--   <li class="prev">&#10094;</li>
    <li class="next">&#10095;</li>
  -->

    <li class="prev"><?php   echo "<a href=\"schedule?id=".$prev."\">&#10094;</a>"; ?></li>
    <li class="next"><?php  echo "<a href=\"schedule?id=".$next."\">&#10095;</a>"; ?></li>
    <li>
      <?php echo $title ?><br>
      <span style="font-size:18px"><?php echo $year ?></span>
        <br>

        <span style="font-size:15px">
        <?php
            if(!empty($_GET['id'])) {
                //$currentDate = strtotime(date("Y-m-d"));
                //echo "Today is ";
echo "<a href=\"schedule?id=".date("Y-m-d")."\">current ".date("Y-m-d")."</a>";
            }
           // echo $year;
        ?>
        </span>

    </li>
  </ul>
</div>
        <!--    <header>
                <h1>December 2017</h1>
            </header>
        -->

            <div id="calendar">
                <ul class="weekdays">
                    <li>Sunday</li>
                    <li>Monday</li>
                    <li>Tuesday</li>
                    <li>Wednesday</li>
                    <li>Thursday</li>
                    <li>Friday</li>
                    <li>Saturday</li>
                </ul>

                <!-- Days from previous month -->


    <ul class="days">
        <?php for($i = 0; $i < $blank; $i++): ?>
            <li class="days other-month"></li>
        <?php endfor;
        for($i = 1; $i <= $daysInMonth; $i++):

             if($day == $i): ?>
                <li class="active"><strong>
                    <div class="date">
                        <?php echo $i ?>
                    </div></strong></li>

            <?php else: ?>
                <li class="days">
                    <div class="date"><?php echo $i ?></div>

  <?php
           foreach($workorders as $key => $workorder) {

               $t = $year."-".$month."-".$i;
               $dateT=date_create($t);
              // echo "Date: ".$t."<br>";
               $dateS = $workorder->scheduled;
              // echo "Date: ".$dateS."<br>";
               $dateS = date_create($dateS);


               if (compareDates($dateT, $dateS)) {
                  // echo "W: ".$workorder->scheduled."<br>";
    ?>
                   <div class="event">
                            <div class="event-desc">
                   <?php

        echo $workorder->description;
        echo "<br>";
        echo "<a href=\"updateWorkContractor?id=".$workorder->id."\">update</a>";
                    ?>
                            </div>
                            <div class="event-time">
                                1:00pm to 4:00pm
                            </div>
                        </div>
    <?php           }

            }

  ?>
                </li>

            <?php endif;
             if(($i + $blank) % 7 == 0): ?>
                </ul><ul class="days">
            <?php endif;
         endfor;

         for($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; $i++): ?>
            <li class="days other-month"></li>
        <?php endfor; ?>
    </ul>


            </div><!-- /. calendar -->
        </div><!-- /. wrap -->



</main>
</body>
</html>
