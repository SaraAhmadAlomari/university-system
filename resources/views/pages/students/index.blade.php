@extends('layouts.master')

@section('title')
{{__("university.students")}}
@endsection

@section('style')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
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
            <h1 class="m-0 text-dark">{{__("university.students")}} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__("university.home")}}</a></li>
              <li class="breadcrumb-item active">{{__("university.students")}} </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

          <div class="card">
            <div class="card-body">
                <!-- Button trigger modal -->
                <a href="{{ route('student.create') }}" class="btn btn-primary">
                    {{ __("university.add_student") }}
                </a>
                <div class="table-wrapper">
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
                    <th>{{__("faculty.process")}}</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
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
                                    <td>
                                        <a href="{{ route('student.show',$student->id) }}"><button type="button" class="btn  btn-outline-info btn-sm">Show</button></a>
                                        <a href="{{ route('student.edit',$student->id) }}"><button type="button" class="btn  btn-outline-success btn-sm">Edit</button></a>
                                        <form action="{{ route('student.destroy', $student->id) }}"  onsubmit="return confirm('Are you sure you want to delete this student?');" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" >Delete</button>
                                        </form>
                                        </td>

                                    </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        <!-- /.col -->

    </div>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

@endsection

@section('js')
<!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

@endsection

