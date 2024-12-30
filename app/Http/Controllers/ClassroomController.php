<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['faculties']= Faculty::get();
        $data['classrooms']= Classroom::get();
        $data['sections']= Section::get();
        return view('pages.classrooms.index',$data);
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


    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'en_name' => 'required|string|max:255',
                'ar_name' => 'required|string|max:255',
                'faculty_id' => 'required',
                'section_id' => 'required',
            ]);
            $classroom = new Classroom();
            $classroom->name = [
                'en' => $validated['en_name'],
                'ar' => $validated['ar_name'],
            ];
            $classroom->faculty_id = $validated['faculty_id'];
            $classroom->section_id = $validated['section_id'];
            $classroom->save();
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Classroom created successfully.');
        } catch (\Exception $e) {
            // Log the exception or display an error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {

        try {
            // Validate the incoming request
            $validated = $request->validate([
                'en_name' => 'required|string|max:255',
                'ar_name' => 'required|string|max:255',
                'faculty_id' => 'required',
                'section_id' => 'required',
            ]);
            $classroom =Classroom::findOrFail($id);
            $classroom->name = [
                'en' => $validated['en_name'],
                'ar' => $validated['ar_name'],
            ];
            $classroom->faculty_id = $validated['faculty_id'];
            $classroom->section_id = $validated['section_id'];
            $classroom->save();
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Classroom edited successfully.');
        } catch (\Exception $e) {
            // Log the exception or display an error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        // Find the faculty by ID
        $classroom = Classroom::findOrFail($id);

        // Delete the faculty
        $classroom->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Classroom deleted successfully.');
    }
}
