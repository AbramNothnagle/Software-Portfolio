<h2>Clock</h2>

        <div id="clockDisplay" class="clockStyle" style="    
        position: absolute;
        margin-top:-300px;
        margin-left:-5%;
        background-color:#000;
        border: 2px inset #999;
        padding: 2px;
        color: #0ff;
        font-family:'Arial Black', Gadget, sans-serif;
        font-size:14px;
        font-weight: bold;
        letter-spacing: 2px;
        display: inline;">
        
        </div>

        <?php

        include 'clockbox.php';
    
        ?>
        
        <div id="clockedDisplay" class="clockStyle" style="    
        background-color:#000;
        position: absolute;
        margin-top: 56px;
        margin-left: -184px;
        border: 2px #999 2px inset;
        padding: 6px;
        color: #0ff;
        font-family:'Arial Black', Gadget, sans-serif;
        font-size:41px;
        font-weight: bold;
        letter-spacing: 20px;
        height: 60px;
        display: inline;">

        <?php
              
            /*  
            $emp_id = $_SESSION['e_id'];
            $sql = "SELECT * FROM timeGeneral WHERE submitted = 'no' AND emp_id = '$emp_id';";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            $total_break_time = 0;
            if ($resultCheck > 0){
                while ($row = $result->fetch_assoc()) {
                    $time = $row["time_stamp"];
                    $time_id = $row["time_id"];
                }
                $sql2 = "SELECT * FROM timeGeneral WHERE submitted = 'breakdone' AND break_id='$time_id';";
                $result2 = mysqli_query($conn, $sql2);
                while($row = $result2->fetch_assoc()) {
                    $end = $_row['breakend'];
                    $start = $_row['breakstart'];
                    $break_time = $end - $start;
                }
                */

                /*
                $timeNow = time();
                $totalTime = $timeNow - $time;
                $totalTime = $totalTime - $total_break_time;
                $seconds = $totalTime % 60;
                $totalTime = ($totalTime - $seconds)/60;
                $minutes = $totalTime % 60;
                $totalTime = ($totalTime - $minutes)/60;
                $hours = $totalTime;
                

                    if ($hours < 10){
                        echo "0".$hours;
                    } else{
                        echo ":".$hours;
                    }
                    if ($minutes < 10){
                        echo ":0".$minutes;
                    } else{
                        echo ":".$minutes;
                    }
                    if ($seconds < 10){
                        echo ":0".$seconds;
                    } else{
                        echo ":".$seconds;    
                    }
                

            } else {
                echo '00:00:00';
            }
            */
            echo '00:00:00';
        ?>

        </div>
    </div>
</section>

<!-- Submit Button
<form method=POST>
<input id='time1' type='text' name='time1' value='00' style='margin-left:550px; margin-top: 14%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time2' type='text' name='time2' value='00' style='margin-left:550px; margin-top: 14%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time3' type='text' name='time3' value='00' style='margin-left:550px; margin-top: 14%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time4' type='text' name='time4' value='00' style='margin-left:550px; margin-top: 14%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time5' type='text' name='time5' value='00' style='margin-left:550px; margin-top: 14%;width:0;height:0;z-index:-9;position:absolute'>
<button  id = 'btn' type ='submit' name='submitsendtime' style=' position: absolute; width: 180px; left:550px; top: 80%;
height: 30px;
border: none;
background-color: black;
font-family: arial;
font-size: 16px;
color: white;
cursor: pointer;'
>Submit</button></form>
-->

<!-- Take a break button -->
<form method=POST onclick='timestampForBreak()' action=''>
<input id='time6' type='text' name='time6' value='00' style='margin-left:550px; margin-top: 14%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time7' type='text' name='time7' value='00' style='margin-left:550px; margin-top: 14%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time8' type='text' name='time8' value='00' style='margin-left:550px; margin-top: 14%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time9' type='text' name='time9' value='00' style='margin-left:550px; margin-top: 14%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time10' type='text' name='time10' value='00' style='margin-left:550px; margin-top: 14%;width:0;height:0;z-index:-9;position:absolute'>
<button id = 'breakbtn' type ='submit' name='submitpausetime' style=' position: absolute; width: 180px; left:550px; top: 73%;
height: 30px;
border: none;
background-color: gray;
font-family: arial;
font-size: 16px;
color: white;
cursor:pointer;' disabled
>Take A Break</button>
</form>

