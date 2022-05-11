<?php

namespace App\Http\Controllers;

use App\Models\schedule;
use App\Models\hour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $sql = DB::table('schedules')
            ->join( 'hours', 'schedules.id_hours', '=' , 'hours.id'  )
            ->select('schedules.*', 'hours.hor_name')
            ->get();

        $schedule = DB::select($sql);

        return view('schedule.index')->with($schedule);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hours = hour::all();
        return view('schedule.form', compact('hours'));
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
            'Mail'=> 'required|max:50',
            'Date' => 'required',
            'id_hours'=> 'required'
        ]);

        $schedule = Schedule::create($request->only('Dancer','Mail','Date','id_hours'));

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
        $hours = hour::all();
        return view('schedule.form', compact('hours'))
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
            'Mail'=> 'required|max:50',
            'Date' => 'required',
            'id_hours'=> 'required'
        ]);

        $schedule ->Dancer = $request['Dancer'];
        $schedule ->Mail = $request['Mail'];
        $schedule ->Date  = $request['Date'];
        $schedule ->id_hours = $request['id_hours'];

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
