@extends('layouts.app')

@section('content')
    <div class="pb-2 mb-2"><h2>Gateway</h2></div>
    <div class="card">
        <div class="card-body">
            @if($netdev->id)
                {!! Form::open(['route' => ['gateway.update', $netdev->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
            @else
                {!! Form::open(['route' => 'gateway.store']) !!}
            @endif
                @csrf
                
                @include('inc.deviceform')

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <a href="/gateway" class="btn btn-secondary">Back</a>
                    </div>
                </div>            
            {!! Form::close() !!}
        </div>
    </div>
@endsection
