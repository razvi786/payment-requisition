@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center h4">Raise Payment Requisition</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('request.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description" autofocus></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="raised_to" class="col-md-4 col-form-label text-md-right">Raise To</label>

                            <div class="col-md-6">
                                <select id="raised_to" class="form-control @error('raised_to') is-invalid @enderror" name="raised_to" value="{{ old('raised_to') }}" required autocomplete="raised_to">
                                    @foreach ($users as $user)

                                    <option value="{{$user->id}}">{{$user->email}}</option>

                                    @endforeach
                                </select>

                                @error('raised_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invoice" class="col-md-4 col-form-label text-md-right">Invoice</label>

                            <div class="col-md-6">

                                <input id="invoice" type="file" name="invoice" class="form-control @error('invoice') is-invalid @enderror">

                                @error('invoice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prf" class="col-md-4 col-form-label text-md-right">Purchase Requisition Form</label>

                            <div class="col-md-6">

                                <input id="prf" type="file" name="prf" class="form-control @error('prf') is-invalid @enderror">

                                @error('prf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Raise Request
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
