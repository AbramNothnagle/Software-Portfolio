<?php
    include_once 'header.php';
?>

<style>
#clockin:hover{
    background-color:#1b7935;
}
#clockout:hover{
    background-color:#7c0e0e;
}
</style>


<section class="main-container">
    <div class="main-wrapper">
        <h2>Clock</h2>

        <div id="clockDisplay" class="clockStyle" style="    
        background-color:#000;
        border: 2px #999 2px inset;
        padding: 6px;
        color: #0ff;
        font-family:'Arial Black', Gadget, sans-serif;
        font-size:16px;
        font-weight: bold;
        letter-spacing: 2px;
        display: inline;">
        
        </div>

        <?php

        include 'includes/dbh.inc.php';
        include 'clockbox.php';

        ?>
        
        <div id="clockedDisplay" class="clockStyle" style="    
        background-color:#000;
        position: absolute;
        margin-top: 115px;
        margin-left: -250px;
        border: 2px #999 2px inset;
        padding: 6px;
        color: #0ff;
        font-family:'Arial Black', Gadget, sans-serif;
        font-size:41px;
        font-weight: bold;
        letter-spacing: 20px;
        height: 60px;
        display: inline;">00:00:00
        </div>

    </div>
</section>

<form method=POST>
<input id='time6' type='text' name='time6' value='00' style='margin-left:550px; margin-top: 15%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time7' type='text' name='time7' value='00' style='margin-left:550px; margin-top: 15%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time8' type='text' name='time8' value='00' style='margin-left:550px; margin-top: 15%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time9' type='text' name='time9' value='00' style='margin-left:550px; margin-top: 15%;width:0;height:0;z-index:-9;position:absolute'>
<input id='time10' type='text' name='time10' value='00' style='margin-left:550px; margin-top: 15%;width:0;height:0;z-index:-9;position:absolute'>
<button  id = 'btn' type ='submit' name='submitsendtime' style=' position: fixed; width: 180px; margin-left:550px; margin-top: 12%;
height: 30px;
border: none;
background-color: black;
font-family: arial;
font-size: 16px;
color: white;
cursor: pointer;'
>Submit</button></form>

<div style='position:absolute; left:40%; top:80%;'id='infoclock'><p></p><div>

<script>
   

    var pause = "false";
    var hr = 0;
    var mi = 0;
    var se = 0;

    function changebtn(){
        document.getElementById("clockin").style.display = "none";
        document.getElementById("clockingray").style.display = "block";
        document.getElementById("clockout").style.display = "block";
        document.getElementById("clockoutgray").style.display = "none";
        document.getElementById("time4").value = Date();
        displayStartTime()
        pause = "true";
        clockedTime();
    }
    function changebtnTwo(){
        document.getElementById("clockin").style.display = "block";
        document.getElementById("clockin").style.marginLeft = "0px";
        document.getElementById("clockingray").style.display = "none";
        document.getElementById("clockout").style.display = "none";
        document.getElementById("clockoutgray").style.display = "block";
        document.getElementById("clockoutgray").style.marginLeft = "180px";
        document.getElementById("time5").value = Date();
        pause = "false";   
        renderTime();

        
    }
    
    var h, m ,s;

    
    function displayStartTime(){
        document.getElementById('infoclock').innerHTML = "You Clocked in at : " + h + ":" + m + ":" + s;
    }

    function renderTime(){
        
        var currentTime = new Date();
        var diem = "AM";
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
        
        
        var t = setTimeout(function(){ renderTime() }, 500);
        
        
    }

    function clockedTime(){
        
        // Hand written clock
        
        se = se + 1;

        if (se == 60){
            mi = mi + 1;
            se = 0;
        } 
        if (mi == 60){
            mi = 0;
            hr = hr + 1;
        }
        
        var hour = "";
        var min = "";
        var sec = "";

        if (hr < 10){
            hour = "0" + hr;
        } else{
            hour = hr;
        }
        if (mi < 10){
            min = "0" + mi;
        } else {
            min = mi;
        }
        if (se < 10){
            sec = "0" + se;
        } else{
            sec = se;
        }
        document.getElementById('time1').value = hour;
        document.getElementById('time2').value = min;
        document.getElementById('time3').value = sec;

        if (pause != "false"){
            var myClock = document.getElementById('clockedDisplay');
            myClock.textContent = hour + ":" + min + ":" + sec;
            myClock.innerHTML = hour + ":" + min + ":" + sec;
            var ti = setTimeout(function(){ clockedTime() }, 1000);
        } else {   
            hr = 0;
            mi = 0;
            se = 0;
        }
    } 
    
        renderTime();
</script>

<?php
    include_once 'footer.php';
?>



