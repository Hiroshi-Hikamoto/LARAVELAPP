@extends('layouts.app')

@section('template_title')
    Msm Whats App
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Msm Whats App') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('msm-whats-apps.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>From</th>
										<th>Idmsg</th>
										<th>Text</th>
										<th>Tipo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($msmWhatsApps as $msmWhatsApp)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $msmWhatsApp->from }}</td>
											<td>{{ $msmWhatsApp->idMsg }}</td>
											<td>{{ $msmWhatsApp->text }}</td>
											<td>{{ $msmWhatsApp->tipo }}</td>

                                            <td>
                                                <form action="{{ route('msm-whats-apps.destroy',$msmWhatsApp->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('msm-whats-apps.show',$msmWhatsApp->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('msm-whats-apps.edit',$msmWhatsApp->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $msmWhatsApps->links() !!}
            </div>
        </div>
    </div>
@endsection
