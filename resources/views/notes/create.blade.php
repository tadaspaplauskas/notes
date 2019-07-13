@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Add a note</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form>

            <div class="form-group">

              <label for="exampleFormControlInput1">Tags</label>

              <input type="text" class="form-control" id="tags" name="tags" placeholder="Add tags">

            </div>

            <div class="form-group">

              <label for="exampleFormControlTextarea1">Text</label>

              <textarea class="form-control" id="text" name="text" rows="3"></textarea>

            </div>

            <button class="btn btn-primary">Save</button>

          </form>


        </div>
      </div>
    </div>
  </div>
</div>


<script>

  $(function () {
    $('#tags').tagsInput();
  });

</script>
@endsection
