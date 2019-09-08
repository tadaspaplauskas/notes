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

              <input type="text"
                name="tags"
                id="tags"
                autocomplete="off"
                list="tags"
                class="form-control"
                placeholder="Add tags"
              >

              <datalist id="tags">

                @foreach ($tags as $tag)

                  <option>{{ $tag->name }}</option>

                @endforeach

              </datalist>

            </div>

            <div class="form-group">

              <label for="content">Content</label>

              <textarea class="form-control" name="content" id="content" rows="10"></textarea>

            </div>

            <button class="btn btn-primary">Save</button>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
