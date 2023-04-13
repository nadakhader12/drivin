<?php

namespace App\Http\Controllers\admin;

use App\Models\fact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class factcontroller extends Controller
{

    public function index()
    {
        $facts = fact::orderByDesc('id')->paginate(10);

        return view('admin.facts.index', compact('facts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facts = fact::all();
        return view('admin.facts.create' , compact('facts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'icon'   => 'required',
            'type'   => 'required',
        ]);
        // Upload icons
                $icon_name = null;
                if($request->hasFile('icon')) {
                    $icon = $request->file('icon');
                    $icon_name = rand(). time().$icon->getClientOriginalName();
                    $icon->move(public_path('uploads/facts'), $icon_name);
                }
                  // Store To Database
        fact::create([
            'title'   =>  $request->title,
            'content' =>  $request->content,
            'icon'   =>  $icon_name,
            'type'   =>  $request->type,
            ]);

         // Redirect
         return redirect()->route('admin.facts.index')->with('msg', 'fact added successfully')->with('type', 'success');

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
        $fact = fact::findOrFail($id);
        $facts = fact::all();

        return view('admin.facts.edit', compact('fact', 'facts'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Data
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'icon'   => 'required',
            'type'   => 'required',
            ]);

        $fact = fact::findOrFail($id);

          // Upload icons
          $icon_name = $fact->icon;
          if($request->hasFile('icon')) {
              $icon = $request->file('icon');
              $icon_name = rand(). time().$icon->getClientOriginalName();
              $icon->move(public_path('uploads/facts'), $icon_name);
          }

          // Store To Database
          $fact->update([
            'title'   =>  $request->title,
            'content' =>  $request->content,
            'icon'   =>  $icon_name,
            'type' =>  $request->type,
            ]);

          // Redirect
          return redirect()->route('admin.facts.index')->with('msg', 'fact updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fact = fact::findOrFail($id);

        File::delete(public_path('uploads/facts/'.$fact->icon));


        $fact->delete();

        return redirect()->route('admin.facts.index')->with('msg', 'fact deleted successfully')->with('type', 'danger');

    }

    public function trash()
    {
        $facts = fact::onlyTrashed()->orderByDesc('id')->paginate(10);

        return view('admin.facts.trash', compact('facts'));
    }

    public function restore($id)
    {
        fact::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.facts.index')->with('msg', 'fact restored successfully')->with('type', 'warning');
    }

    public function forcedelete($id)
    {
        fact::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.facts.index')->with('msg', 'fact deleted permanintly successfully')->with('type', 'danger');
    }
}
