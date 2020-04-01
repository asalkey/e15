@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Saver app</h1>
        <p>See how much you will save on a sale item</p>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <form method='POST' action="{{route('calculate')}}" novalidate>
            <div class='alert alert-info'>* Required fields</div>
            {{ csrf_field() }}
            @if(count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="alert alert-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="form-group">
                <label>* Item Cost:</label>
                <input type="text" class="form-control" value='{{ old("item_cost")}}' name="item_cost">
            </div>
            <div class="form-group">
                <label>* Sale Precent Off:</label>
                <input type="number" class="form-control" value='{{ old("percent_off")}}'  name="percent_off">
            </div>
            <div class="form-group">
                <label> State Tax?</label>
                <input type="checkbox" name="sales_tax">
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
    <div class="col-6">
        @if(session('savings'))
            You will save: ${{ session('savings') }}
        @endif
        <br/>
        @if(session('totalCost'))
            Total cost: ${{ session('totalCost') }}
        @endif
        <br/>
        @if(session('salesTax'))
            *total cost will be higher with tax included
        @endif
    </div>
</div>
@endsection
