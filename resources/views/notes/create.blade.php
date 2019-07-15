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

          <form action="{{ route('notes.store') }}" method="POST">

            @csrf

            <div class="form-group">

              <label for="tags">Tags</label>

              <input type="text" class="form-control" id="tags" name="tags" placeholder="Add tags" autocomplete="off">

            </div>

            <div class="form-group">

              <label for="text">Text</label>

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
    $('#tags').tagsInput({
      // interactive: true,
      'autocomplete': {
        source: [
          'notes',
          'quotes',
          'life',
          'apples',
        ]
      }
    });
  });

</script>
@endsection
