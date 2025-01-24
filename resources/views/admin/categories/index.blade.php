@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 nb-3 d-flex align-item-center justify-content-between">
                <h3>Categories</h3>
                <a class="btn btn-outline-primary" 
                    href="{{route('admin.categories.create')}}">
                    Create categories
                </a>
            </div>
            <div class="col-12 table-responsive">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Products</th>
                            <th>Created At</th>
                            <th>Updated Att</th>
                        </tr>
                    </thead>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->parent?->name ?? '-'}}</td>
                            <td>{{ $category->products_count }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                    <button type="button" class="btn btn-outline-primary">edit</button>
                                    <button type="button" class="btn btn-outline-primary">delete</button>
                               </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="col-12">
                    {{$categories->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection