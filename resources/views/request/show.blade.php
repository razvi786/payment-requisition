@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center h4">Approve/Deny Payment Requisition</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                        <div class="col-md-6">
                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" disabled>{{ $request->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="invoice" class="col-md-4 col-form-label text-md-right">Invoice</label>

                        <div class="col-md-6">
                            <div id="invoice" name="invoice" class="form-control @error('invoice') is-invalid @enderror">
                                <a href="../../assets/invoices/{{$request->invoice}}" download>{{$request->invoice}}</a>
                                <span class='font-italic'>{{$request->invoice == null ? "No Attachment Available" : ""}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="prf" class="col-md-4 col-form-label text-md-right">Purchase Requisition Form</label>

                        <div class="col-md-6">
                            <div id="prf" name="prf" class="form-control @error('prf') is-invalid @enderror">
                                <a href="../../assets/prf/{{$request->prf}}" download>{{$request->prf}}</a>
                                <span class='font-italic'>{{$request->prf == null ? "No Attachment Available" : ""}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="raised_by" class="col-md-4 col-form-label text-md-right">Raised By</label>

                        <div class="col-md-6">
                            <select id="raised_by" class="form-control @error('raised_by') is-invalid @enderror" name="raised_by" disabled>
                                <option>{{ $request->raisedBy->email }}</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="raised_to_temp" class="col-md-4 col-form-label text-md-right">Raised To</label>

                        <div class="col-md-6">
                            <select id="raised_to_temp" class="form-control @error('raised_to_temp') is-invalid @enderror" name="raised_to_temp" disabled>
                                <option>{{ $request->raisedTo->email }}</option>
                            </select>

                        </div>
                    </div>

                    <form method="PUT" action="{{ route('action.edit', $request->id) }}">

                        <div class="form-group row" {{($user->email != $request->raisedTo->email) ? 'hidden' : ''}}>
                            <label for="raised_to" class="col-md-4 col-form-label text-md-right">Assign For Next Approval</label>

                            <div class="col-md-6">
                                <select id="raised_to" class="form-control @error('raised_to') is-invalid @enderror" name="raised_to" value="{{ old('raised_to') }}" required autocomplete="raised_to" {{ ($user->email == $request->raisedTo->email) ? '' : 'disabled'}}>
                                    @foreach ($users as $u)

                                    <option value="{{$u->id}}" {{($u->email == $request->raisedTo->email) ? 'selected' : ''}}>{{$u->email}}</option>

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
                            <label for="feedback" class="col-md-4 col-form-label text-md-right">Feedback</label>

                            <div class="col-md-6">
                                <textarea id="feedback" type="text" class="form-control @error('feedback') is-invalid @enderror" name="feedback" value="{{ old('feedback') }}" autocomplete="feedback" autofocus {{ ($user->email != $request->raisedTo->email) ? 'disabled' : ''}}>{{($user->email != $request->raisedTo->email) ? $request->feedback : ''}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ $request->status }}" {{ ($user->role == "Accountant" && $user->email == $request->raisedTo->email) ? '' : 'disabled' }}>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button name="action-type" type="submit" class="btn btn-success mx-2 text-dark" value="approve" {{ ($user->email != $request->raisedTo->email) ? 'disabled' : ''}}>
                                    Approve
                                </button>
                                <button name="action-type" type="submit" class="btn btn-warning mx-2 text-dark" value="deny" {{ ($user->email != $request->raisedTo->email) ? 'disabled' : ''}}>
                                    Deny
                                </button>
                                <button name="action-type" type="submit" class="btn btn-danger mx-2 text-light ml-3" value="close" {{ ($user->role == "Accountant" && $user->email == $request->raisedTo->email) ? '' : 'hidden'}}>
                                    Completed
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
