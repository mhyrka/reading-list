<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            max-width: 100vw;
            margin: 0;
            /* overflow: hidden; */
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .author-header {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        h4 {
            margin: 0;
        }

        .book-card {
            border: 2px solid #027fad;
            margin: 4px;
            width: 300px;
            border-radius: 4px;
            height: 450px;
        }

        #books-section {
            max-width: 62vw;
            display: flex;
            flex-direction: row;
            align-items: center;
            flex-wrap: wrap;
            overflow-y: auto;
            max-height: 90vh;
            overflow: -moz-scrollbars-none;
        }

        #books-section::-webkit-scrollbar {
            width: 0 !important
        }

        #main {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            /* width: 0vw; */
            /* justify-content: space-between; */
        }

        #my-list {
            overflow: auto;
            max-height: 90vh;
            overflow: -moz-scrollbars-none;
        }

        #my-list::-webkit-scrollbar {
            width: 0 !important
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<script type="text/javascript">
    function addToList(data) {

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                dataType: 'Application/JSON',
                url: "{{ url('/api/books/add-book') }}",
                data: data,
                success: function(response) {
                    console.log(response);

                }
            });
        });
        // Terrible way to do this...
        location.reload()
    }
</script>

<body>
    <h1>GET YA BOOKS HERE</h1>
    <div id="main">
        <div id="books-section">
            @foreach ($books as $book)
            <div class="book-card">
                <h3>{{ $book->title }}</h3>
                <div class="author-header">
                    <h4>{{ $book->author_last }}, </h4>
                    <h4>&nbsp{{' ' . $book->author_first }}</h4>
                </div>
                <img src="https://picsum.photos/300/300" />
                <button onclick="addToList({{ json_encode($book) }} )">
                    + Add to List
                </button>

            </div>
            @endforeach
        </div>
        <div id="my-list">
            <h2>My Reading List</h2>

            @foreach ($my_books as $book)
            <div class="book-card">
                <h3>{{ $book->title }}</h3>
                <div class="author-header">
                    <h4>{{ $book->author_last }}, </h4>
                    <h4>&nbsp{{' ' . $book->author_first }}</h4>
                </div>
                <img src="https://picsum.photos/300/300" />
                <button onclick="addToList({{ json_encode($book) }} )">
                    + remove from list
                </button>

            </div>
            @endforeach
        </div>

    </div>


</body>

</html>