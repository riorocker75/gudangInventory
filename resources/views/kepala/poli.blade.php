@extends('layouts.main_app')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Poli</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Poli</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->



    </div>  
    
    <section class="content">
      
     

              @php
                  $poli = DB::table('rekam')
                 ->select('id_poli', DB::raw('count(*) as total'))
                 ->groupBy('id_poli')
                 ->get();
              @endphp

           
                <div class="row">
                     @foreach ($poli as $item)
                  
                @php
                    $cek=App\Models\Poli::where('id',$item->id_poli)->get();

                @endphp
                  {{-- <p>
                    {{$cp->prosedur}} : {{$item->total}} pasien
                  </p>  --}}
                  @foreach ($cek as $cp)
                  <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$item->total}} pasien</h3>

                            <p> {{$cp->prosedur}}</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                  </div>
                  
                  @endforeach
                 
                  @endforeach
                </div>

            
              {{-- {{$cek->prosedur}} --}}
        
      
         
      </section>   

</div>  


@endsection