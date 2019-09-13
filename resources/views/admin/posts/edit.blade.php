@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
          <div class="col-lg-8">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edit Post</h1>
              </div>
              @include('includes.form_error')
              {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true, 'class'=>'user']) !!}
                <div class="form-group">
                    {!! Form::text('title', null, ['class'=>'form-control form-control-user', 'id'=>'exampleFirstName', 'placeholder'=>'Title']) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('category_id', $categories, null, ['class'=>'form-control form-control-select']) !!}
                </div>
                <div class="form-group">
                    {!! Form::file('image_id') !!}
                </div>
                <div class="form-group">
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'id'=>'exampleInputPassword']) !!}
                </div>
              <div class="form-group">
                {!! Form::submit('Update Post', ['class'=>'btn btn-primary btn-user btn-block col-sm-6']) !!}
              </div>
              {!! Form::close() !!}

              <!-- DELETE FORM -->
              {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id], 'class'=>'user']) !!}
              <div class="form-group">
                {!! Form::submit('Delete Post', ['class'=>'btn btn-danger btn-user btn-block col-sm-6']) !!}
              </div>
              {!! Form::close() !!}
              </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@stop