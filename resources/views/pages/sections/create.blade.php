<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__("section.add_section")}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('section.store') }}">
            @csrf
          <div class="form-group">
            <label for="en_name" class="col-form-label">{{__("faculty.en_name")}}</label>
            <input type="text" class="form-control" name="en_name" id="en_name">
          </div>
          <div class="form-group">
            <label for="ar_name" class="col-form-label">{{__("faculty.ar_name")}}</label>
            <input type="text" class="form-control" name="ar_name" id="ar_name">
          </div>
          <div class="form-group">
            <label for="faculty_id" class="col-form-label">{{__("university.faculty")}}</label>
            <select class="form-control" name="faculty_id" id="faculty_id">
                <option value="">---</option>
                @foreach ($faculties as $faculty)
                    <option value="{{$faculty->id}}">{{ $faculty->name[LaravelLocalization::getCurrentLocale()] }}</option>
                @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="status" class="col-form-label">{{__("section.status")}}</label>
            <select class="form-control" name="status" id="status">
                <option value="">---</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
          </div>

            <button type="submit" class="btn btn-primary">{{__("section.add_section")}}</button>
        </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
