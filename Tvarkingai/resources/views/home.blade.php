@extends('layouts.app')


@section('form')

    <div>
        <form action="/" method="post">
            @csrf
            
            <div class="form-group">
                <label>Category name:</label>
                <input class="form-control" type="text" name="category_name">
            </div>
            <div class="form-group">
                <label for="formControlSelect">Assign category to:</label>
                <select name="parent" multiple class="form-control" id="formControlSelect">
                    <option>New category</option>

                    @foreach($data as $category)
                        <option>{{ $category->cat_name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Add Category</button>
            </div>
        </form>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection

@section('iterative')

    <div class="panel-group">
        <div class="panel panel-color">
            <div class="panel-heading panel-bg-color">Iterative way
                @include('partials.howfastiterative', [$recursive_timer, $iterative_timer])
            </div>
            <div class="panel-body">
                <ul>
                    @each('partials.tree', $iterative_tree, 'category','partials.empty')
                </ul>
            </div>
        </div>
    </div>

@endsection
    
@section('recursive')
    
    <div class="panel-group">
        <div class="panel panel-color">
            <div class="panel-heading panel-bg-color">Recursive way
                @include('partials.howfastrecursive', [$recursive_timer, $iterative_timer])
            </div>
            <div class="panel-body">
                <ul>
                    @each('partials.tree', $recursive_tree, 'category','partials.empty')
                </ul>
            </div>
        </div>
    </div>

@endsection