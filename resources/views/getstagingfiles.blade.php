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
                    <br /><br />
                    <br />
                    
                    <?php 
                    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $url_path = parse_url($url, PHP_URL_PATH);
                    $basename = pathinfo($url_path, PATHINFO_BASENAME);
                    ?>
                    <table class="table"> 
                        <thead>
                            <tr>
                                <td>File Name</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($data as $files)      
                            <?php $file = explode('\\',$files); ?>                        
                            <tr>
                                <td><a href="<?=$files?>" > {!! $file[count($file)-1] !!} </a></td>
                                <td><a href="{{ route('DeleteStagingFiles', ['pin' => $basename , 'fileName'=> $file[count($file)-1]  ]) }}" >delete</a> </td>
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
                   
                            
                    
                    
                    <br /><br />
                    <br />
                   
                    <a href="{{ route('CopyToBackUp', ['pin' => $basename]) }}" > Commit </a> | 

                    <a href="{{ route('DeleteStagingDirectory', ['pin' => $basename]) }}" > Delete Directory </a>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection