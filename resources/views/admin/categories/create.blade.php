@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 text-center">
                <h3> Create category</h3>
            
            </div>
            <form  action="{{route('admin.categories.store')}}" method="POST" 
            class="card col-8 offset-2 fs-5">
                @csrf
                <div class="card-body p-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" placeholder="Category name" value="{{old('name')}}"
                            class="form-control @error('name') is-invalid @enderror" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Name</label>
                       <select name="parent_id" id="parent_id" class="form-control">
                            <option value="{{null}}" selected>No Parent</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                       </select>
                    </div>
                </div>
                <div class="card-footer bg-light d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-primary ">
                        Create category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection