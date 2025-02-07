@extends('layouts.master')

@section('title')
{{__("university.students")}}
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
            <h1 class="m-0 text-dark">{{__("university.show_student")}} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__("university.home")}}</a></li>
              <li class="breadcrumb-item active">{{__("university.show_student")}} </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#showstudent" data-toggle="tab">{{__("university.show_student")}}</a></li>
                  <li class="nav-item"><a class="nav-link" href="#attachments" data-toggle="tab">{{__("university.Attachments")}}</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="showstudent">
                        <div class="row">
                        @foreach ($student->images as $image)
                                <img src="{{ asset('storage/images/' . $image->filename) }}"style="width:100px;" alt="Student Image">
                        @endforeach
                        </div>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                            <th>{{__("faculty.name")}}</th>
                            <th>{{__("parents.email")}}</th>
                            <th>{{__("university.faculty")}}</th>
                            <th>{{__("university.classrooms")}}</th>
                            <th>{{__("university.section")}}</th>
                            <th>{{__("parents.nationality")}}</th>
                            <th>{{__("parents.gender")}}</th>
                            <th>{{__("doctor.religions")}}</th>
                            <th>{{__("university.parents")}}</th>

                            </tr>
                            </thead>
                            <tbody>
                                            <tr>
                                            <td>{{ $student->name[LaravelLocalization::getCurrentLocale()] }}</td>
                                            <td>{{ $student->email}}</td>
                                            <td>
                                                {{$student->faculties->name[LaravelLocalization::getCurrentLocale()]}}
                                            </td>
                                            <td>
                                                @foreach ($student->classrooms as $classroom)
                                                    <p>{{ $classroom->name[LaravelLocalization::getCurrentLocale()] }}</p>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{$student->sections->name[LaravelLocalization::getCurrentLocale()]}}
                                            </td>
                                            <td>
                                                {{$student->nationalies->name[LaravelLocalization::getCurrentLocale()]}}
                                            </td>
                                            <td>
                                                {{$student->genders->name[LaravelLocalization::getCurrentLocale()]}}
                                            </td>
                                            <td>
                                                {{$student->religions->name[LaravelLocalization::getCurrentLocale()]}}
                                            </td>
                                            <td>
                                                {{$student->parents->first_name[LaravelLocalization::getCurrentLocale()].' '.
                                                $student->parents->last_name[LaravelLocalization::getCurrentLocale()]}}
                                            </td>

                                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane " id="attachments">
                        <!-- Form for Uploading Files -->
                        <form action="{{route('upload_attachments', ['imageableId' => $student->id, 'imageableType' => get_class($student)])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">{{ __('Upload File') }}</label>
                                <input type="file" name="file" id="file" class="form-control"accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                        </form>

                        <!-- Attachments Table -->
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>{{__("university.image")}}</th>
                                    <th>{{__("university.filename")}}</th>
                                    <th>{{__("university.created_at")}}</th>
                                    <th>{{__("university.process")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student->images as $image)
                                    <tr>
                                        <td><img src="{{ asset('storage/images/' . $image->filename) }}"style="width:100px;" alt="Student Image"></td>
                                         <td>{{ $image->filename}}</td>
                                        <td>{{ $image->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <a href="{{route('images.download',$image->id)}}" class="btn btn-success btn-sm">{{ __('Download') }}</a>
                                            <form action="{{route('images.delete_image',$image->id)}}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection

@section('js')

@endsection

