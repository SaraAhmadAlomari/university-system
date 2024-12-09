@extends('layouts.master')

@section('title')
{{__("university.section")}}
@endsection

@section('style')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  </style>
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
            <h1 class="m-0 text-dark">{{__("university.section")}} </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{__("university.home")}}</a></li>
              <li class="breadcrumb-item active">{{__("university.section")}} </li>
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
                    {{__("section.add_section")}}
                    </button>
                @foreach ($faculties as $faculty)
                    <div class="row mt-2">
                        <div class="col-md-12">
                                <div class="card card-success collapsed-card">
                                        <div class="card-header">
                                        {{ $faculty->name[LaravelLocalization::getCurrentLocale() ] }}
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body" style="display: none;">
                                        <table id="example2" class="table table-bordered table-hover data-table">
                                            <thead>
                                            <tr>
                                            <th>{{__("section.name")}}</th>
                                            <th>{{__("section.classroom")}}</th>
                                            <th>{{__("section.status")}}</th>
                                            <th>{{__("faculty.process")}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sections->where('faculty_id', $faculty->id) as $section)
                                                    <tr>
                                                    <td>{{ $section->name[LaravelLocalization::getCurrentLocale()] }}</td>
                                                    <td> {{$section->classrooms->name[LaravelLocalization::getCurrentLocale()]}}</td>
                                                    <td> {{$section->status}}</td>
                                                    <td>
                                                        <button type="button" class="btn  btn-outline-success btn-sm"data-toggle="modal" data-target="#exampleModal{{ $section->id }}" data-id="{{ $section->id }}">Edit</button>

                                                        <form action="{{ route('section.destroy', $section->id) }}"  onsubmit="return confirm('Are you sure you want to delete this section?');" method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger btn-sm" >Delete</button>
                                                        </form>
                                                        </td>

                                                    </tr>
                                                    @include('pages.sections.edit')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.content -->

    @include('pages.sections.create')


  </div>
  <!-- /.content-wrapper -->

@endsection

@section('js')
<!-- DataTables -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
  $(function () {
    $(".data-table").DataTable();

  });
</script>
<!-- change faculty to shown classroom (create) -->
<script>
    document.getElementById('faculty_id').addEventListener('change', function () {
        const currentLocale = '{{ LaravelLocalization::getCurrentLocale() }}';
        const facultyId = this.value;
        const classroomSelect = document.getElementById('classroom_id');

        // Clear the classroom dropdown
        classroomSelect.innerHTML = '<option value="">---</option>';

        if (facultyId) {
            // Fetch classrooms from the server
            fetch(`/faculty/${facultyId}/classrooms`)
                .then(response => response.json())
                .then(classrooms => {
                    classrooms.forEach(classroom => {
                        const option = document.createElement('option');
                        option.value = classroom.id;
                        option.textContent = classroom.name[currentLocale]; // Adjust field based on your Classroom model
                        classroomSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching classrooms:', error));
        }
    });
</script>

<!-- change faculty to shown classroom (edit) -->
<script>
    document.querySelectorAll('.faculty-dropdown').forEach(facultyDropdown => {
    facultyDropdown.addEventListener('change', function () {
        const currentLocale = '{{ LaravelLocalization::getCurrentLocale() }}';
        const facultyId = this.value;
        const groupId = this.getAttribute('data-group');
        const classroomSelect = document.querySelector(`.classroom-dropdown[data-group="${groupId}"]`);

        if (!classroomSelect) {
            console.error('classroomSelect is null. Ensure it has the matching data-group attribute.');
            return;
        }

        // Clear current options
        classroomSelect.innerHTML = '<option value="">---</option>';

        if (facultyId) {
            fetch(`/faculty/${facultyId}/classrooms`)
                .then(response => response.json())
                .then(classrooms => {
                    classrooms.forEach(classroom => {
                        const option = document.createElement('option');
                        option.value = classroom.id;
                        option.textContent = classroom.name[currentLocale];
                        classroomSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching classrooms:', error));
        }
    });
});

</script>


@endsection

