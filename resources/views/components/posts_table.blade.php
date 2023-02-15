@props(['posts','categories'])
<table class="table table-bordered table-striped mb-4">
    <thead>
        <th>{{__('messages.name')}}</th>
        <th>{{__('messages.description')}}</th>
        <th>{{__('messages.category')}}</th>
        <th>Created At</th>
        <th>{{__('messages.action')}}</th>
    </thead>
    <tbody>
        <div class="row">
            <div class="col-4">
                <div class="input-group mb-3">
                    <form action="" class="search_form">
                        <i class="bi bi-x" id="clear_btn" style="position: absolute;top: 6px;right: 8px;z-index: 999;cursor: pointer;"></i>
                        <button class="btn btn-primary" id="basic-addon1" type="submit">Search</button>
                        <input type="text" class="form-control " id="search" placeholder="Search here...." aria-label="Username" aria-describedby="basic-addon1" name="search" value="{{request()->search}}">
                    </form>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Date</span>
                    <input type="text" name="date" value="{{request()->date}}"  class="form-control date" placeholder="All"/>
                </div>
            </div>
            <div class="col-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Category</span>
                    <select name="category"  class="form-control category_search">
                        <option value="">All</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}"
                             @if (request()->category == $category->id)
                                selected
                            @endif>
                            {{$category->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    @forelse ($posts as $post)
        <tr>
            <td>{{$post->name}}</td>
            <td>{{Illuminate\Support\Str::limit($post->description,50,'.....')}}</td>
            <td>{{$post->category ? $post->category->name : "-"}}</td>
            <td>{{$post->created_at->format('Y-m-d')}}</td>
            <td>
                <button class="btn btn-sm btn-light edit_btn mb-2" data-id="{{$post->id}}" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square text-warning"></i></button>
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
                <button class="btn btn-sm btn-light delete_btn mb-2" data-id="{{$post->id}}"><i class="bi bi-trash3 text-danger"></i></button>
            </td>
            @empty
            <td colspan="4" class="text-center">Noting To Show</td>
        </tr>
    @endforelse
    </tbody>
</table>
{{$posts->links()}}