@extends('layouts.app')

@section('content')

  <notes class="" inline-template v-cloak>

    <div class="row">

      <div class="col-3 pt-2">

        <h2>
          Tags
          <button class="btn btn-light btn-sm">+ Add</button>
        </h2>

        <div class="list-group list-group-flush">
          <button type="button" class="list-group-item  d-flex justify-content-between align-items-center active">
            turizmas
            <span class="badge badge-primary badge-pill bg-white text-primary">14</span>
          </button>

          <button type="button" class="list-group-item  d-flex justify-content-between align-items-center">
            festivaliai
            <span class="badge badge-primary badge-pill">3</span>
          </button>

          <button type="button" class="list-group-item  d-flex justify-content-between align-items-center">
            motociklai
            <span class="badge badge-primary badge-pill">9</span>
          </button>
        </div>
      </div>

      <div class="col pt-2">

        <h2>
          Notes
          <button class="btn btn-light btn-sm"
          @click="addNote">+ Add</button>
        </h2>

        <div>

          <div class="row" v-for="note in notes"
            :title="'Updated ' +  note.updated_at" >
            <div class="col" contenteditable="true"
              style="max-width: 40rem; margin-bottom: 1rem;"
              @blur="saveNote(note, $event.target.innerText, $event)"
              v-text="note.content"
            ></div>

            <div class="col-1 small text-right">
              <button type="button" class="close" aria-label="Delete"
                @click="deleteNote(note)">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

          </div>

        </div>

      </div>

    </div>

  </notes>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

