@extends('layouts.master')

@section('title')
{{__("university.doctors")}}
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
            <h1 class="m-0 text-dark">{{__("university.doctors")}} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__("university.home")}}</a></li>
              <li class="breadcrumb-item active">{{__("university.doctors")}} </li>
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
                <a href="{{ route('doctor.create') }}" class="btn btn-primary">
                    {{ __("university.add_doctor") }}
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
                    <th>{{__("faculty.process")}}</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                                    <tr>
                                    <td>{{ $doctor->name[LaravelLocalization::getCurrentLocale()] }}</td>
                                    <td>{{ $doctor->email}}</td>
                                    <td>
                                        {{$doctor->faculties->name[LaravelLocalization::getCurrentLocale()]}}
                                    </td>
                                    <td>
                                        {{$doctor->classrooms->name[LaravelLocalization::getCurrentLocale()]}}
                                    </td>
                                    <td>
                                        {{$doctor->sections->name[LaravelLocalization::getCurrentLocale()]}}
                                    </td>
                                    <td>
                                        {{$doctor->nationalies->name[LaravelLocalization::getCurrentLocale()]}}
                                    </td>
                                    <td>
                                        {{$doctor->genders->name[LaravelLocalization::getCurrentLocale()]}}
                                    </td>
                                    <td>
                                        {{$doctor->religions->name[LaravelLocalization::getCurrentLocale()]}}
                                    </td>
                                    <td>
                                        <a href="{{ route('doctor.edit',$doctor->id) }}"><button type="button" class="btn  btn-outline-success btn-sm">Edit</button></a>
                                        <form action="{{ route('doctor.destroy', $doctor->id) }}"  onsubmit="return confirm('Are you sure you want to delete this doctor?');" method="POST" style="display:inline-block;">
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

