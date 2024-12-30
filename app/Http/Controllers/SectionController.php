<?php

namespace App\Http\Controllers;
use App\Models\Section;
use App\Models\Faculty;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['faculties'] = Faculty::get();
        $data['sections'] = Section::get();
        return view('pages.sections.index', $data);
    }

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
                'status' => 'required',
            ]);
            $section = new Section();
            $section->name = [
                'en' => $validated['en_name'],
                'ar' => $validated['ar_name'],
            ];
            $section->faculty_id = $validated['faculty_id'];
            $section->status = $validated['status'];
            $section->save();
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Section created successfully.');
        } catch (\Exception $e) {
            // Log the exception or display an error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function edit(Section $section)
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
                'status' => 'required',
            ]);
            $section =Section::findOrFail($id);
            $section->name = [
                'en' => $validated['en_name'],
                'ar' => $validated['ar_name'],
            ];
            $section->faculty_id = $validated['faculty_id'];
            $section->status = $validated['status'];
            $section->save();
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Section edited successfully.');
        } catch (\Exception $e) {
            // Log the exception or display an error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        // Find the faculty by ID
        $section = Section::findOrFail($id);

        // Delete the faculty
        $section->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Section deleted successfully.');
    }

    public function getSectionsByFaculty($facultyId)
    {
        $sections = Section::where('faculty_id', $facultyId)->get(['id', 'name']);
        return response()->json(['sections' => $sections]);
    }

}
