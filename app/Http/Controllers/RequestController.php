<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRequest;
use App\Models\Request as ModelsRequest;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->except(Auth::id())->where('role','=','Manager');

        return view('request.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestRequest $request)
    {
        // dd($request);
        $request->validated();

        $invoiceName = "";
        if($request->invoice != null){
            $invoiceName = 'Invoice ' . rand(1000000000,9999999999) . '.' . $request->invoice->extension();
            $request->invoice->move(public_path('assets/invoices'), $invoiceName);
        }

        $prfName = "";
        if($request->prf != null){
            $prfName = 'PR Form ' . rand(1000000000,9999999999) . '.' . $request->prf->extension();
            $request->prf->move(public_path('assets/prf'), $prfName);
        }

        $newRequest = ModelsRequest::create([
            'description' => $request->description,
            'raised_by' => auth()->user()->id,
            'raised_to' => $request->raised_to,
            'invoice' => $invoiceName,
            'prf' => $prfName,
            'status' => "Request Raised",

        ]);
        return redirect('/send-email/'. $newRequest->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = ModelsRequest::findOrFail($id);
        $users = User::all()->except(Auth::id());
        $user = auth()->user();

        return view('request.show', compact('request','users','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
