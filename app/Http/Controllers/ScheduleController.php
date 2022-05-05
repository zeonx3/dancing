<?php

namespace App\Http\Controllers;

use App\Models\schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use View;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = schedule::paginate(5);

        return view('schedule.index')->with('schedules', $schedule);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedule.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Dancer'=> 'required|max:50',
            'Date' => 'required',
            'Hour'=> 'required'
        ]);

        $schedule = Schedule::create($request->only('Dancer','Date','Hour'));

        Session::flash('mensaje', 'Schedule saved');
        return redirect()->route('schedule.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(schedule $schedule)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(schedule $schedule)
    {
        return view('schedule.form')
        ->with('schedule',$schedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, schedule $schedule)
    {
        $request->validate([
            'Dancer'=> 'required|max:50',
            'Date' => 'required',
            'Hour'=> 'required'
        ]);

        $schedule ->Dancer = $request['Dancer'];
        $schedule ->Date  = $request['Date'];
        $schedule ->Hour = $request['Hour'];
        $schedule->save();

        Session::flash('mensaje', 'Schedule updated');
        return redirect()->route('schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(schedule $schedule)
    {
        $schedule->delete();
        Session::flash('mensaje', 'Schedule deleted');
        return redirect()->route('schedule.index');
    }
}
