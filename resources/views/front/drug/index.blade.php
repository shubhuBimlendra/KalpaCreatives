@extends('front.layout.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Drug</title>
<style>
        nav svg {
            height: 20px;
        }
        nav .hidden {
            display: block !important;
        }
        .sclist{
            list-style:none;
        }
        .sclist li{
            line-height: 33px;
            border-bottom: 1px solid #ccc;
        }
        .slink i{
            font-size:17px;
            margin-left: 13px;
        }
    </style>
</head>
<body>
<div class="">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{route('drugs.create')}}"> Create Drug</a>
            </div>
        </div>
@if ($message = Session::get('message'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>ID</th>
<th>Title</th>
<th>Description</th>
<th>Added By</th>
<th>Updated By</th>
<th>Price</th>
<th>Discount</th>
<th>Quantity</th>
<th>Approval Date</th>
<th>Expiration Date</th>
<th>Image</th>
<th>Status</th>
<th>Rejection Note</th>
<th>Action</th>
</tr>
@foreach ($drugs as $drug)
<tr>
<td>{{ $drug->id }}</td>
<td>{{ $drug->title }}</td>
<td>{{ $drug->description }}</td>
<td>{{ $drug->added_by }}</td>
<td>{{ $drug->updated_by }}</td>
<td>{{ $drug->price }}</td>
<td>{{ $drug->discount }}</td>
<td>{{ $drug->qty }}</td>
<td>{{ $drug->approval_date }}</td>
<td>{{ $drug->expiration_date }}</td>
<td><img src="{{asset('images')}}/{{$drug->image}}" style="max-width: 100px; max-height: 100px;"/></td>
<td>{{ $drug->approval_status }}</td>
<td>
    @if ($drug->rejection_note !== null)
        {{ $drug->rejection_note }}
    @else
        NAN
    @endif
</td>

<td>
<form action="{{ route('drugs.destroy',$drug->id) }}" method="Post">
<a class="btn btn-primary" href="{{ route('drugs.edit',$drug->id) }}">Edit</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete</button>
</form>
</td>
</tr>
@endforeach
</table>
{{$drugs->links()}}

</div>
</div>
</body>
</html>

@endsection