<div style='position:absolute; left:40%; top:95%;'id='infoclock'><p></p><div>
<div id='d1' style='font-size:15px;'>

<?php
    
    $emp_id = $_SESSION['e_id'];
    $sql = "SELECT * FROM timeGeneral WHERE submitted = 'no' AND emp_id = '$emp_id';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0){
    while ($row = $result->fetch_assoc()) {
        $time = $row["time_stamp"];
        $time_id = $row["time_id"];
        echo $time;
    }
    }
    
?>

</div>

<div id='d2' style='font-size:15px;'>

<?php

    $total_break_time = 0;
    $emp_id = $_SESSION['e_id'];
    $sql = "SELECT * FROM timeGeneral WHERE submitted = 'no' AND emp_id = '$emp_id';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0){
    while ($row = $result->fetch_assoc()) {
        $total_break_time = $row['total_break_time'];
    }
    }
    echo $total_break_time;

?>

</div>

<script>

var time_clock_start = 0;

function timestamp(){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("d2").innerHTML =
            this.responseText;
       }
    };

    xmlhttp.open("GET","timestampstart.php?", false);
    xmlhttp.send(null);
    var dateNow = new Date();

    time_clock_start = dateNow.getTime();
    time_clock_start = time_clock_start/1000;
    time_clock_start = time_clock_start.toFixed(0);

}

function timestampForBreak(){

    var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.open("GET","timestampforbreak.php?", false);
    xmlhttp2.send(null);

    //document.getElementById("d1").innerHTML=xmlhttp.responseText;

}

function timestampForBreak2(){

    var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.open("GET","timestampforbreak.php?", false);
    xmlhttp2.send(null);

    //document.getElementById("d1").innerHTML=xmlhttp.responseText;

}   

    var clockin = document.getElementById("clockin");
    clockin.addEventListener("click", changebtn);
    var breakbtn = document.getElementById("breakbtn");
    breakbtn.addEventListener("click", pauseClock);

    var pause = "true";

    var hr = 0;
    var mi = 0;
    var se = 0;
    starter();

    function starter(){
        
        
        clock = document.getElementById('d1').innerHTML;
        clock = parseInt(clock);
        if (clock > 0){
            time_clock_start = clock;
            pause = 'false';
            clockedTime();
            document.getElementById("clockin").style.display = "none";
            document.getElementById("clockingray").style.display = "block";
            document.getElementById("clockout").style.display = "block";
            document.getElementById("clockoutgray").style.display = "none";
            document.getElementById("time4").value = Date();
            document.getElementById("breakbtn").disabled = false;
            document.getElementById("breakbtn").style.backgroundColor = "orange";
            document.getElementById('clockedDisplay').style.marginLeft = "-184px";
        }
        
        /*
        clock = document.getElementById('clockedDisplay').innerHTML;
        var res = clock.split(":");
        hrTest = parseInt(res[0]);
        miTest = parseInt(res[1]);
        seTest = parseInt(res[2]);
        if (seTest != 0 || miTest != 0 || seTest != 0){
            hr = parseInt(res[0]);
            mi = parseInt(res[1]);
            se = parseInt(res[2]);
            changebtn();
        }
        if (seTest == 0 && miTest == 0 && seTest == 0){
            hr = parseInt(res[0]);
            mi = parseInt(res[1]);
            se = parseInt(res[2]);
            changebtn();
        }
        */
    
        //changebtn();
    
    }

    function changebtn(){

        document.getElementById("clockin").style.display = "none";
        document.getElementById("clockingray").style.display = "block";
        document.getElementById("clockout").style.display = "block";
        document.getElementById("clockoutgray").style.display = "none";
        document.getElementById("time4").value = Date();
        document.getElementById("breakbtn").disabled = false;
        document.getElementById("breakbtn").style.backgroundColor = "orange";
        document.getElementById('clockedDisplay').style.marginLeft = "-180px";
        alert
        if (onBreak == "false"){ 
            displayStartTime();
        } else {
            time_clock_start_html = document.getElementById('d1').innerHTML;
            time_clock_start = parseInt(time_clock_start_html);
            alert(time_clock_start);
            displayBreakEnd();
        }
            pause = 'false'; 
            clockedTime();
        
    }
    function changebtnTwo(){
        
        document.getElementById("clockin").style.display = "block";
        document.getElementById("clockin").style.marginLeft = "0px";
        document.getElementById("clockingray").style.display = "none";
        document.getElementById("clockout").style.display = "none";
        document.getElementById("clockoutgray").style.display = "block";
        document.getElementById("clockoutgray").style.marginLeft = "180px";
        document.getElementById("breakbtn").disabled = true;
        document.getElementById("breakbtn").style.backgroundColor = "gray";
        document.getElementById("time5").value = Date();
        displayEndTime();  
        renderTime();
    
    }
    
    var h, m ,s, diem;
    var onBreak ='false';
    
    function displayStartTime(){
        document.getElementById('infoclock').innerHTML = "You Clocked in at : " + h + ":" + m + ":" + s + " " + diem;
    }
    function displayEndTime(){
        document.getElementById('infoclock').innerHTML = "You Clocked out at : " + h + ":" + m + ":" + s + " " + diem;
    }
    function displayPauseTime(){
        document.getElementById('infoclock').innerHTML = "You took a break at : " + h + ":" + m + ":" + s + " " + diem;
    } 
    function displayBreakEnd(){
        document.getElementById('infoclock').innerHTML = "You ended a break at : " + h + ":" + m + ":" + s + " " + diem;
    } 

    function pauseClock(){
        document.getElementById("clockin").style.display = "block";
        document.getElementById("clockin").style.marginLeft = "0px";
        document.getElementById("clockingray").style.display = "none";
        document.getElementById("clockout").style.display = "none";
        document.getElementById("clockoutgray").style.display = "block";
        document.getElementById("clockoutgray").style.marginLeft = "180px";
        document.getElementById("breakbtn").disabled = true;
        document.getElementById("breakbtn").style.backgroundColor = "gray";
        pause = "true";
        onBreak = "true";
        //se -= 1;
        displayPauseTime();
    }



    function renderTime(){
        
        var currentTime = new Date();
        diem = "AM";
        h = currentTime.getHours();
        m = currentTime.getMinutes();
        s = currentTime.getSeconds();

        if (h == 0) {
            h = 12;
        } else if (h > 12){
            h = h - 12;
            diem = "PM";
        }
        if (h < 10){
            h = "0" + h;
        }
        if (m < 10){
            m = "0" + m;
        }
        if (s < 10){
            s = "0" + s;
        }
        
        var myClock = document.getElementById('clockDisplay');
        myClock.textContent = h + ":" + m + ":" + s + " " + diem;
        myClock.innerHTML = h + ":" + m + ":" + s + " " + diem;
        
        
        var t = setTimeout(function(){ renderTime() }, 1000);
        
        
    }

    function first_click(){
        time_clock_start = time();
    }


    function clockedTime(){
        
        // Hand written clock
        
        var date_now = new Date();
        var time_now = date_now.getTime();
        time_now = time_now/1000;
        time_now = time_now.toFixed(0);

        var total_time = time_now - time_clock_start;
        //alert(total_time);
            se = total_time % 60;
            total_time = (total_time - se)/60;
            mi = total_time % 60;
            total_time = (total_time - mi)/60;
            hr = total_time;
            
            if (hr === undefined){
                hr = 0;
            }
            if (mi === undefined){
                mi = 0;
            }
            if (se === undefined){
                se = 0;
            }

        /*
        if (se == 60){
            mi = mi + 1;
            se = 0;
        } 
        if (mi == 60){
            mi = 0;
            hr = hr + 1;
        }
        */

        var hour, min, sec;

        if (hr < 10){
            if (hr != 0){
                hour = "0" + hr;
            } else {
                hour = "00";
            }
        } else{
            hour = hr;
        }
        if (mi < 10){
            if (mi != 0){
                min = "0" + mi;
            } else {
                min = "00";
            }
        } else {
            min = mi;
        }
        if (se < 10){
            if (se != 0){
                sec = "0" + se;
            } else{
                sec = "00";
            }
        } else{
            sec = se;
        }
        
        document.getElementById('time1').value = hour;
        document.getElementById('time2').value = min;
        document.getElementById('time3').value = sec;

        if (pause == "false"){
            var myClock = document.getElementById('clockedDisplay');
            myClock.textContent = hour + ":" + min + ":" + sec;
            myClock.innerHTML = hour + ":" + min + ":" + sec;
            var ti = setTimeout(function(){ clockedTime() }, 1000);
        }   
    } 
    
        renderTime();
</script>