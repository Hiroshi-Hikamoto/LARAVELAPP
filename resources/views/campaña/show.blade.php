@extends('layouts.app')

@section('template_title')
    {{ $campaña->name ?? 'Show Campaña' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Campaña</span>
                        </div>
                        <div class="float-right">
                            {{-- <a class="btn btn-primary" href="{{ route('campañas.index') }}"> Back</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Mensaje</th>
                                        <th>status</th>
                                        <th>text</th>
                                        <th>id</th>
                                        <th>contacto</th>
                                        <th>var1</th>
                                        <th>var2</th>
                                        <th>var3</th>
                                        <th>var4</th>
                                        <th>var5</th>
                                        <th>var6</th>
                                        <th>var7</th>
                                        <th>var8</th>
                                        <th>var9</th>
                                        <th>var10</th>
                                        <th>id_usuario</th>
                                        <th>id_campaña</th>
                                        <th>fec_creacion</th>
                                        <th>estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($campaña as $campa)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $campa->Mensaje }}</td>
                                            <td>{{ $campa->status }}</td>
                                            <td>{{ $campa->text }}</td>
                                            <td>{{ $campa->id }}</td>
                                            <td>{{ $campa->contacto }}</td>
                                            <td>{{ $campa->var1 }}</td>
                                            <td>{{ $campa->var2 }}</td>
                                            <td>{{ $campa->var3 }}</td>
                                            <td>{{ $campa->var4 }}</td>
                                            <td>{{ $campa->var5 }}</td>
                                            <td>{{ $campa->var6 }}</td>
                                            <td>{{ $campa->var7 }}</td>
                                            <td>{{ $campa->var8 }}</td>
                                            <td>{{ $campa->var9 }}</td>
                                            <td>{{ $campa->var10 }}</td>
                                            <td>{{ $campa->id_usuario }}</td>
                                            <td>{{ $campa->id_campaña }}</td>
                                            <td>{{ $campa->fec_creacion }}</td>
                                            <td>{{ $campa->estado }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p></p>
                        {!! $campaña->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
