{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="form-group row">
                <label for="id" class="col-md-4 col-form-label text-md-right">Request Id: {{ $details->id }}</label>
            </div>

            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">Status: {{ $details->status }}</label>
            </div>

            <div class="form-group row">
                <label for="feedback" class="col-md-4 col-form-label text-md-right">Feedback: {{ $details->feedback }}</label>
            </div>

            <div class="form-group row">
                <label for="view" class="col-md-4 col-form-label text-md-right"><a href="http://127.0.0.1:8000/request/{{$details->id}}">View Request</a></label>
            </div>

        </div>
    </div>
</div>

{{-- @endsection --}}
