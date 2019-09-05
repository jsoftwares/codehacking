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
                <h1 class="h4 text-gray-900 mb-4">Create New User!</h1>
              </div>
              @include('includes.form_error')
              {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store', 'files'=>true, 'class'=>'user']) !!}
              <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    {!! Form::text('Firstname', null, ['class'=>'form-control form-control-user', 'id'=>'exampleFirstName', 'placeholder'=>'First Name']) !!}
                  </div>
                  <div class="col-sm-6">
                    {!! Form::text('Lastname', null, ['class'=>'form-control form-control-user', 'id'=>'exampleLastName', 'placeholder'=>'Last Name']) !!}
                  </div>
                </div>
                <div class="form-group">
                    {!! Form::email('Email', null, ['class'=>'form-control form-control-user', 'id'=>'exampleInputEmail', 'placeholder'=>'Email Address']) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('Role', [''=>'Choose Role']+$roles, null, ['class'=>'form-control form-control-select']) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('Status', array(1=>'Active', 0=>'Inactive'), 0, ['class'=>'form-control form-control-select']) !!}
                </div>
                <div class="form-group">
                    {!! Form::file('Photo', ['class'=>'form-control', 'placeholder'=>'Upload Photo']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('Password', ['class'=>'form-control form-control-user', 'id'=>'exampleInputPassword', 'placeholder'=>'Password']) !!}
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