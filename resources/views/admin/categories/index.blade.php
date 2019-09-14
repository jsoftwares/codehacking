@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid row">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Categories</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- Create Category Form -->
<div class="card shadow mb-4 col-sm-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create New Category</h6>
    </div>
    
    <div class="card-body">
    @include('includes.form_error')
              {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store', 'class'=>'user']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class'=>'form-control form-control-user', 'id'=>'exampleFirstName', 'placeholder'=>'Name']) !!}
                </div>
              <div class="form-group">
                {!! Form::submit('Create Category', ['class'=>'btn btn-primary btn-user btn-block']) !!}
              </div>
              
              {!! Form::close() !!}
    </div>
</div>

<!-- Categories DataTales Example -->
<div class="card shadow mb-4 col-sm-7">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">All Post Categories</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </tfoot>
        <tbody>
            <!-- Checks if there are users before looping -->
            @if($categories)
            @foreach($categories as $category)
          <tr>
            <td>{{$category->id}}</td>
            <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
            <td>{{$category->created_at ? $category->created_at->diffForHumans(): 'No Date'}}</td>
            <td>{{$category->updated_at ? $category->updated_at->diffForHumans(): 'No Date'}}</td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

@stop