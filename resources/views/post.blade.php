<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card my-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>{{__('messages.title')}}</h4>
                       <div>
                         <!-- Button Create modal -->       
                         <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bi bi-plus-circle me-1"></i> {{__('messages.create_post')}}</button>         
                         <!-- Modal -->
                         <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                     <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.create_form')}}</h1>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                     </div>
                                     <div class="modal-body">
                                     <form action="">
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
                                             <select name="category_id" id="category_id" class="form-control" required>
                                                 <option value="">-- {{__('messages.choose')}} --</option>
                                             @foreach ($categories as $category)
                                                 <option value="{{$category->id}}">{{$category->name}}</option>
                                             @endforeach
                                             </select>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.cancel')}}</button>
                                             <button type="button" class="btn btn-primary create_btn">{{__('messages.create')}}</button>
                                         </div>
                                     </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                       </div>
                    </div>
                    <div class="card-body">
                        <x-posts_table :posts="$posts" :categories="$categories"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>