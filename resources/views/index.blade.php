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
                   
                   
                    <table class="table"> 
                        <thead>
                            <tr>
                                <td>Folder Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($data as $folder)
                        <?php $pin = explode('\\',$folder); ?>               
                            <tr>
                                <td><a href="{{ route('GetStagingFiles', ['pin' => $pin[count($pin)-1] ])}}" > {!! $pin[count($pin)-1] !!} </a></td>
                                <td>
                                <a href="{{ route('DeleteStagingDirectory', ['pin' => $pin[count($pin)-1]]) }}" > Delete </a>
                                 </td>
                            </tr>
                        @empty
                            <tr>
                                <td col-span="2">
                                    <p>no files</p>
                                </td>
                            </tr>               
                        @endforelse   
                        </tbody>
                    </table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection