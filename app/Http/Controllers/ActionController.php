<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $incomingRequest, $requestId)
    {
        $feedback = "";
        $status = "";
        $actionType = "";
        $raisedTo = "";
        $request = ModelsRequest::findOrFail($requestId);

        if($incomingRequest->has('feedback') && $incomingRequest->input('feedback') != ''){
            $feedback = $incomingRequest->input('feedback');
        }else{
            $feedback = $request->feedback;
        }

        if($incomingRequest->has('status') && $incomingRequest->input('status') != '' && $incomingRequest->input('status') != $request->status){
            $status = $incomingRequest->input('status');
        }else{
            if ($incomingRequest->has('action-type')) {
                $actionType = $incomingRequest->input('action-type');
                if($actionType == 'approve'){
                    $status = "Approved By ".auth()->user()->role;
                }else if($actionType == 'deny'){
                    $status = "Denied By ".auth()->user()->role;
                }else{
                    $status = "Completed";
                }
            }else{
                $status = $request->status;
            }
        }

        if($incomingRequest->has('raised_to') && $incomingRequest->input('raised_to') != ''){
            $raisedTo = $incomingRequest->input('raised_to');
        }else{
            $raisedTo = $request->raisedTo->id;
        }

        $request->update([
            'id' => $requestId,
            'feedback' => $feedback,
            'status' => $status,
            'raised_to' => $raisedTo,

        ]);

        return redirect('/send-email/'. $request->id);
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
