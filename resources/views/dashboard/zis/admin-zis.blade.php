@extends('layouts.dashboard')
@section('pageTitle')
    ZIS Dashboard
@endsection

@section('titleBar')
<div class="section-header">
    <h1>ZIS Dashboard</h1>
	
</div>
@endsection

@section('mainContent')
<!--Row1-->

<!--Row2-->
<style type="text/css">
    .number-form{
        text-align:right;
    }
</style>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Rekap Penerimaan data Pencatatan Tanggal <br/> 
                Tanggal Hijriah : {{$nowHijri}} <br/>
                Tanggal Masehi :  {{$nowMasehi}}</h4>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <!---Card 1--->
        <div class="card">
            <div class="card-header"><h4>Type Zis</h4></div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        {{ Form::open(array('route' => 'adminzis-type.store'))}}
                        <div class="form-group">
                            {{ Form::text('zis_type', '', array('class'=>'form-control', 'placeholder'=>'Contoh : Zakat Fitrah')) }}
                        </div>
                    </div>
                    <div class="col-4">
                        {{ Form::submit('Tambah', array('class' => 'btn btn-primary')) }}
                        {{ Form::close() }}
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Type Zakat</td>
                            <td>Hapus</td>
                        </tr>
                        @foreach($zisType as $ztp)
                        <tr>
                            <td>{{$ztp->zis_type}}</td>
                            <td>
                                <form method="POST" action="{{route('adminzis-type.destroy', $ztp->id)}}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!--End Of Card 1--->
    </div>
</div>
@endsection
@section('DynamicScript')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
 
 $('.show_confirm').click(function(event) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: 'Anda yakin akan menghapus data?',
          text: "Data akan terhapus secara permanen.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
        }
      });
  });

</script>
@endsection