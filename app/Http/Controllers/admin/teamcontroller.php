<?php

namespace App\Http\Controllers\admin;

use App\Models\team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class teamcontroller extends Controller
{

    public function index()
    {
        $teams = team::orderByDesc('id')->paginate(10);

        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = team::all();
        return view('admin.teams.create' , compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'image' => 'required',
        ]);
        // Upload images
                $image_name = null;
                if($request->hasFile('image')) {
                    $image = $request->file('image');
                    $image_name = rand(). time().$image->getClientOriginalName();
                    $image->move(public_path('uploads/teams'), $image_name);
                }
                  // Store To Database
        team::create([
            'name'   =>  $request->name,
            'image'   =>  $image_name,
            ]);

         // Redirect
         return redirect()->route('admin.teams.index')->with('msg', 'team added successfully')->with('type', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = team::findOrFail($id);
        $teams = team::all();

        return view('admin.teams.edit', compact('team', 'teams'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Data
        $request->validate([
            'name'   => 'required',
            'image'   => 'required',
            ]);

        $team = team::findOrFail($id);

          // Upload images
          $image_name = $team->image;
          if($request->hasFile('image')) {
              $image = $request->file('image');
              $image_name = rand(). time().$image->getClientOriginalName();
              $image->move(public_path('uploads/teams'), $image_name);
          }

          // Store To Database
          $team->update([
            'name'   =>  $request->name,
            'image'   =>  $image_name,
            ]);

          // Redirect
          return redirect()->route('admin.teams.index')->with('msg', 'team updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = team::findOrFail($id);

        File::delete(public_path('uploads/teams/'.$team->image));


        $team->delete();

        return redirect()->route('admin.teams.index')->with('msg', 'team deleted successfully')->with('type', 'danger');

    }

    public function trash()
    {
        $teams = team::onlyTrashed()->orderByDesc('id')->paginate(10);

        return view('admin.teams.trash', compact('teams'));
    }

    public function restore($id)
    {
        team::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.teams.index')->with('msg', 'team restored successfully')->with('type', 'warning');
    }

    public function forcedelete($id)
    {
        team::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.teams.index')->with('msg', 'team deleted permanintly successfully')->with('type', 'danger');
    }
}
