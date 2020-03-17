@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    E-filing
                </div>

                <div class="card-body"> 
                    @if (session('message'))
                        <div class="alert alert-{{ session('alert')}}" role="alert">
                            {{ session('message') }}                                
                        </div>
                    @endif    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <a href="{{ route('index') }}" >Home</a>
                    <br />
                    <form method="POST" action="{{ route('PostCreateStagingDirectory') }}">  
                    @csrf
                    <br />
                        <label>PIN </label> <input name="pin" id="pin" placeholder="pin"  maxlength="6"/>  
                        <br />
                        <br />

                        <button type="submit" class="btn btn-primary">Create</button>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection