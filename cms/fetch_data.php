<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h2>Asynchronous AJAX Example</h2>
<button id="fetchDataBtn">Fetch Data</button>
<div id="result"></div>

<script>
    $(document).ready(function(){
        $('#fetchDataBtn').click(function(){
            $.ajax({
                url: 'fetch_data.php',
                type: 'GET',
                success: function(response){
                    $('#result').html(response);
                },
                error: function(xhr, status, error){
                    console.error(xhr.responseText);
            });
        });
    });
</script>
</body>
</html>
