@extends('layouts.app')

@section('template_title')
    Resporte de resultados
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Reporte de resultados</span>
                    </div>
                    <div class="card-body">
                        {{-- <form method="POST" action="{{ route('campana.update', $campaña->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('campaña.form')

                        </form> --}}
                            <h1>Laravel ChartJS Chart Example - ItSolutionStuff.com</h1>
                            <canvas id="myChart" height="100px"></canvas>
                                               
                    </div>
                </div>
            </div>
        </div>
    </section>
                          
                        <script type="text/javascript">
                          
                              var labels =  {{ Js::from($labels) }};
                              var users =  {{ Js::from($data) }};
                          
                              const data = {
                                labels: labels,
                                datasets: [{
                                  label: 'My First dataset',
                                  backgroundColor: 'rgb(255, 99, 132)',
                                  borderColor: 'rgb(255, 99, 132)',
                                  data: users,
                                }]
                              };
                          
                              const config = {
                                type: 'line',
                                data: data,
                                options: {}
                              };
                          
                              const myChart = new Chart(
                                document.getElementById('myChart'),
                                config
                              );
                          
                        </script>   
@endsection