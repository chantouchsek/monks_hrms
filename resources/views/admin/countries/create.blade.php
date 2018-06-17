@extends('admin.layouts.app')

@section('content')
    <b-card>
        <div slot="header">
            <strong>Country</strong>
            <small>Form</small>
        </div>
        {!! Form::open(array('route' => 'admin.countries.store','method'=>'POST', 'class'=> 'form', 'role'=> 'form', 'files' => true)) !!}
        <b-form-group>
            <label for="name">Name</label>
            <b-form-input type="text" id="name" placeholder="Enter your country name" name="name"></b-form-input>
        </b-form-group>
        <b-form-group>
            <label for="kh_name">Name</label>
            <b-form-input type="text" id="kh_name" placeholder="Enter your country kh name" name="kh_name"></b-form-input>
        </b-form-group>
        <b-form-group>
            <label for="code">Code</label>
            <b-form-input type="text" id="code" placeholder="Enter country code" name="code"></b-form-input>
        </b-form-group>
        <b-form-group>
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
        </b-form-group>
        <div slot="footer">
            <b-button type="submit" size="sm" variant="primary"><i class="fa fa-dot-circle-o"></i> Submit</b-button>
            <b-button type="reset" size="sm" variant="danger"><i class="fa fa-ban"></i> Reset</b-button>
        </div>
        {!! Form::close() !!}
    </b-card>
@endsection