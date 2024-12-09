<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Classroom;
use Illuminate\Http\Request;

class FacultyController extends Controller
{

    public function index()
    {
        $faculties=Faculty::get();
        return view('pages.faculity.index',compact('faculties'));
    }


    public function create()
    {
    }

    public function store(Request $request)
    {
        try{
            // Validate the incoming request
            $validated = $request->validate([
                'en_name' => 'required|string|max:255',
                'ar_name' => 'required|string|max:255',
                'notes' => 'nullable|string',
            ]);
            $faculity=new Faculty();
            $faculity->name = [
                'en' => $validated['en_name'],
                'ar' => $validated['ar_name'],
            ];
            $faculity->note= $validated['notes'];
            $faculity->save();
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Faculty created successfully.');
        }
        catch (\Exception $e) {
            // Log the exception or display an error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function show(Faculty $faculity)
    {
        //
    }


    public function edit(Faculty $faculity)
    {
        //
    }


    public function update(Request $request,$id)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'en_name' => 'required|string|max:255',
                'ar_name' => 'required|string|max:255',
                'notes' => 'nullable|string',
            ]);
            // Find the existing faculty by ID
            $faculty = Faculty::findOrFail($id);
            $faculty->name = [
                'en' => $validated['en_name'],
                'ar' => $validated['ar_name'],
            ];
            $faculty->note = $validated['notes'];
            $faculty->save();
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Faculty updated successfully.');
        } catch (\Exception $e) {
            // Log the exception or display an error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        // Find the faculty by ID
        $faculty = Faculty::findOrFail($id);

        // Delete the faculty
        $faculty->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Faculty deleted successfully.');
    }

    public function getClassrooms($id)
    {
        $classrooms = Classroom::where('faculty_id', $id)->get();
        return response()->json($classrooms);
    }
}
