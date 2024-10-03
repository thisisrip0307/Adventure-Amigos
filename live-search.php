<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Search Autocomplete</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Simple styling for the suggestion box */
        .suggestions {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
        }
        .suggestions div {
            padding: 10px;
            cursor: pointer;
        }
        .suggestions div:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<h2>Search for a City</h2>
<input type="text" id="cityInput" placeholder="Type city name..." autocomplete="off">
<div id="suggestions" class="suggestions"></div>

<script>
    $(document).ready(function(){
        $("#cityInput").keyup(function(){
            var query = $(this).val();
            if(query.length > 0) {  // start showing suggestions after typing at least 3 characters
                $.ajax({
                    url: 'fetch_cities.php',  // PHP file that will process the request
                    method: 'POST',
                    data: {query: query},
                    success: function(data) {
                        $('#suggestions').html(data);
                    }
                });
            } else {
                $('#suggestions').html('');  // clear suggestions if input is less than 3 characters
            }
        });

        // Handle click event on a suggestion
        $(document).on('click', '.suggestion', function(){
            var cityName = $(this).text();
            $('#cityInput').val(cityName);  // set the selected city name in the input field
            $('#suggestions').html('');  // clear suggestions
        });
    });
</script>

</body>
</html>
