@extends('layouts.app')

@section('content')
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
  display: inline-block;
  border-radius: 65px;
  border: 2px solid #fff;
  padding: 20px;
  width: 912px;
  height: 800px;
  background-color: #fff;
  margin: 20px;
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

#report {
  display: inline-block;
  border-radius: 58px;
  border: 2px solid #fff;
  padding: 20px;
  width: 1324px;
  height: 180px;
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
        <a>Auto Irrrigation System - AIS</a>
        <a href="{{ route('schedules')}}">View Schedule</a>
    </div>
    <div id="chart" style="font-weight: bold;font-size:30px;">
    <p style="font-weight: bold;text-align:center;font-size:30px;">Chart Placeholder</p>
</div>
    <div id="moist">
        <p style="font-weight: bold;text-align:left;font-size:30px;">Moisture</p>
        <button class="button1" style="bottom: 0;font-weight: bold;text-align:center;font-size:30px;" onclick="alert('Not Yet Available')">Irrigate Now</button>
        <div style="position:absolute; bottom: 100px; left: 50px;font-weight: bold;text-align:center;font-size:30px;">Auto Lighting
        <label class="switch-wrap">
        <input type="checkbox" />
        <div class="switch"></div>
        <div style="position:absolute; bottom: 60px; left: 5px;font-weight: bold;text-align:center;font-size:30px;">Auto Irrigate
        <label class="switch-wrap">
        <input type="checkbox" />
        <div class="switch"></div>
    </div>
        </label>
</div>
@endsection
