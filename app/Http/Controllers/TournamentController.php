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

        $categories = Tournament::select( 'category' )->groupBy( 'category' )->get();

        $countries = Tournament::select( 'country' )->groupBy( 'country' )->get();

        $cities = Tournament::select( 'city' )->groupBy( 'city' )->get();

        return view( 'tournaments.index',
        compact( 'tournaments', 'categories', 'countries', 'cities' ) );
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
            'name'      => 'required|string|max:50',
            'category'  => 'required',
            'begin'     => 'required|date',
            'end'       => 'required|date',
            'country'   => 'required',
            'city'      => 'required',
            'address'   => 'required',
            'website'   => 'required|url',
            'user_id'   => 'required'
        ]);
        $tournament = new Tournament([
            'name'      => $request->get('name'),
            'category'  => $request->get('category'),
            'begin'     => $request->get('begin'),
            'end'       => $request->get('end'),
            'country'   => $request->get('country'),
            'city'      => $request->get('city'),
            'address'   => $request->get('address'),
            'latitude'  => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'website'   => $request->get('website'),
            'user_id'   => $request->get('user_id')
        ]);
        $tournament->save();

        return redirect( '/mytournaments' )
        ->with( 'success', $tournament->name . __('message.added') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $tournament = Tournament::find($id);

      return view( 'tournaments.view', compact('tournament') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tournament = Tournament::find($id);

        $currentUser = \Auth::user()->id;
        $user        = $tournament->user_id;

        if( $user == $currentUser ) {
            return view( 'tournaments.edit', compact('tournament') );
        }
        else {
          return redirect( '/mytournaments' )
          ->with( 'primary', __('message.not allowed') );
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
        $request->validate([
            'name'     => 'required',
            'category' => 'required',
            'begin'    => 'required|date',
            'end'      => 'required|date',
            'country'  => 'required',
            'city'     => 'required',
            'address'  => 'required',
            'website'  => 'required|url',
            'user_id'  => 'required'
        ]);

        $tournament = Tournament::find($id);
        $tournament->name      = $request->get('name');
        $tournament->category  = $request->get('category');
        $tournament->begin     = $request->get('begin');
        $tournament->end       = $request->get('end');
        $tournament->country   = $request->get('country');
        $tournament->city      = $request->get('city');
        $tournament->address   = $request->get('address');
        $tournament->latitude  = $request->get('latitude');
        $tournament->longitude = $request->get('longitude');
        $tournament->website   = $request->get('website');
        $tournament->user_id   = $request->get('user_id');
        $tournament->save();

        return redirect( '/mytournaments' )
        ->with( 'success', $tournament->name . __('message.updated') );
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

        return redirect( '/mytournaments' )
        ->with( 'success', $tournament->name . __('message.deleted') );
    }

}
