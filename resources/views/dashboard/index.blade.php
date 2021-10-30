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
    <h1>Selamat Datang pada sistem informasi Masjid {{env('APP_NAME')}}</h1>
    
	
</div>
@endsection


@section('mainContent')
<div class="row">
	<div class="col-md-8">
		
	</div>

</div>
@endsection

@section('DynamicScript')

		
@endsection
@section('mainContentPopup')

		
@endsection
