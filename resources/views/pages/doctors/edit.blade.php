@extends('layouts.master')

@section('title')
{{ __("university.edit_doctor") }}
@endsection

@section('style')
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- Display success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <!-- Display error message -->
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __("university.edit_doctor") }} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ __("university.home") }}</a></li>
              <li class="breadcrumb-item active">{{ __("university.edit_doctor") }} </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
          <!-- Form doctor -->
        <div class="card">
            <div class="card-body">
                 <div class="max-w-4xl mx-auto p-4 bg-white shadow-md rounded-md">
                        <form action="{{ route('doctor.update', $doctor->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>{{ __("doctor.en_name") }}</label>
                                        <input type="text" name="en_name" class="form-control" value="{{ old('en_name', $doctor->name['en']) }}">
                                        @error('en_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>{{ __("doctor.ar_name") }}</label>
                                        <input type="text" name="ar_name" class="form-control" value="{{ old('ar_name', $doctor->name['ar']) }}">
                                        @error('ar_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>{{ __("parents.email") }}</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label>{{ __("doctor.password") }}</label>
                                    <input type="password" name="password" class="form-control" placeholder="{{ __('Leave blank to keep current password') }}">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>{{ __("parents.gender") }}</label>
                                            <select name="gender_id" class="form-control select2">
                                                <option value="">---</option>
                                                @foreach ($genders as $gender)
                                                    <option value="{{ $gender->id }}" {{ $gender->id == old('gender_id', $doctor->gender_id) ? 'selected' : '' }}>
                                                        {{ $gender->name[LaravelLocalization::getCurrentLocale()] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @error('gender_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>{{ __("parents.nationality") }}</label>
                                            <select name="nationality_id" class="form-control select2">
                                                <option value="">---</option>
                                                @foreach ($nationalities as $nationality)
                                                    <option value="{{ $nationality->id }}" {{ $nationality->id == old('nationality_id', $doctor->nationality_id) ? 'selected' : '' }}>
                                                        {{ $nationality->name[LaravelLocalization::getCurrentLocale()] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @error('nationality_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>{{ __("parents.Relegion") }}</label>
                                            <select name="religion_id" class="form-control select2">
                                                <option value="">---</option>
                                                @foreach ($religions as $religion)
                                                    <option value="{{ $religion->id }}" {{ $religion->id == old('religion_id', $doctor->religion_id) ? 'selected' : '' }}>
                                                        {{ $religion->name[LaravelLocalization::getCurrentLocale()] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @error('religion_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                            <label>{{ __("doctor.faculty") }}</label>
                                            <select name="faculty_id" class="form-control select2" id="facultySelect">
                                                <option value="">---</option>
                                                @foreach ($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}" {{ $faculty->id == old('faculty_id', $doctor->faculty_id) ? 'selected' : '' }}>
                                                        {{ $faculty->name[LaravelLocalization::getCurrentLocale()] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('faculty_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                            <label>{{ __("doctor.section") }}</label>
                                            <select name="section_id" class="form-control select2" id="sectionSelect">
                                                <option value="">---</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}" {{ $section->id == old('section_id', $doctor->section_id) ? 'selected' : '' }} data-faculty-id="{{ $section->faculty_id }}">
                                                        {{ $section->name[LaravelLocalization::getCurrentLocale()] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('section_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>{{ __("doctor.classroom") }}</label>
                                        <select name="classroom_id[]" class="form-control select2" id="classroomSelect" multiple>
                                            <option value="">---</option>
                                            @foreach ($classrooms as $classroom)
                                                    <option value="{{ $classroom->id }}"
                                                        {{ in_array($classroom->id, old('classroom_id', $doctor->classrooms->pluck('id')->toArray())) ? 'selected' : '' }}
                                                        data-section-id="{{ $classroom->section_id }}">
                                                        {{ $classroom->name[LaravelLocalization::getCurrentLocale()] }}
                                                    </option>
                                            @endforeach
                                        </select>
                                        @error('classroom_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
            </div>
        </div>

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('js')
<script>
    $(document).ready(function() {
        // On faculty change, filter sections
        $('#facultySelect').on('change', function() {
            var selectedFacultyId = $(this).val(); // Get selected faculty ID
            $('#sectionSelect option').each(function() {
                var facultyId = $(this).data('faculty-id'); // Get the faculty_id of the section
                if (facultyId == selectedFacultyId || selectedFacultyId == "") {
                    $(this).show(); // Show sections that match
                } else {
                    $(this).hide(); // Hide sections that do not match
                }
            });
                //Reset the section dropdown to the first visible option or empty
                var firstVisibleOption = $('#sectionSelect option:visible').first();
                if (firstVisibleOption.length > 0) {
                    $('#sectionSelect').val(firstVisibleOption.val()); // Select the first visible option
                } else {
                    $('#sectionSelect').val(''); // Clear the selection if no options are visible
                }
        });
    });

    $(document).ready(function() {
        // On section change, filter classrooms
        $('#sectionSelect').on('change', function() {
            var selectedSectionId = $(this).val(); // Get selected section ID
            $('#classroomSelect option').each(function() {
                var sectionId = $(this).data('section-id'); // Get the section_id of the classroom
                if (sectionId == selectedSectionId || selectedSectionId == "") {
                    $(this).show(); // Show classrooms that match
                } else {
                    $(this).hide(); // Hide classrooms that do not match
                }
            });
            // Reset the classroom dropdown to the first visible option or empty
            var firstVisibleOption = $('#classroomSelect option:visible').first();
            if (firstVisibleOption.length > 0) {
                $('#classroomSelect').val(firstVisibleOption.val()); // Select the first visible option
            } else {
                $('#classroomSelect').val(''); // Clear the selection if no options are visible
            }
        });
    });
</script>
@endsection
