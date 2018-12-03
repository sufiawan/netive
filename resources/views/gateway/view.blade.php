@extends('layouts.app')

@section('content')
<div class="pb-2 mb-2"><h2>Gateway</h2></div>
<div class="card">
    <div class="card-body">
        <div class="form">

            @include('inc.deviceview')

            <div class="form-row">
                <div class="form-group col-md-6">                    
                    <a href="/gateway" class="btn btn-secondary">Back</a>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection
