@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Edit a note</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form action="{{ route('notes.update') }}" method="POST">
            @method('PUT')
            @include('notes.form')
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back to list</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
