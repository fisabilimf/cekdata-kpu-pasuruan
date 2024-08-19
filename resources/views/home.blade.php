@extends('layouts.app')

@section('content')
<head>
    <script src="https://kit.fontawesome.com/5469080821.js" crossorigin="anonymous"></script>
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body d-flex">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary mb-2 d-flex flex-column justify-content-center m-2" href="{{ route('admin.dataBaru') }}" style="width: 15rem; height: 10rem">
                        <i class="fas fa-calendar-plus w-100" style="font-size: 5rem"></i>
                        Periksa permohonan Data Baru
                    </a>
                    <a class="btn btn-primary mb-2 d-flex flex-column justify-content-center m-2" href="{{ route('admin.dataUbah') }}" style="width: 15rem; height: 10rem">
                        <i class="fas fa-file-invoice w-100" style="font-size: 5rem"></i>
                        Periksa permohonan Perubahan Data
                    </a>
                    <a class="btn btn-primary mb-2 d-flex flex-column justify-content-center m-2" href="{{ route('admin.dataTms') }}">
                        <i class="fas fa-times-circle w-100" style="font-size :5rem"></i>
                        Periksa permohonan Data TMS
                    </a>
                    <a class="btn btn-primary mb-2 d-flex flex-column justify-content-center m-2" href="{{ route('admin.manajemen') }}">
                        <i class="fas fa-database w-100" style="font-size: 5rem"></i>
                        Manajemen Data
                    </a>
                    <a class="btn btn-secondary mb-2 d-flex flex-column justify-content-center m-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                        <i class="fas fa-sign-out-alt w-100" style="font-size: 5rem"></i>
                        Logout
                    </a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
