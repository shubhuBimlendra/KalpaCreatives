@extends('front.layout.master')

@section('content')

<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
    <div class="">
        <h2>Add Drug</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('drugs.index') }}"> Back</a>
    </div>
</div>
</div>
@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif
<form action="{{ route('drugs.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Drug Title:</strong>
<input type="text" name="title" class="form-control" placeholder="Drug Title">
@error('title')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<strong>Description:</strong>
<textarea name="description" class="form-control" placeholder="Drug description" id="" cols="5" rows="5"></textarea>
@error('description')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<strong>Price:</strong>
<input type="text" name="price" class="form-control" placeholder="Price">
@error('price')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<strong>Discount:</strong>
<input type="text" name="discount" class="form-control" placeholder="discount">
@error('discount')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<strong>Quantity:</strong>
<input type="text" name="quantity" class="form-control" placeholder="quantity">
@error('quantity')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
<strong>Drug Image:</strong>
<input type="file" class="input-file" name="image"/>
@error('image')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>

</div>
<button type="submit" class="btn btn-primary ml-3">Submit</button>
</div>
</form>
</div>
</div>

@endsection





