@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">User Card Update</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('update-icon')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <input name="icon" type="file" class="form-controller border-0">

                        <br><br>

                        <input type="submit" class="btn btn-primary" value="Update Image">
                        <a href="{{route('clear-icon')}}" class="btn btn-danger">Clear Image</a> 
                    </form>
                </div>
            </div>

            <br><br>

            <div class="card">
                <div class="card-header">Mail Sender</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('send-mail')}}" method="POST">
                        @csrf
                        @method('POST')
                        <label for="text">Text</label>
                        <input type="text" name="text">
                        <br>
                        <input type="submit" value="SEND MAIL">
                    </form>
                    
                </div>
            </div>

            

            @if (Auth::user()->icon)
                <br><br>
                <div class="card">
                    <div class="card-header">Icon</div>

                    <div class="card-body">
                        <h1>Trust me, I'm an engineer</h1>
                        <br>
                        <img src="{{asset('storage/icon/'.Auth::user()->icon)}}" width="400px">  
                    </div>
                </div> 
            @endif
            

        </div>
    </div>
</div>
@endsection
