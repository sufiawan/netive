@extends('layouts.app')

@section('content')
    <div class="pb-2 mb-2"><h2>Virtual LAN</h2></div>
    <div class="card">
        <div class="card-body">
            @if($data->id)
                {!! Form::open(['route' => ['virtuallan.update', $data->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
            @else
                {!! Form::open(['route' => 'virtuallan.store']) !!}
            @endif
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('name', 'Name') }}
                        <input id="name" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $data->name) }}"  placeholder="name" required>
                        @if ($errors->has('string'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('string') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('ip_segment', 'IP Segment') }}
                        <input id="ip_segment" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="ip_segment" value="{{ old('ip_segment', $data->ip_segment) }}" placeholder="ip segment" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}">
                        @if ($errors->has('ipaddress'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ipaddress') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        {{ Form::label('description', 'Description') }}
                        <input id="description" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="description" value="{{ old('description', $data->description) }}" placeholder="description">
                        @if ($errors->has('string'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('string') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <a href="/virtuallan" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </form>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
