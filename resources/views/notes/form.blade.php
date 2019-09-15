@csrf

  <datalist id="available_tags">
    @foreach ($availableTags as $at)
      <option>{{ $at->name }}</option>
    @endforeach
  </datalist>

  @error('content')
    <div class="alert alert-warning">{{ $message }}</div>
  @enderror

  @error('tag')
    <div class="alert alert-warning">{{ $message }}</div>
  @enderror

  @error('files')
    <div class="alert alert-warning">{{ $message }}</div>
  @enderror

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
        {!! $note->html !!}

        @foreach ($note->uploads as $upload)
        <div class="d-inline-block img-thumbnail m-1">
          <a href="" class="close mx-2" aria-label="Delete" title="Delete file">
            <span aria-hidden="true">&times;</span>
          </a>

          <a href="{{ $upload->url }}">
            @if ($upload->is_image)
              <img src="{{ $upload->url }}" title="{{ $upload->name }}"
                class="img-fluid" style="max-height: 10rem">
            @else
              {{ $upload->name }}
            @endif
          </a>


        </div>
        @endforeach
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
      </div>
  </div>
</div>
