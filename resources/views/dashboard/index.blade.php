@extends('layouts.dashboard')


@section('pageTitle')
Selamat Datang pada sistem informasi Masjid {{env('APP_NAME')}}
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Selamat Datang pada sistem informasi Masjid {{$masjidProfile->nama_masjid}}</h1>
</div>
@endsection

@section('mainContent')
<livewire:dashboard.dashboard-index /> 
<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Admin</h4>
                        </div>
                        <div class="card-body">
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Outsource</h4>
                        </div>
                        <div class="card-body">
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Outsource</h4>
                        </div>
                        <div class="card-body">
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Rumaah Jamaah</h4>
                        </div>
                        <div class="card-body">
                            {{number_format($alamatJamaah->count())}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Jamaah</h4>
                        </div>
                        <div class="card-body">
                            {{number_format($dataJamaah->count())}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"> <h4>ABC</h4> </div>
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"> <h4>ABC</h4> </div>
                    <div class="card-body"></div>
                </div>
            </div>
        </div>
    </div>
    @if(count(app\Models\User::all()) == 1 || Auth::user()->hasrole('Admin') )
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Edit Profile Masjid</h4>
            </div>
            <div class="card-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <small>
                    Update Terakhir <br />
                    Oleh : {{$masjidProfile->data_amil->name}}<br />
                    Pada : {{$masjidProfile->updated_at}}
                </small>
                {{ Form::model($masjidProfile, array('route' => array('adminUpdateMasjidInfo'), 'method' => 'PUT')) }}
                <div class="form-group">
                    {{ Form::label('nama_masjid', 'Nama Masjid') }} <small style="color:red;">*</small>
                    {{ Form::text('nama_masjid', null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('alamat', 'Alamat') }}<small style="color:red;">*</small>
                    {{ Form::textarea('alamat', null, array('class' => 'form-control', 'style' => 'height:70px;')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('nomor_telepon', 'Nomor Telepon') }}<small style="color:red;">*</small>
                    {{ Form::text('nomor_telepon', null, array('class' => 'form-control')) }}
                </div>
                <small>Apabila tidak ada nomor Telephone bisa diisi dengan nomor Handphone penanggung jawab </small>
                <div class="form-group">
                    {{ Form::label('nomor_handphone', 'Nomor Handphone') }}
                    {{ Form::text('nomor_handphone', null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null, array('class' => 'form-control')) }}
                </div>
                {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
                <br>
                <small style="color:red;">*</small> Wajib diisi
            </div>
        </div>
    </div>
    @endif

</div>
@endsection

@section('DynamicScript')
<script src="{{asset('dashboard/js/Chart.min.js')}}"></script>

@endsection
@section('mainContentPopup')


@endsection