@extends('layouts.dashboard')


@section('pageTitle')
    Laporan Penerimaan Tahun {{$nowMasehi}}
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Laporan Penerimaan Tahun {{$nowMasehi}}</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('adminkas-penerimaan.create') }}"> <i class="fas fa-pencil"></i> Tambah Data</a>
	</div>
	
</div>
@endsection


@section('mainContent')
<div class="row">
	<div class="col-md-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Penerimaan Tahun - {{$nowMasehi}}H</h6>
            </div>
			<div class="card-body">
				<div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th name="DT_RowIndex">No</th>
                                <th name="created_at">Tanggal</th>
                                <th name="keterangan">Keterangan</th>
                                <th name="penerimaan">Jumlah Uang</th>
                                <th name="Actions">Lihat</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Saldo Terhitung</h6>
            </div>
            <div class="card-body">
                Penerimaan<br/>
                <p style="text-align:right;">{{number_format($totalKasPenerimaan)}}</p>
                Pengeluaran<br/>
                <p style="text-align:right;">{{number_format($totalKasPengeluaran)}}</p>
                <hr/>
                Total : {{number_format($totalKasPenerimaan-$totalKasPengeluaran)}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('DynamicScript')
		<!-- Specific Page Vendor -->
		<script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script>
            $(function(){
                var table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('adminkas-penerimaan.index') }}",
                    columns : [
                        {data:'DT_RowIndex',name:'DT_RowIndex'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'keterangan', name: 'keterangan'},
                        {data: 'penerimaan', name: 'penerimaan'},
                        {data: 'action', name: 'action', orderable: 'false'},
                    ]
                });
            });
        </script>
@endsection

@section('mainContentPopup')
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
