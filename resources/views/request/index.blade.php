@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center h4">All Requests</div>

                <div class="card-body">
                    <livewire:all-request-table/>


                </div>
            </div>
        </div>
    </div>

</div>
@endsection
