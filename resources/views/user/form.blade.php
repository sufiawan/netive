@extends('layouts.app')

@section('content')
	<div class="pb-2 mb-2"><h2>User</h2></div>
    <div class="card">        
        <div class="card-body">
            @if($data->id)
                {!! Form::open(['route' => ['user.update', $data->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
            @else
                {!! Form::open(['route' => 'user.store']) !!}
            @endif
                @csrf

                <div class="form-row">
                	<div class="form-group col-md-6">
                		{{ Form::label('nip', 'NIP') }}
                		<input id="nip" type="number" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip" value="{{ old('nip', $data->nip) }}" required>
                        @if ($errors->has('nip'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nip') }}</strong>
                            </span>
                        @endif
                	</div>                            
                    <div class="form-group col-md-6">
                    	{{ Form::label('name', 'Name') }}
                		<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $data->name) }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                	</div>
                </div>
                
                <div class="form-row">
                	<div class="form-group col-md-6">
                		{{ Form::label('email', 'E-Mail Address') }}
                		<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $data->email) }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                	</div>                            
                    <div class="form-group col-md-6">
                    	{{ Form::label('role_id', 'Role') }}
                		<select id="role_id" name="role_id" class="form-control">
                        	<?php foreach ($roles as $role) { ?>
                        	<option value="<?php echo $role->id; ?>" {{ ($data->role_id == $role->id) ? "selected=selected" : "abc" }}><?php echo $role->name; ?></option>
                        	<?php } ?>
                    	</select>
                	</div>
                </div>           
        </div>
        <div class="card-header">Password</div>
		<div class="card-body">                
                @if(!$data->id)
					<div class="form-row">
                        <div class="form-group col-md-6">                        
                            {{ Form::label('password', 'Password') }}                        
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
    
                        <div class="form-group col-md-6">                        
                            {{ Form::label('password-confirm', 'Confirm Password') }}                        
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>                        
                        </div>
            		</div>
                @endif

            <div class="form-row">
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                    <a href="/user" class="btn btn-secondary">Back</a>
                </div>
            </div>
            {!! Form::close() !!}                    
		</div>
    </div>        
@endsection
