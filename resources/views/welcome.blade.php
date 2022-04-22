<?php
 
$i = 0;
$allDataPoints = array();
 foreach($irrigations as $items)
 {
   array_push($allDataPoints, array("y" => $items['moisturemin'], "label" => $i),);
   $i++;
  }
$dataPoints = array_slice($allDataPoints,-120);
?>

@extends('layouts.app')

@section('content')


<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	axisY: {
		title: "Percentage (%)"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>


<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
<!-- Styles -->
<style>
.topnav {
  background-color: #329d9c;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #fff;
  text-align: center;
  padding: 28px 10px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

/* Title */
.topnav a.active {
  color: white;
  font-weight: thick;
  font-family: 'Roboto', sans-serif;
}
    html, body {
        background-color: #cff4d2;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }

    #chart {
  display: block;
  border-radius: 65px;
  border: 2px solid #fff;
  padding: 20px;
  width: 95%;
  height: 600px;
  background-color: #fff;
  margin: auto;
  margin-top: 20px;
  position: relative;
}    
#moist {
  display: inline-block;
  border-radius: 58px;
  border: 2px solid #fff;
  padding: 20px;
  width: 352px;
  height: 800px;
  background-color: #fff;
  margin: 20px;
  position: relative;
}    

.button1 {
    display: block;
    border-radius: 58px;
    border: 2px solid #329d9c;
    width: 270px;
    height: 59px;
    background-color: #329d9c;
    color: #fff;
    margin: 20px;
    position: absolute;
    text-align: center;
}

.button2 {
    display: block;
    border-radius: 58px;
    width: 130px;
    height: 42px;
    color: #fff;
    margin: 20px;
    position: absolute;
    text-align: center;
    pointer-events: none;
}

.button3 {
    display: block;
    border-radius: 58px;
    border: 2px solid #329d9c;
    width: 270px;
    height: 59px;
    background-color: #ff0000;
    color: #fff;
    margin: 20px;
    position: absolute;
    text-align: center;
}

/** Toggle Switch Styling */
.switch-wrap {
	 cursor: pointer;
	 background: #CFF4D2;
	 padding: 3px;
	 width: 60px;
	 height: 30px;
	 border-radius: 33.5px;
}
 .switch-wrap input {
	 position: absolute;
	 opacity: 0;
	 width: 0;
	 height: 0;
}
 .switch {
	 height: 100%;
	 display: grid;
	 grid-template-columns: 0fr 1fr 1fr;
	 transition: 0.2s;
}
 .switch::after {
	 content: '';
	 border-radius: 50%;
	 background: #ccc;
	 grid-column: 2;
	 transition: background 0.2s;
}
 input:checked + .switch {
	 grid-template-columns: 1fr 1fr 0fr;
}
 input:checked + .switch::after {
	 background-color: #fff;
}

}
</style>
<div class="content">
    <div class="topnav">
        <a href="{{ url('/') }}">Auto Irrrigation System - AIS</a>
        <a href="{{ url('lighting') }}">Lighting Information</a>
        <a href="{{ url('schedules') }}">View Schedule</a>
        <a href="{{ url('automated') }}">Automated Irrigations</a>
    </div>
    <div id="chart" style="font-weight: bold;font-size:30px;">
    <p style="font-weight: bold;text-align:center;font-size:30px;">Moisture</p>
    <div id="chartContainer" style="position: absolute ;height: 400px; width: 95%; text-align: center;"></div>
<script style="margin: 10px;" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        @php $currMoist = end($irrigations);@endphp
        <div style="font-weight: bold;text-align:left;font-size:30px; position: aboslute; top: 40px;">{{ $currMoist['moisturemin'] }}</div>
        @if($pumpSignal == 3)
        <a href="{{ url('control/pumpOff') }}" class="button3" style="text-decoration: none;bottom: 0; right: 0;font-weight: bold;text-align:center;font-size:30px;">Irrigate<a>
        @else
        <a href="{{ url('control/pumpOn') }}" class="button1" style="text-decoration: none;bottom: 0; right: 0;font-weight: bold;text-align:center;font-size:30px;">Irrigate</a>
        @endif
</div>
</div>
@endsection
