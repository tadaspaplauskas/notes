<?php
    // rem
    $MAX_TAG_FONT_SIZE = 3;
    $MIN_TAG_FONT_SIZE = 1;

    $weight = round($tag->notes_count / ($max ?? 1), 2);
    $size = max($MIN_TAG_FONT_SIZE, $weight * $MAX_TAG_FONT_SIZE);
?>
<a href="{{ route('tags.show', $tag) }}"
    style="font-size: {{ $size }}rem"
    alt="{{ $tag->notes_count}} notes">

        {{ $tag->name }}

</a>
