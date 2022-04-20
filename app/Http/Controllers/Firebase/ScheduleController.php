<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class ScheduleController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'schedule';
    }

    public function home()
    {
        $schedules = $this->database->getReference($this->tablename)->getValue();
        $irrigations = $this->database->getReference('irrigations')->getValue();
        $pump = $this->database->getReference('pump')->getValue();
        $led = $this->database->getReference('light_sensor')->getValue();
        $pumpSignal = end($pump);
        $ledSignal = end($led);
        return view('welcome', compact('irrigations', 'pumpSignal', 'ledSignal'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $schedules = $this->database->getReference($this->tablename)->getValue();
        return view("firebase.schedule.index", compact('schedules'));
    }

    public function showAutomated()
    {
        //
        $irrigations = $this->database->getReference('irrigations')->getValue();
        return view("firebase.schedule.showAutomated", compact('irrigations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("firebase.schedule.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $schedule = [
            'date' => $request->date,
            'start' => $request->start,
            'moisturemin' => $request->moisturemin,
            'minutes' => $request->minutes,
        ];
        $schedule = $this->database->getReference($this->tablename)->push($schedule);
        return redirect('schedules');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $key = $id;
        $editData = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($editData)
        {
            return view('firebase.schedule.edit', compact('editData', 'key'));
        } else {
            return redirect('schedules');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $key = $id;
        $updateData = [
            'date' => $request->date,
            'start' => $request->start,
            'moisturemin' => $request->moisturemin,
            'minutes' => $request->minutes,
        ];
        $schedule = $this->database->getReference($this->tablename.'/'.$key)->update($updateData);
        return redirect('schedules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $key = $id;
        $deleteData = $this->database->getReference($this->tablename.'/'.$key)->remove($key);
        return redirect('schedules');
    }
}
