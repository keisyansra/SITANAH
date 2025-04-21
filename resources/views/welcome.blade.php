@extends('layouts.template')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Welcome to Grand Heaven/h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            Sealamat datang di tanah makam anda, kami menyediakan tempat peristirahatan terakhir yang terbaik untuk anda
        </div>
    </div>
    <!-- Post -->
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="post">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <a href="{{ url('/') }}">
                                <img class="img-fluid" src="{{ asset('adminlte/dist/img/MAKAM/makam.jpg') }}" alt="Photo">
                            </a>
                            {{-- <a href="{{ url('/') }}">
                                <img class="img-fluid" src="{{ asset('adminlte/dist/img/MAKAM/makam4.jpg') }}" alt="Photo">
                            </a> --}}
                        </div>
                        <!-- /.col -->
                        {{-- <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="{{ url('/') }}">
                                        <img class="img-fluid mb-3" src="{{ asset('adminlte/dist/img/MAKAM/makam4.jpg') }}"
                                            alt="Photo">
                                    </a>
                                    {{-- <a href="{{ url('/') }}">
                                        <img class="img-fluid" src="{{ asset('adminlte/dist/img/MAKAM/makam3.jpg') }}"
                                            alt="Photo">
                                    </a> --}}
                                {{-- </div> --}} 
                                <!-- /.col -->
                                {{-- <div class="col-sm-6">
                                    <a href="{{ url('/') }}">
                                        <img class="img-fluid mb-3" src="{{ asset('adminlte/dist/img/pics/5.jpg') }}"
                                            alt="Photo">
                                    </a>
                                    <a href="{{ url('/') }}">
                                        <img class="img-fluid" src="{{ asset('adminlte/dist/img/pics/6.jpg') }}"
                                            alt="Photo">
                                    </a>
                                </div> --}}
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
    </div>
@endsection