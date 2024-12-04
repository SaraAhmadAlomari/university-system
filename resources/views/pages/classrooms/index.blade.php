@extends('layouts.master')

@section('title')
{{__("university.classrooms")}}
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
            <h1 class="m-0 text-dark">{{__("university.classrooms")}} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__("university.home")}}</a></li>
              <li class="breadcrumb-item active">{{__("university.classrooms")}} </li>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    {{__("university.add_classroom")}}
                    </button>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>{{__("faculty.name")}}</th>
                  <th>{{__("university.faculty")}}</th>
                  <th>{{__("faculty.process")}}</th>

                </tr>
                </thead>
                <tbody>
                    @foreach ($classrooms as $classroom)
                                <tr>
                                    @if (LaravelLocalization::getCurrentLocale() === 'ar')
                                        <td>{{ $classroom->name['ar'] }}</td>
                                    @else
                                        <td>{{ $classroom->name['en'] }}</td>
                                    @endif

                                <td>
                                    @if (LaravelLocalization::getCurrentLocale() === 'ar')
                                        {{$classroom->faculties->name['ar']}}
                                    @else
                                        {{$classroom->faculties->name['en']}}
                                    @endif

                                </td>
                                <td>
                                    <button type="button" class="btn  btn-outline-success btn-sm"data-toggle="modal" data-target="#exampleModal{{ $classroom->id }}" data-id="{{ $classroom->id }}">Edit</button>

                                    <form action="{{ route('classroom.destroy', $classroom->id) }}"  onsubmit="return confirm('Are you sure you want to delete this classroom?');" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" >Delete</button>
                                    </form>
                                    </td>

                                </tr>
                        @include('pages.classrooms.edit')
                    @endforeach


              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        <!-- /.col -->

    </div>
    <!-- /.content -->

    @include('pages.classrooms.create')


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
