@extends('layouts.app')

@section('content')

<div class="row">

  <div class="col-3 pt-2">

    <h2>
      Tags
      <button class="btn btn-light btn-sm">+ Add</button>
    </h2>

    <div class="list-group list-group-flush">

      @foreach ($tags as $tag)

        <a
          href="{{ $selectedTag->getKey() === $tag->getKey() ?
            route('notes.index') : route('tags.notes.index', $tag) }}"

          class="list-group-item d-flex justify-content-between align-items-center
            {{ $selectedTag->getKey() === $tag->getKey() ? 'active' : '' }}">

          {{ $tag->name }}

          <span
            class="badge badge-primary badge-pill
              {{ $selectedTag->getKey() === $tag->getKey() ? 'bg-white text-primary' : '' }}">

            {{ $tag->notes_count }}

          </span>
        </a>

      @endforeach

    </div>
  </div>

  <div class="col pt-2">

    <h2>
      Notes
      <a class="btn btn-light btn-sm"
         href="{{ $selectedTag->exists ? route('tags.notes.create', $selectedTag) : route('notes.create') }}">+ Add</a>
    </h2>

    @foreach ($notes as $note)

      <div class="row" title="{{ 'Updated ' .  $note->updated_at->diffForHumans() }}">

        <div class="col">
          {!! $note->html !!}
        </div>

        <div class="col-2 small text-right">
          <a href="{{ route('notes.edit', $note) }}">
            Edit
          </a>

          <a href="{{ route('notes.delete', $note) }}">
            Delete
          </a>
        </div>

      </div>

    @endforeach

  </div>

</div>

@endsection

