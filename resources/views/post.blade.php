<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Csrf Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Posts</title>
    <!-- Bootstrap Cnd -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Post Lists</h4>
                        <!-- Button Create modal -->       
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bi bi-plus-circle me-1"></i> Add New Post</button>         
                        <!-- Modal -->
                        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="">
                                        <div class="form-group mb-2">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" placeholder="Your Name" class="form-control" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="description">Name</label>
                                            <textarea name="description" id="description" cols="30"  class="form-control" placeholder="Your Description" required></textarea>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="">-- Please Choose --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary create_btn">Create</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th>{{$post->name}}</th>
                                    <th>{{$post->description}}</th>
                                    <th>{{$post->category ? $post->category->name : "-"}}</th>
                                    <th>
                                        <button class="btn btn-sm btn-light edit_btn" data-id="{{$post->id}}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square text-warning"></i></button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Form</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="">
                                                        <input type="hidden" name="post_id" value="{{$post->id}}" id="post_id">
                                                        <div class="form-group mb-2">
                                                            <label for="name">Name</label>
                                                            <input type="text" name="name" id="name" placeholder="Your Name" class="form-control" required>
                                                        </div>
                                                        <div class="form-group mb-2">
                                                            <label for="description">Name</label>
                                                            <textarea name="description" id="description" cols="30"  class="form-control" placeholder="Your Description" required></textarea>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="category_id">Category</label>
                                                            <select name="category_id" id="category_id" class="form-control" required>
                                                                <option value="">-- Please Choose --</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-primary update_btn">Update</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-light delete_btn" data-id="{{$post->id}}"><i class="bi bi-trash3 text-danger"></i></button>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Bootstrap Cdn Scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<!-- Jquery Cdn -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<!-- Sweetalert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
    })
</script>
</body>
</html>