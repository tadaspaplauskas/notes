


@extends('layouts.app')

@section('content')
  <div class="container" style="width: 80vw">

    <div class="row">

      <div class="col-md-2 border overflow-auto" style="height: 80vh">
        <h2>Tags</h2>

        <ul>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
        </ul>
      </div>

      <div class="col-md-3 border overflow-auto" style="height: 80vh">
        <h2>Notes</h2>

        <ul>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
          <li>Laba</li>
          <li>Diena</li>
        </ul>
      </div>

      <div class="col-md-7 border overflow-auto bg-white" style="height: 80vh">

        <h2>Card title</h2>

        <p>
          This is some text within a card body.
        </p>

      </div>

    </div>

  </div>


<div class="modal fade show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection










{{-- @section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-md-8">
      <div class="card">
        <div class="card-header">Home</div>

        <div class="card-body">
          @if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
          @endif

          <p>
              <a href="{{ route('notes.create') }}" class="btn btn-primary">+ Add a note</a>
          </p>

          <h2>Tags</h2>

          <p>
            @foreach ($tags as $tag)

              @include('components.tag', [
                'tag' => $tag,
                'max' => $tags->max('notes_count'),
                'min' => $tags->min('notes_count'),
                ])

            @endforeach
          </p>

          @if (!$notes)

            <p>No notes so far. Create the first one!</p>

          @else

            @foreach ($notes as $note)

              <p>{{ implode(', ', $note->tags->pluck('name')->toArray()) }}: {{ $note->text }}</p>

            @endforeach

          @endif

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
 --}}