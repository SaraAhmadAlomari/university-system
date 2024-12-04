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
            <select class="form-control" name="faculty_id" id="faculty_id">
                <option value="">---</option>
                @foreach ($faculties as $faculty)
                    @if (LaravelLocalization::getCurrentLocale() === 'ar')
                        <option value="{{$faculty->id}}" @if($faculty->id==$classroom->faculties->id) selected @endif >{{ $faculty->name['ar'] }}</option>
                    @else
                        <option value="{{$faculty->id}}" @if($faculty->id==$classroom->faculties->id) selected @endif >{{ $faculty->name['en'] }}</option>
                    @endif
                        </option>
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
