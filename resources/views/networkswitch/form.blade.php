@extends('layouts.app')

@section('content')
<div class="pb-2 mb-2"><h2>Switch</h2></div>    
<div class="card">
    <div class="card-body">
        @if($data->id)
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#general">General</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#port">Port</a>
            </li>                
        </ul>
        @endif
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane show active mb-1" id="general">
                @if($data->id)
                {!! Form::open(['route' => ['networkswitch.update', $data->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
                @else
                {!! Form::open(['route' => 'networkswitch.store']) !!}
                @endif

                @csrf

                @include('inc.deviceform')

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('switch_type_id', 'Switch Type') }}
                        <select id="switch_type_id" name="switch_type_id" class="form-control" {{ ($data->id) ? "disabled" : "" }}>
                            <?php foreach ($switchtypes as $switchtype) { ?>
                                <option value="<?php echo $switchtype->id; ?>" {{ ($data->switch_type_id == $switchtype->id) ? "selected=selected" : "" }}><?php echo $switchtype->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        {{ Form::label('location', 'Location') }}
                        <input id="location" type="text" class="form-control" name="location" value="{{ old('location', $data->location) }}" placeholder="location">
                    </div>
                </div>

                @if(!$data->id)
                <div class="form-row">                            
                    <div class="form-group col-md-4">
                        {{ Form::label('number_of_port', 'Number of Port') }}
                        <input id="number_of_port" type="number" class="form-control" name="number_of_port" value="" placeholder="number of port" min=1 required>
                        <small class="form-text text-muted">generate port record</small>
                    </div>
                </div>
                @endif

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <a href="/networkswitch" class="btn btn-secondary">Back</a>
                    </div>
                </div>            
                {!! Form::close() !!}
            </div>
            @if($data->id)
            <div class="tab-pane" id="port">                    
                @include('networkswitch.port')
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
