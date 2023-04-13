<?php

namespace App\Http\Controllers\admin;

use App\Models\course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class coursecontroller extends Controller
{

    public function index()
    {
        $courses = course::orderByDesc('id')->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = course::all();
        return view('admin.courses.create' , compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'price'   => 'required',
            'name'   => 'required',
            'content' => 'required',
            'time'   => 'required',
            'level'   => 'required',
            'image'   => 'required',
            'team_id' =>'required'
        ]);
        // Upload images
                $image_name = null;
                if($request->hasFile('image')) {
                    $image = $request->file('image');
                    $image_name = rand(). time().$image->getClientOriginalName();
                    $image->move(public_path('uploads/courses'), $image_name);
                }
                  // Store To Database
        course::create([
            'price'   =>  $request->price,
            'name' =>  $request->name,
            'content'   =>  $request->content,
            'time'   =>  $request->time,
            'level'   =>  $request->level,
            'image'   =>  $image_name,
            'team_id' =>$request->team_id
            ]);

         // Redirect
         return redirect()->route('admin.courses.index')->with('msg', 'course added successfully')->with('type', 'success');

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
        $course = course::findOrFail($id);
        $courses = course::all();

        return view('admin.courses.edit', compact('course', 'courses'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate Data
        $request->validate([
            'price'   => 'required',
            'name'   => 'required',
            'content' => 'required',
            'time'   => 'required',
            'level'   => 'required',
            'image'   => 'required',
            'team_id' =>'required'
            ]);

        $course = course::findOrFail($id);

          // Upload images
          $image_name = $course->image;
          if($request->hasFile('image')) {
              $image = $request->file('image');
              $image_name = rand(). time().$image->getClientOriginalName();
              $image->move(public_path('uploads/courses'), $image_name);
          }

          // Store To Database
          $course->update([
            'price'   =>  $request->price,
            'name' =>  $request->name,
            'content'   =>  $request->content,
            'time'   =>  $request->time,
            'level'   =>  $request->level,
            'image'   =>  $image_name,
            'team_id'   =>  $request->team_id,
            ]);

          // Redirect
          return redirect()->route('admin.courses.index')->with('msg', 'course updated successfully')->with('type', 'info');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = course::findOrFail($id);

        File::delete(public_path('uploads/courses/'.$course->image));


        $course->delete();

        return redirect()->route('admin.courses.index')->with('msg', 'course deleted successfully')->with('type', 'danger');

    }

    public function trash()
    {
        $courses = course::onlyTrashed()->orderByDesc('id')->paginate(10);

        return view('admin.courses.trash', compact('courses'));
    }

    public function restore($id)
    {
        course::onlyTrashed()->find($id)->restore();

        return redirect()->route('admin.courses.index')->with('msg', 'course restored successfully')->with('type', 'warning');
    }

    public function forcedelete($id)
    {
        course::onlyTrashed()->find($id)->forcedelete();
        return redirect()->route('admin.courses.index')->with('msg', 'course deleted permanintly successfully')->with('type', 'danger');
    }
}
