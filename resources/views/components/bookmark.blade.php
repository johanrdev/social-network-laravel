<div>
    @if (!is_null($bookmark))
        <form method="POST" action="{{ route('bookmarks.destroy', $bookmark) }}">
            @method('DELETE')
            @csrf

            <button type="submit">Remove Bookmark</button>
        </form>
    @else
        <form method="POST" action="{{ route('bookmarks.store') }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $id }}">
            <input type="hidden" name="post_type" value="{{ $type }}">
            <button type="submit">Add Bookmark</button>
        </form>
    @endif
</div>