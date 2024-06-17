<?php
include('config/dbcheck.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div id='search-bar'>
            <input type="text" name="search" id="search" autocomplete="off">
            <button type="submit" id="search-btn" name="search-btn">Search</button>
            <input type="button" id="Add" value="New Applicant">
        </div>
    </div>
    <div id="table-data">

    </div>
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        document.getElementById('Add').onclick = ()=>{
            window.location = "form.php";
        }

        $(document).ready(function(){
            $('#search-btn').on("click", function(){
                var search_term = $('#search').val();
                searching(search_term);
            })

            $('#search').on("keypress" , function (e){
                if(e.which === 13){
                    var search_term = $('#search').val();
                    searching(search_term);
                }
            })
            function searching(search_text){
                console.log(search_text)
                $.ajax({
                    url: "search.php",
                    type: "POST",
                    data: {search: search_text},
                    success: function (data){
                        $('#table-data').html(data);
                    }
                })
            }
        });
       
    </script>
</body>
</html>