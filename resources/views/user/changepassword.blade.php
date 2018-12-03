@extends('layouts.app')

@section('content')
<div class="pb-2 mb-2 offset-3"><h2>Change Password</h2></div>
<div class="card col-md-6 offset-3">        
    <div class="card-body">        
        {!! Form::open(['action' => ['UserController@changepassword']]) !!}
        {{ Form::hidden('_method', 'PUT') }}

        @csrf
        
        <div class="form-row">
            <div class="form-group col-md-12">                        
                {{ Form::label('current_password', 'Current Password') }}
                <input id="current_password" type="password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password" required>                
                @if ($errors->has('current_password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('current_password') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">                        
                {{ Form::label('password', 'New Password') }}
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                <small class="form-text text-muted">Password must be more than 6 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.</small>
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        </div>    
        
        <div class="form-row">
            <div class="form-group col-md-12">                        
                {{ Form::label('password_confirmation', 'Confirm Password') }}                        
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>                        
            </div>
        </div>    

        <div class="form-row">
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                <a href="/" class="btn btn-secondary">Back</a>
            </div>
        </div>
        {!! Form::close() !!}                    
    </div>
</div>        
@endsection
