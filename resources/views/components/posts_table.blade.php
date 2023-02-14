@props(['posts','categories'])
<table class="table table-bordered table-striped">
    <thead>
        <th>{{__('messages.name')}}</th>
        <th>{{__('messages.description')}}</th>
        <th>{{__('messages.category')}}</th>
        <th>{{__('messages.action')}}</th>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.update_form')}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form action="">
                                <input type="hidden" name="post_id" value="{{$post->id}}" id="post_id">
                                <div class="form-group mb-2">
                                    <label for="name" class="mb-2">{{__('messages.name')}}</label>
                                    <input type="text" name="name" id="name" placeholder="{{__('messages.name')}}" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="mb-2">{{__('messages.description')}}</label>
                                    <textarea name="description" id="description" cols="30"  class="form-control" placeholder="{{__('messages.description')}}" required></textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="category_id" class="mb-2">{{__('messages.category')}}</label>
                                    <select name="category_id" id="category_id" class="choose form-control" required>
                                        <option value="">-- {{__('messages.choose')}} --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.cancel')}}</button>
                                    <button type="button" class="btn btn-primary update_btn">{{__('messages.update')}}</button>
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