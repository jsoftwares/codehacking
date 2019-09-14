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
              {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id], 'class'=>'user']) !!}
                <div class="form-group">
                    {!! Form::text('name', null, ['class'=>'form-control form-control-user', 'id'=>'exampleFirstName', 'placeholder'=>'Name']) !!}
                </div>
              <div class="form-group">
                {!! Form::submit('Update Category', ['class'=>'btn btn-success btn-user btn-block']) !!}
              </div>
              
              {!! Form::close() !!}
              <!-- DELETE FORM -->
              {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id], 'class'=>'user']) !!}
              <div class="form-group">
                {!! Form::submit('Delete Category', ['class'=>'btn btn-danger btn-user btn-block']) !!}
              </div>
              {!! Form::close() !!}
    </div>
</div>

</div>
<!-- /.container-fluid -->

@stop