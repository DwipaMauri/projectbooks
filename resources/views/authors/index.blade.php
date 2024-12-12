<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Authors</title>
</head>

<body class="container">
    <h1 class="text-center mt-4">Top 10 Most Famous Authors</h1>

    <div class="d-flex justify-content-center mt-4">
        <table class="table table-bordered table-sm" style="width: 50%;">
            <thead class="table-secondary text-center">
                <tr>
                    <th>No</th>
                    <th>Author Name</th>
                    <th>Voters</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($authors as $index => $author)
                    <tr class="{{ $index % 2 == 0 ? 'table-light' : 'table-muted' }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->voter_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
