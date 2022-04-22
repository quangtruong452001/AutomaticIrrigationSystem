@extends('layouts.app')

@section('content')

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

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

.body {
background-image: #CFF4D2;
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
        font-family: 'Roboto', sans-serif;
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
}
</style>
<div class="topnav">
        <a href="{{ url('/') }}">Auto Irrrigation System - AIS</a>
        <a href="{{ url('lighting') }}">Lighting Information</a>
        <a href="{{ url('schedules') }}">View Schedule</a>
        <a href="{{ url('automated') }}">Automated Irrigations</a>
</div>
<div class ="container">
<main class="c-main">
    <div class="c-body">
        <div class="container" style = "border-radius: 35px;margin: 40px;">
            <form action="{{ url('schedules/create') }}" enctype="multipart/form-data" method="POST" style="text-align:left;">
                <div class="row">
                    @csrf
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label" for="date">Date of irrigation</label>
                                    <input class="form-control" id="date" name="date" type="date">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="start">Start time</label>
                                    <input class="form-control" id="start" name="start" type="time">
                                </div>

                                <button type="submit" class="btn btn-primary mb-3">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
</div>
@endsection