<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Doctor;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index(){
        $doctors=Doctor::get();
        return view('pages.doctors.index',compact('doctors'));
    }

    public function create(){
        $data['faculties'] = Faculty::get();
        $data['classrooms'] = Classroom::get();
        $data['sections'] = Section::get();
        $data['nationalities'] = Nationality::get();
        $data['genders'] = Gender::get();
        $data['religions'] = Religion::get();
        return view('pages.doctors.create',$data);
    }

    public function store(Request $request){
        // Validate the input fields
        $validated=$request->validate([
            'en_name' => 'required|string|max:255',
            'ar_name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|string|min:8',
            'gender_id' => 'required',
            'nationality_id' => 'required',
            'religion_id' => 'required',
            'faculty_id' => 'required',
            'section_id' => 'required',
            'classroom_id' => 'required',
            'classroom_id.*' => 'exists:classrooms,id',
        ]);

        $doctor=new Doctor();
        $doctor->name = [
            'en' => $validated['en_name'],
            'ar' => $validated['ar_name'],
        ];
        $doctor->email = $request->email;
        $doctor->password = Hash::make($request->password);
        $doctor->gender_id = $request->gender_id;
        $doctor->nationality_id = $request->nationality_id;
        $doctor->religion_id = $request->religion_id;
        $doctor->faculty_id = $request->faculty_id;
        $doctor->section_id = $request->section_id;
        $doctor->save();

        // Attach classrooms
        $doctor->classrooms()->sync($request->classroom_id);

        // Redirect back with success message
        return redirect()->route('doctor.index')->with('success', __('Doctor created successfully.'));
    }

    public function edit($id)
    {
        $data['doctor'] = Doctor::findOrFail($id); // Fetch the doctor by ID
        $data['faculties'] = Faculty::get();
        $data['classrooms'] = Classroom::get();
        $data['sections'] = Section::get();
        $data['nationalities'] = Nationality::get();
        $data['genders'] = Gender::get();
        $data['religions'] = Religion::get();
        return view('pages.doctors.edit', $data);
    }

    public function update(Request $request, $id)
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
                'classroom_id' => 'required',
                'classroom_id.*' => 'exists:classrooms,id',
            ]);
            // Find the existing faculty by ID
            $doctor = Doctor::findOrFail($id);
            $doctor->name = [
                'en' => $validated['en_name'],
                'ar' => $validated['ar_name'],
            ];
            $doctor->email = $validated['email'];
            $doctor->gender_id = $validated['gender_id'];
            $doctor->nationality_id = $validated['nationality_id'];
            $doctor->religion_id = $validated['religion_id'];
            $doctor->faculty_id = $validated['faculty_id'];
            $doctor->section_id = $validated['section_id'];
            if ($request->filled('password')) { // Only update password if provided
                $doctor->password = bcrypt($request->password);
            }
            $doctor->save();

            // Attach classrooms
            $doctor->classrooms()->sync($request->classroom_id);
            
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Doctor updated successfully.');
        } catch (\Exception $e) {
            // Log the exception or display an error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        // Find the doctor by ID
        $doctor = Doctor::findOrFail($id);

        // Delete the faculty
        $doctor->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Doctor deleted successfully.');
    }

}
