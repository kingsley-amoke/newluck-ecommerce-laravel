<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Support\Facades\Auth;

class PendingController extends Controller
{
public function index(){

if(!Auth::user()){
    return redirect()->route('index');
}


$pending = Order::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->where('status', 'pending')->get();


return view('pending.index', [ 'pending'=>$pending]);
}

public function show($id){

if(!Auth::user()){
    return redirect()->route('index');
}

$order = Order::findorFail($id);
return view('pending.show', ['order' => $order]);
}

}

?>