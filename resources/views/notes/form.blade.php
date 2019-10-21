@csrf

  <datalist id="available_tags">
    @foreach ($availableTags as $at)
      <option>{{ $at->name }}</option>
    @endforeach
  </datalist>

  @foreach ($errors->all() as $error)
    <div class="alert alert-warning">{{ $error }}</div>
  @endforeach

  <div class="row mb-3">
    <div class="{{ $note->content ? 'col-md-6' : 'col' }}">
      <label for="content" class="sr-only">Content</label>

      <textarea
        name="content"
        id="content"
        placeholder="Lorem ipsum..."
        class="form-control h-100"
        style="min-height: 50vh; resize: none;"
        >{{ old('content', $note->content) }}</textarea>
    </div>

    @if ($note->content)
      <div class="col-md-6">

        @include('notes.content', ['note' => $note])

      </div>
    @endif
  </div>

  <div class="row">
    <div class="col-6">
      <div>
        <label for="tag" class="sr-only">Tag</label>
        <input type="text"
          name="tag"
          id="tag"
          autocomplete="off"
          list="available_tags"
          class="form-control"
          placeholder="Add a tag"
          value="{{ old('tags', optional($tag)->name) }}">
      </div>

      <div class="mt-3">
        <label for="files" class="sr-only">Files</label>
        <input type="file" multiple name="uploads[]" id="files" class="w-100">
      </div>

      <div class="mt-3">
        <button class="btn btn-primary"
            accesskey="s"
            title="ctrl + alt + s">Save</button>

          <a href="{{ optional($tag)->exists ?
            route('tags.notes.index', $tag) : route('notes.index') }}"
            class="btn btn-secondary"
            accesskey="b"
            title="ctrl + alt + b">Back</a>

          @if ($note->exists)
            <a href="{{ route('notes.delete', $note) }}" class="btn btn-danger float-right">
              Delete
            </a>
          @endif
      </div>
  </div>
</div>
