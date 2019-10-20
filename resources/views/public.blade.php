<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $user->name }}' Knowledge Base</title>

  {{-- Styles --}}
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-light bg-white" id="index">
    <div class="container">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#index">{{ $user->name }}' KB</a>
          </li>

          @foreach ($tags as $tag)

            <li class="nav-item">
              <a class="nav-link" href="#{{ $tag->name }}">{{ $tag->name }}</a>
            </li>

          @endforeach
        </ul>
    </div>
  </nav>

  <main class="container">

    @foreach ($tags as $tag)

      <h2 id="{{ $tag->name }}">{{ $tag->name }}</h2>

      @foreach ($tag->notes as $note)
        {!! $note->htmlWithUploads !!}
      @endforeach

    @endforeach

  </main>
</body>
</html>
