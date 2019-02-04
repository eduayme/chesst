<?php

namespace ChessT\Http\Controllers;

use Auth;
use Carbon\Carbon;
use ChessT\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Tournament::all()->where( 'end', '>=', Carbon::today() );

        return view( 'tournaments.index', compact('tournaments') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( Auth::check() ) {
          return view( 'tournaments.create' );
        }
        else {
          return redirect()->intended( '../login' );
        }
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
            'name'     => 'required|string|max:50',
            'category' => 'required',
            'begin'    => 'required|date',
            'end'      => 'required|date',
            'country'  => 'required',
            'city'     => 'required',
            'website'  => 'required|url',
            'user_id'  => 'required'
        ]);
        $tournament = new Tournament([
            'name'     => $request->get('name'),
            'category' => $request->get('category'),
            'begin'    => $request->get('begin'),
            'end'      => $request->get('end'),
            'country'  => $request->get('country'),
            'city'     => $request->get('city'),
            'website'  => $request->get('website'),
            'user_id'  => $request->get('user_id')
        ]);
        $tournament->save();
        return redirect('/tournaments')->with('success', $tournament->name .' has been added');
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
        /**
        $tournament = Tournament::find($id);

        return view('tournaments.edit', compact('tournament'));
         */
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
        $request->validate([
            'name'     => 'required',
            'category' => 'required',
            'begin'    => 'required|date',
            'end'      => 'required|date',
            'country'  => 'required',
            'city'     => 'required',
            'website'  => 'required|url',
            'user_id'  => 'required'
        ]);

        $tournament = Tournament::find($id);
        $tournament->name     = $request->get('name');
        $tournament->category = $request->get('category');
        $tournament->begin    = $request->get('begin');
        $tournament->end      = $request->get('end');
        $tournament->country  = $request->get('country');
        $tournament->city     = $request->get('city');
        $tournament->website  = $request->get('website');
        $tournament->user_id  = $request->get('user_id');
        $tournament->save();

        return redirect('/tournaments')->with('success', $tournament->name .' has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tournament = Tournament::find($id);
        $tournament->delete();

        return redirect('/tournaments')->with('success', $tournament->name .' has been deleted Successfully');
    }

}
