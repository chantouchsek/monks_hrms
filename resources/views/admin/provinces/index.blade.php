@extends('admin.layouts.app')

@section('content')
    <b-row>
        <b-col>
            <b-card>
                <h4 class="card-title" slot="header">CSV file import</h4>
                {!! Form::open(array('route' => 'admin.provinces.import','method'=>'POST', 'class'=> 'form', 'role'=> 'form', 'files' => true)) !!}
                <b-form-file required placeholder="No file chosen..." name="import"></b-form-file>
                <b-button type="submit" variant="warning" class="mt-3">
                    Import CSV
                </b-button>
                {!! Form::close() !!}
            </b-card>
        </b-col>
    </b-row>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> {{ __('labels.admin.countries.title') }}
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-bordered">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Country</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($provinces as $index => $province)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $province->country->kh_name }}</td>
                                <td>{{ $province->kh_name }}</td>
                                <td>{{ $province->code }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <b-row>
                        <b-col class="my-1">
                            Showing {{ $provinces->currentPage() }} to {{ $provinces->count() }} of {{ $provinces->total() }} entries
                        </b-col>
                        <b-col>
                            <div class="pull-right">
                                {{ $provinces->links() }}
                            </div>
                        </b-col>
                    </b-row>
                </div>
            </div>
        </div>
    </div>
@endsection
