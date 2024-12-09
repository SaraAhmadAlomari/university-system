<div class="modal fade" id="exampleModal{{ $section->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $section->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__("section.edit")}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="POST" action="{{ route('section.update', $section->id) }}">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="id" id="facultyId" value="{{$faculty->id}}"> --}}
          <div class="form-group">
            <label for="en_name" class="col-form-label">{{__("faculty.en_name")}}</label>
            <input type="text" class="form-control" name="en_name" id="en_name" value="{{ $section->name['en']}}">
          </div>
          <div class="form-group">
            <label for="ar_name" class="col-form-label">{{__("faculty.ar_name")}}</label>
            <input type="text" class="form-control" name="ar_name" id="ar_name"value="{{ $section->name['ar']}}">
          </div>
            <div class="form-group">
            <label for="faculty_id" class="col-form-label">{{__("university.faculty")}}</label>
            <select class="form-control faculty-dropdown" name="faculty_id" id="faculty_id_{{$section->id}}" data-group="{{$section->id}}">
                <option value="">---</option>
                @foreach ($faculties as $faculty)
                    <option value="{{$faculty->id}}" @if($faculty->id==$section->faculties->id) selected @endif>{{ $faculty->name[LaravelLocalization::getCurrentLocale()] }}</option>
                @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="classroom_id" class="col-form-label">{{__("section.classroom")}}</label>
            <select class="form-control classroom-dropdown" name="classroom_id" id="classroom_id_{{$section->id}}" data-group="{{$section->id}}">
                <option value="">---</option>
                <option value="{{$section->classrooms->id}}"selected>{{$section->classrooms->name[LaravelLocalization::getCurrentLocale()]}}</option>
            </select>
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">{{__("section.status")}}</label>
            <select class="form-control" name="status" id="status">
                <option value="">---</option>
                <option value="1" @if($section->status==1) selected @endif>Active</option>
                <option value="0" @if($section->status==0) selected @endif>Inactive</option>
            </select>
          </div>


                  <button type="submit" class="btn btn-primary">{{__("faculty.edit")}}</button>
        </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
