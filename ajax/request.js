   // Jquery
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
        // console.log(search_text)
        $.ajax({
            url: "search.php",
            type: "POST",
            data: {search: search_text},
            success: function (data){
                $('#table-data').html(data);
            }
        })
    }

    //course
    // hides
    $('#course_load').hide();
    $('#modeAlert').hide();
    $('#courseAlert').hide();
    
    // alert to select course
    function modeAlert(){
        var course_cat_id = $('#course_category').val();
        var mode_id = $('#mode').val();
        var course_id = $('#course').val();
      
        if(course_id != ""){
            $('#modeAlert').hide();
        }
        else{
            $('#modeAlert').show();
        }

        if(course_id != ""){
            $('#courseAlert').show();
        }else{
            $('#courseAlert').hide();
        }
    }
   

    $('#course_category').change(function(){
        modeAlert();
        var category_id = $(this).val();
        // console.log(category_id);
        $('#course_load').show();
        $('#course').hide();
        $('#course_label').hide();
        
        setTimeout(function(){
            $.ajax({
                url: "get_courses.php",
                type:'POST',
                data:{category_id:category_id},
                success: function(response){
                    $('#course_load').hide();
                    $('#course').show();
                    $('#course_label').show();
                    $('#course').html(response);
                }
            })
        },1000)
    });

    // requirements
    $('#course').change(function(){
        modeAlert()
        var course_id = $(this).val();
        // console.log(course_id);

        $.ajax({
            url: "get_requirments.php",
            type: 'POST',
            data: {course_id: course_id},
            success:function(response){
                $('#requirements').html(response);
            }
        })
    })
    
    
   //schedule
   $('#course').change(function(){
        modeAlert()
        var course_id = $(this).val();
        // console.log(mode);
        // console.log(course_id);

            $.ajax({
            url: "get_schedule.php",
            type: 'POST',
            data: {course_id: course_id},
            success:function(response){
                $('#schedule').html(response);
            }
        })
    })

    // mode
    $('#course').change(function(){
        modeAlert();
        $('#mode').change(function(){
            modeAlert()
            var mode = $(this).val();
            var course_id = $('#course').val();
            // console.log(mode);
            // console.log(course_id);

                $.ajax({
                url: "get_schedule.php",
                type: 'POST',
                data: {course_id: course_id,mode:mode},
                success:function(response){
                    $('#schedule').html(response);
                }
            })
        })
    })
    $('#mode').change(function(){
        modeAlert();
        $('#course').change(function(){
            modeAlert();
            var course_id = $(this).val();
            var mode = $('#mode').val();
            // console.log(mode);
            // console.log(course_id);

                $.ajax({
                url: "get_schedule.php",
                type: 'POST',
                data: {course_id: course_id,mode:mode},
                success:function(response){
                    $('#schedule').html(response);
                }
            })
        })
    
    })
});
