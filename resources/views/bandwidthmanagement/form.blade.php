@extends('layouts.app')

@section('content')
    <div class="pb-2 mb-2"><h2>Bandwidth Management</h2></div>
    <div class="card">
        <div class="card-body">
            @if($netdev->id)
                {!! Form::open(['route' => ['bandwidthmanagement.update', $netdev->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
            @else
                {!! Form::open(['route' => 'bandwidthmanagement.store']) !!}
            @endif
                @csrf                               
                
                @include('inc.deviceform')

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <a href="/bandwidthmanagement" class="btn btn-secondary">Back</a>
                    </div>
                </div>            
            {!! Form::close() !!}
        </div>
    </div>
@endsection
