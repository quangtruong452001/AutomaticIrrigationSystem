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
background-color: #CFF4D2;
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

  .button1 {
    display: block;
    border-radius: 8px;
    border: 2px solid #329d9c;
    background-color: #fff;
    color: #329d9c;
    margin: 5px;
    margin-left: 5px;
    padding: 6px;
    position: absolute;
    text-align: center;
    vertical-align: middle;
    transition-duration: 0.4s;
    cursor: pointer;
}
    .button1:hover {
        background-color: #329d9c;
        color: #fff;
    }
    .container {
        display: inline-block;
        border-radius: 65px;
        border: 2px solid #fff;
        padding: 20px;
        background-color: #fff;
        margin: 20px;
        position: relative;
        width: 95%;
    }
    .tiles {
        font-size: 20px;
        margin:5px;
        padding: 5px;
        border-bottom: 1px solid #d1d1d1;
    }
 
</style>
<div class="content">
<div class="topnav">
        <a href="{{ url('/') }}">Auto Irrrigation System - AIS</a>
        <a href="{{ url('schedules') }}">View Schedule</a>
        <a href="{{ url('automated') }}">Automated Irrigations</a>
</div>
    <div class="container" style="position: relative;">
    <div class="row justify-content-center mt-5">
        <div class = "col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Automated Irrigations</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Start</th>
                            <th scope="col">Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1;@endphp
                        @forelse ($irrigations as $key=>$item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['start'] }}</td>
                            <td>{{ $item['minutes'] }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No Irrigations Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>

</div>

@endsection