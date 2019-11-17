@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Edit a tag</div>
        <div class="card-body">
          <form action="{{ route('tags.update', $tag) }}" method="POST">
            @method('PUT')
            @csrf

            @error('new_name')
              <div class="alert alert-warning">{{ $message }}</div>
            @enderror

            <div class="form-group">
              <label for="new_name">Name</label>
              <input type="text"
                name="new_name"
                id="new_name"
                autocomplete="off"
                class="form-control"
                placeholder="New name"
                value="{{ old('new_name', optional($tag)->name) }}">
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="private" name="private" {{ $tag->private ? 'checked' : '' }}>
              <label class="form-check-label" for="private">
                Private <small>(skip from the public page)</small>
              </label>
            </div>

            <button class="btn btn-secondary">Save</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Move notes from {{ $tag->name }}</div>
        <div class="card-body">
          <form action="{{ route('tags.move', $tag) }}" method="POST">
            @csrf

            <p>
              Be careful, this cannot be reversed!
              All data linking notes with this tag will be gone forever.
            </p>

            @error('new_tag')
              <div class="alert alert-warning">{{ $message }}</div>
            @enderror

            <div class="form-group">
              <label for="new_name">Move to</label>

              <select name="new_tag" class="form-control">
                <option></option>
                @foreach ($tags as $t)
                  <option value="{{ $t->id }}"
                    {{ old('new_tag') == $t->id ? 'selected' : '' }}
                    >{{ $t->name }}</option>
                @endforeach
              </select>
            </div>

            <button class="btn btn-secondary">Move</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Delete {{ $tag->name }}</div>
        <div class="card-body">
          <form action="{{ route('tags.destroy', $tag) }}" method="POST">
            @method('DELETE')
            @csrf

            <p>
              Be careful, this cannot be reversed!
              All data linking notes with this tag will be gone forever.
            </p>

            <button class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>

  </div>
@endsection
