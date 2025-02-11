<div class="modal fade" id="exampleModal{{ $classroom->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $classroom->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__("faculty.edit")}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" method="POST" action="{{ route('classroom.update', $classroom->id) }}">
            @csrf
            @method('PUT')
            {{-- <input type="hidden" name="id" id="facultyId" value="{{$faculty->id}}"> --}}
          <div class="form-group">
            <label for="en_name" class="col-form-label">{{__("faculty.en_name")}}</label>
            <input type="text" class="form-control" name="en_name" id="en_name" value="{{ $classroom->name['en']}}">
          </div>
          <div class="form-group">
            <label for="ar_name" class="col-form-label">{{__("faculty.ar_name")}}</label>
            <input type="text" class="form-control" name="ar_name" id="ar_name"value="{{ $classroom->name['ar']}}">
          </div>
             <div class="form-group">
            <label for="faculty_id" class="col-form-label">{{__("university.faculty")}}</label>
            <select class="form-control" name="faculty_id" id="faculty_id{{$classroom->id}}">
                <option value="">---</option>
                @foreach ($faculties as $faculty)
                        <option value="{{$faculty->id}}" @if($faculty->id==$classroom->faculties->id) selected @endif >{{ $faculty->name[LaravelLocalization::getCurrentLocale()] }}</option>
                @endforeach
            </select>
          </div>
             <div class="form-group">
            <label for="section_id" class="col-form-label">{{__("university.section")}}</label>
            <select class="form-control" name="section_id" id="section_id{{$classroom->id}}">
                <option value="">---</option>
                @foreach ($sections as $section)
                    <option value="{{$section->id}}" @if($section->id==$classroom->sections->id) selected @endif >{{ $section->name[LaravelLocalization::getCurrentLocale()] }}</option>
                @endforeach
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
