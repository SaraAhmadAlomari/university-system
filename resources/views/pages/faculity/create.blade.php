<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__("faculty.create")}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('faculty.store') }}">
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
            <label for="notes" class="col-form-label">{{__("faculty.notes")}}</label>
            <textarea class="form-control" id="notes" name="notes"></textarea>
          </div>
                  <button type="submit" class="btn btn-primary">{{__("faculty.create")}}</button>
        </form>
      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
