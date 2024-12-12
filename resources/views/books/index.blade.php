<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Books</title>
</head>

<body class="container my-4 bg-light">
    <!-- Filter Form -->
    <div class="row">
        <div class="col-md-3"> <!-- Adjusted column size -->
            <form method="GET" action="{{ route('books.index') }}" class="border p-3 rounded shadow-sm bg-white">
                <div class="mb-3">
                    <label for="listShown" class="form-label">List Shown:</label>
                    <select name="listShown" id="listShown" class="form-select">
                        @for ($i = 10; $i <= 100; $i += 10)
                            <option value="{{ $i }}" {{ request('listShown') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="mb-3">
                    <label for="search" class="form-label">Search:</label>
                    <input type="text" name="search" id="search" class="form-control"
                        value="{{ request('search') }}" placeholder="Enter book or author name">
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

        <!-- Book Table -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-hover">
                <thead class="table-primary"> <!-- Mengubah warna header tabel menjadi biru Bootstrap -->
                    <tr>
                        <th>No</th>
                        <th>Book Title</th>
                        <th>Category</th>
                        <th>Author Name</th>
                        <th>Average Rating</th>
                        <th>Voters</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $index => $book)
                        <tr class="{{ $loop->even ? 'table-light' : 'table-secondary' }}">
                            <!-- Menambahkan warna bergantian untuk setiap baris -->
                            <th scope="row">
                                {{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}
                            </th>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->category->name ?? 'N/A' }}</td>
                            <td>{{ $book->author->name ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $averageRating = $book->ratings->isNotEmpty() ? $book->ratings->avg('rating') : 0;
                                @endphp
                                {{ number_format($averageRating, 2) }}
                            </td>
                            <td>{{ $book->ratings->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</body>

</html>
