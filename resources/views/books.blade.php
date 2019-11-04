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

        button {
            border: 2px solid #ff6600;
            border-radius: 4px;
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
                    location.reload()
                }
            });
        });
        // Terrible way to do this...
        setTimeout(() => {
            location.reload()
        }, 500);

    }

    function removeFromList(data) {

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                method: 'POST',
                dataType: 'Application/JSON',
                url: "{{ url('/api/books/remove-book') }}",
                data: data,
                success: function(response) {
                    console.log(response);

                }
            });
        });
        // Terrible way to do this...
        setTimeout(() => {
            location.reload()
        }, 500);
    }

    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min;
    }
    let images = document.querySelectorAll(".images")
    images.forEach(image => {
        console.log("hello")
        image.src = image.src.replace('*ID*', getRandomInt(1, 1000))
    });

    function getRandomImage() {
        return `https://picsum.photos/id/${getRandomInt(1,1000)}/300/250`
    }
</script>

<body>
    <h1>ALL BOOKS</h1>
    <div id="main">
        <div id="books-section">
            @foreach ($books as $book)
            <div class="book-card">
                <h3>{{ $book->title }}</h3>
                <div class="author-header">
                    <h4>{{ $book->author_last }}, </h4>
                    <h4>&nbsp{{' ' . $book->author_first }}</h4>
                </div>
                <img class='images' src="https://picsum.photos/id/{{ $book->id }}/300/250" alt="https://picsum.photos/300/250" />
                <p>{{ $book->publisher }}</p>
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
                <button onclick="removeFromList({{ json_encode($book) }} )">
                    + remove from list
                </button>

            </div>
            @endforeach
        </div>

    </div>


</body>

</html>