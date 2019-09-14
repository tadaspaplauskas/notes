@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Edit a note</div>
        <div class="card-body">
          <form action="{{ route('notes.update', $note) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('notes.form')
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
