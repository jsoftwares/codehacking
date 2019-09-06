@extends('layouts.admin')
@section('content')
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-3 d-none d-lg-block">
              <img src="{{asset($user->photo ? $user->photo->file : 'images/400x400.png')}}" width="200" alt="" class="img-responsive img-rounded">
          </div>
          <div class="col-lg-9">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Update User!</h1>
              </div>
              @include('includes.form_error')
              {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true, 'class'=>'user']) !!}
              <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    {!! Form::text('name', null, ['class'=>'form-control form-control-user', 'id'=>'exampleFirstName', 'placeholder'=>'First Name']) !!}
                  </div>
                  <div class="col-sm-6">
                    {!! Form::text('lastname', null, ['class'=>'form-control form-control-user', 'id'=>'exampleLastName', 'placeholder'=>'Last Name']) !!}
                  </div>
                </div>
                <div class="form-group">
                    {!! Form::email('email', null, ['class'=>'form-control form-control-user', 'id'=>'exampleInputEmail', 'placeholder'=>'Email Address']) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('role_id', $roles, null, ['class'=>'form-control form-control-select']) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('status', array(1=>'Active', 0=>'Inactive'), null, ['class'=>'form-control form-control-select']) !!}
                </div>
                <div class="form-group">
                    {!! Form::file('photo_id', ['class'=>'form-control', 'placeholder'=>'Upload Photo']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password', ['class'=>'form-control form-control-user', 'id'=>'exampleInputPassword', 'placeholder'=>'Password']) !!}
                </div>
              <div class="form-group">
                {!! Form::submit('Create User', ['class'=>'btn btn-primary btn-user btn-block']) !!}
              </div>
              
              {!! Form::close() !!}
                <hr>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

@stop