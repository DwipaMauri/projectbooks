<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <title>Book Ratings</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="text-center mb-4 text-primary">Insert Rating</h2> <!-- Changed to a primary text color -->
                <form action="{{ route('ratings.store') }}" method="POST"
                    class="border p-3 rounded shadow-sm bg-white"> <!-- Updated background to white -->
                    @csrf
                    <!-- Author -->
                    <div class="mb-3">
                        <label for="author_id" class="form-label text-secondary">Select Author</label>
                        <select id="author_id" name="author_id" class="form-select border-primary">
                            <option value="">-- Select Author --</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Book -->
                    <div class="mb-3">
                        <label for="book_id" class="form-label text-secondary">Select Book</label>
                        <select id="book_id" name="book_id" class="form-select border-primary" required>
                            <option value="">-- Select Book --</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}" data-author-id="{{ $book->author_id }}"
                                    style="display: none;">
                                    {{ $book->title }} ({{ $book->author->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rating -->
                    <div class="mb-3">
                        <label for="rating" class="form-label text-secondary">Rating</label>
                        <select id="rating" name="rating" class="form-select border-primary" required>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Submit Rating</button> <!-- Primary button -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add event listener to author select
        document.getElementById('author_id').addEventListener('change', function() {
            const authorId = this.value;
            const bookSelect = document.getElementById('book_id');

            // Reset book select
            Array.from(bookSelect.options).forEach(option => {
                if (option.value) {
                    option.style.display = authorId === '' || option.dataset.authorId === authorId ?
                        'block' : 'none';
                }
            });

            // Reset book selection
            bookSelect.selectedIndex = 0;
        });
    </script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</body>

</html>
