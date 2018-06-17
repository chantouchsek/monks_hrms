@extends('admin.layouts.app')

@section('content')
    <b-card>
        <div slot="header">
            <strong>Company</strong>
            <small>Form</small>
        </div>
        <b-form-group>
            <label for="company">Company</label>
            <b-form-input type="text" id="company" placeholder="Enter your company name"></b-form-input>
        </b-form-group>
        <b-form-group>
            <label for="vat">VAT</label>
            <b-form-input type="text" id="vat" placeholder="PL1234567890"></b-form-input>
        </b-form-group>
        <b-form-group>
            <label for="street">Street</label>
            <b-form-input type="text" id="street" placeholder="Enter street name"></b-form-input>
        </b-form-group>
        <b-row>
            <b-col sm="8">
                <b-form-group>
                    <label for="city">City</label>
                    <b-form-input type="text" id="city" placeholder="Enter your city"></b-form-input>
                </b-form-group>
            </b-col>
            <b-col sm="4">
                <b-form-group>
                    <label for="postal-code">Postal Code</label>
                    <b-form-input type="text" id="postal-code" placeholder="Postal Code"></b-form-input>
                </b-form-group>
            </b-col>
        </b-row>
        <b-form-group>
            <label for="country">Country</label>
            <b-form-input type="text" id="country" placeholder="Country name"></b-form-input>
        </b-form-group>
    </b-card>
@endsection