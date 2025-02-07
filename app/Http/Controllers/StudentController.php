<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Doctor;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Section;
use App\Models\MyParent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::get();
        return view('pages.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['faculties'] = Faculty::get();
        $data['classrooms'] = Classroom::get();
        $data['sections'] = Section::get();
        $data['nationalities'] = Nationality::get();
        $data['genders'] = Gender::get();
        $data['religions'] = Religion::get();
        $data['parents'] = Myparent::get();
        return view('pages.students.create', $data);
    }

    public function store(Request $request)
    {
        // Validate the input fields
        $validated = $request->validate([
            'en_name' => 'required|string|max:255',
            'ar_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8',
            'parent_id' => 'required',
            'gender_id' => 'required',
            'nationality_id' => 'required',
            'religion_id' => 'required',
            'faculty_id' => 'required',
            'section_id' => 'required',
            'classroom_id' => 'required',
            'classroom_id.*' => 'exists:classrooms,id',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $student = new Student();
        $student->name = [
            'en' => $validated['en_name'],
            'ar' => $validated['ar_name'],
        ];
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->gender_id = $request->gender_id;
        $student->nationality_id = $request->nationality_id;
        $student->relegion_id = $request->religion_id;
        $student->faculty_id = $request->faculty_id;
        $student->section_id = $request->section_id;
        $student->parent_id = $request->parent_id;
        $student->save();

        // Attach classrooms
        $student->classrooms()->sync($request->classroom_id);

        // Handle the uploaded file
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images', $filename); // Store in the 'storage/app/public/images' folder

            // Create an image record
            $student->images()->create([
                'filename' => $filename,
            ]);
        }

        // Redirect back with success message
        return redirect()->route('student.index')->with('success', __('Student created successfully.'));
    }

    public function show($id)
    {
        $student = Student::with(['images', 'faculties', 'classrooms', 'sections', 'nationalies', 'genders', 'religions', 'parents'])->findOrFail($id);

        return view('pages.students.show', compact('student'));
    }

    public function edit($id)
    {
        $data['student'] = Student::findOrFail($id); // Fetch the doctor by ID
        $data['faculties'] = Faculty::get();
        $data['classrooms'] = Classroom::get();
        $data['sections'] = Section::get();
        $data['nationalities'] = Nationality::get();
        $data['genders'] = Gender::get();
        $data['religions'] = Religion::get();
        $data['parents'] = MyParent::get();
        return view('pages.students.edit', $data);
    }

    public function update(Request $request,$id)
    {
        try {
            // Validate the incoming request
            $validated = $request->validate([
                'en_name' => 'required|string|max:255',
                'ar_name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'nullable|string|min:8',
                'gender_id' => 'required',
                'nationality_id' => 'required',
                'religion_id' => 'required',
                'faculty_id' => 'required',
                'section_id' => 'required',
                'parent_id' => 'required',
                'classroom_id' => 'required',
                'classroom_id.*' => 'exists:classrooms,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            // Find the existing faculty by ID
            $student = Student::findOrFail($id);
            $student->name = [
                'en' => $validated['en_name'],
                'ar' => $validated['ar_name'],
            ];
            $student->email = $validated['email'];
            $student->gender_id = $validated['gender_id'];
            $student->nationality_id = $validated['nationality_id'];
            $student->relegion_id = $validated['religion_id'];
            $student->faculty_id = $validated['faculty_id'];
            $student->section_id = $validated['section_id'];
            if ($request->filled('password')) { // Only update password if provided
                $student->password = bcrypt($request->password);
            }
            $student->save();

            // Attach classrooms
            $student->classrooms()->sync($request->classroom_id);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($student->images->isNotEmpty()) {
                    Storage::delete('public/images/' . $student->images->first()->filename);
                    $student->images->first()->delete(); // Adjust if multiple images
                }

                // Upload new image
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/images', $filename);

                // Save new image record
                $student->images()->create([
                    'filename' => $filename,
                ]);
            }

            // Redirect back with a success message
            return redirect()->back()->with('success', 'student updated successfully.');
        } catch (\Exception $e) {
            // Log the exception or display an error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        // Find the doctor by ID
        $student = Student::findOrFail($id);
        // Delete the related image from storage and database
        // dd($student->images);
        $image = $student->images()->first(); // Using first() if it's a one-to-one relationship

        if ($image) {
            $path = 'public/images/' . $image->filename;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
            $image->delete();
        }

        // Delete the faculty
        $student->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Student deleted successfully.');
    }

    public function upload_attachments(Request $request, $imageableId, $imageableType){
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/images', $filename); // Store in the 'storage/app/public/images' folder

            Image::create([
                'filename' => $filename,
                'imageable_id' => $imageableId,
                'imageable_type' => $imageableType,
            ]);
        }
        return redirect()->back()->with('success', 'File uploaded successfully.');

    }


    public function download($id){
        $image = Image::findOrFail($id);
        $path = 'public/images/' . $image->filename;  // Construct the path using the filename
        // dd(Storage::path($path));
        if (Storage::exists($path)) {
            return Storage::download($path, $image->filename);  // Download the file
        }

         return redirect()->back()->with('error', 'File not found.');
    }

    public function delete_image($id){
        $image = Image::findOrFail($id);

        // Construct the file path
        $path = 'public/images/' . $image->filename;

        // Delete the file from storage if it exists
        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        // Delete the record from the database
        $image->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }
}
