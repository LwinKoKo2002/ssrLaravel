$(document).ready(function(){
    //Csrf Token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //Create Button
    $('.create_btn').on('click',function(e){
        e.preventDefault();
        var name = $('#name').val();
        var description = $('#description').val();
        var category_id  = $('#category_id').val();
        console.log(name,description,category_id);
        $.ajax({
            url: `/posts/store?name=${name}&description=${description}&category_id=${category_id}`,
            type : 'POST',
            success : function(res){
                    if(res.status == 'success'){
                        $('#createModal').modal('hide')
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'center-center',
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                        icon: 'success',
                        title: res.message
                        })
                        setTimeout(() => {
                            window.location.replace('/'); 
                        },3000);       
                    }            
            }
        })
    })
    //Delete Button
    $('.delete_btn').on('click',function(e){
        e.preventDefault();
        Swal.fire({
        title: 'Are you sure ,you wnat to delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var $post_id = $(this).data("id");
                $.ajax({
                    url: `/posts/delete?post_id=${$post_id}`,
                    type : 'POST',
                    success : function(res){
                            if(res.status == 'success'){
                                Swal.fire(
                                'Deleted!',
                                res.message,
                                'success'
                                );
                                setTimeout(() => {
                                    window.location.replace('/'); 
                                },2000);    
                            }            
                    }
                })
            }
        })
        
    })
    //Edit Button
    $('.edit_btn').on('click',function(e){
        e.preventDefault();
        var post_id = $(this).data("id");
        $.ajax({
            url: `/posts/edit?post_id=${post_id}`,
            type : 'GET',
            success : function(res){
                    if(res.status == 'success'){
                        // console.log(res.post.name);
                         $("#editModal").find('input[name="name"]').val(res.post.name);
                         $("#editModal").find('textarea[name="description"]').val(res.post.description);
                         $("#editModal").find('select[name="category_id"]').val(res.post.category_id);           
                    }            
            }
        })
    })
    //Update Button
    $('.update_btn').on('click',function(e){
        e.preventDefault();
        var post_id = $('#post_id').val();
        var name = $("#editModal").find('input[name="name"]').val();
        var description = $("#editModal").find('textarea[name="description"]').val();
        var category_id = $("#editModal").find('select[name="category_id"]').val();
        $.ajax({
            url: `/posts/update?post_id=${post_id}&name=${name}&description=${description}&category_id=${category_id}`,
            type : 'POST',
            success : function(res){
                    if(res.status == 'success'){
                        $('#editModal').modal('hide')
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'center-center',
                        showConfirmButton: false,
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                        icon: 'success',
                        title: res.message
                        })
                        setTimeout(() => {
                            window.location.replace('/'); 
                        },3000); 
                    }            
            }
        })
    })
    //Show Clear Button
    var show = document.getElementById('search').value;
    if(show){
        document.getElementById('clear_btn').style.display = 'block';
    }
    //DaterangePicker
    $('.date').daterangepicker({
        "singleDatePicker": true,
        "autoUpdateInput": false,
        "locale": {
            "format": "YYYY-MM-DD",
        },
    });
    $('.date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
        var date = $('.date').val();
        var id = $('.category_search').val();
        history.pushState(null, '', `?date=${date}&category=${id}`);
        window.location.reload();
      });

      $('.date').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        var date = $('.date').val();
        var id = $('.category_search').val();
        history.pushState(null, '', `?date=${date}&category=${id}`);
        window.location.reload();
      });
    //Clear Button
    $('#clear_btn').on('click',function(){
        window.location.replace('/');
        return false;
    })
    //Filter By Category
    $('.category_search').change(function(e){
        e.preventDefault();
        var date = $('.date').val();
        var id = $('.category_search').val();
        history.pushState(null, '', `?date=${date}&category=${id}`);
        window.location.reload();
    })
})