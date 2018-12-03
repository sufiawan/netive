@extends('layouts.app')

@section('content')
<div class="pb-2 mb-2"><h2>Switch</h2></div>    
<div class="card">
    <div class="card-body">        
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#general">General</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#port">Port</a>
            </li>                
        </ul>       

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane show active mb-1" id="general">
                <div class="fom">
                    @include('inc.deviceview')

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{ Form::label('switch_type_id', 'Switch Type') }}
                            <input id="switch_type_id" type="text" class="form-control" name="switch_type_id" value="{{ $data->switch_type->name }}" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            {{ Form::label('location', 'Location') }}
                            <input id="location" type="text" class="form-control" name="location" value="{{ $data->location }}" readonly>
                        </div>
                    </div>                                
                </div>
            </div>
            <div class="tab-pane" id="port">
                @include('networkswitch.port')
            </div>
        </div>               
    </div>
    <div class="card-body">
        <a href="/networkswitch" class="btn btn-secondary">Back</a>            
    </div>
</div>
@endsection
