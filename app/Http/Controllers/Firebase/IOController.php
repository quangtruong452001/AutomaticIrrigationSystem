<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;


class IOController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePumpOn()
    {
        //
        $Signal = 3;
        $schedule = $this->database->getReference('pump')->push($Signal);
        return redirect('/');
        
    }

    public function storePumpOff()
    {
        //
        $Signal = 4;
        $schedule = $this->database->getReference('pump')->push($Signal);
        return redirect('/');
        
    }

    public function storeLedOn()
    {
        //
        $Signal = 1;
        $schedule = $this->database->getReference('led')->push($Signal);
        return redirect('/');
    }

    public function storeLedOff()
    {
        //
        $Signal = 0;
        $schedule = $this->database->getReference('led')->push($Signal);
        return redirect('/');
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
    }
}
