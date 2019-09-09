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

  <div class="row mb-3">
    <div class="{{ $note->content ? 'col-md-6' : 'col' }}">
      <textarea
        name="content"
        placeholder="Lorem ipsum..."
        class="form-control h-100"
        style="min-height: 50vh; resize: none;"
        >{{ old('content', $note->content) }}</textarea>
    </div>

    @if ($note->content)
      <div class="col-md-6">
        {!! $note->html !!}
      </div>
    @endif
  </div>

  <div class="row">
    <div class="col">
      <input type="text"
        name="tag"
        id="tag"
        autocomplete="off"
        list="available_tags"
        class="form-control"
        placeholder="Add a tag"
        value="{{ old('tags', $tag->name) }}">
    </div>

    <div class="col text-right">
      <button class="btn btn-primary"
        accesskey="s"
        title="ctrl + alt + s">Save</button>

      <a href="{{ $tag->exists ?
        route('tags.notes.index', $tag) : route('notes.index') }}"
        class="btn btn-secondary"
        accesskey="b"
        title="ctrl + alt + b">Back</a>
    </div>
  </div>
