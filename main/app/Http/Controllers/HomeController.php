<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;

use App\Mail\TestMail;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }

    public function sendMail(Request $request) {
        $data = $request -> validate([
            'text' => 'string'
        ]);

        Mail::to(Auth::user() -> email)
            -> send(new TestMail($data['text']));
        
        return redirect() -> back();
    }

    //nuovo
    public function updateUserIcon(Request $request){
        $request->validate([
            'icon'=>'required|file'
        ]);

        $this->deleteUserIcon();
        
        $image=$request->file('icon');
        $ext=$image->getClientOriginalExtension();
        $name=rand(100000, 999999) . '_' . time(); //per evitare nomi duplicati
        $destFile=$name . '.' . $ext; //aggiunge l'estensione al nome

        $file=$image->storeAs('icon', $destFile, 'public');

        $user=Auth::user();
        $user->icon=$destFile;
        $user->save();

        // dd($image, $ext, $name, $destFile);
        return redirect()->back();
    }

    public function clearUserIcon(){
        $this->deleteUserIcon();

        $user=Auth::user();
        $user->icon=null;
        $user->save();

        return redirect()->back();
    }

    private function deleteUserIcon(){
        $user=Auth::user();
        try{
            $fileName=$user->icon;
            $file=storage_path('app/public/icon/'.$fileName);
            File::delete($file);
        }catch(\Exception $e){}
        
    }
}
