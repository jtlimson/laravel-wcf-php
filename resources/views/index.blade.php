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
                    <a href="{{ route('CreateStagingDirectory') }}" >Create Folder</a>
                    <br />
                    <br />
                    <br />
                    <ul>
                   
                    @forelse ($data as $folder)
                        <?php $pin = explode('\\',$folder); ?>                                    
                        <li>
                            <a href="{{ route('GetStagingFiles', ['pin' => $pin[count($pin)-1] ])}}" > {!! $pin[count($pin)-1] !!} </a>
                        </li>                      
                    @empty
                            <p>no folder</p>
                    @endforelse
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection