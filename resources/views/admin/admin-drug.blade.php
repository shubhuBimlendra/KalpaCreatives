@extends('admin.layout.master')

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
<!-- Add the following code inside your <td> for 'approval_status' -->
<td>
    <form action="{{ route('updateApproval', $drug->id) }}" method="POST">
        @csrf
        <select name="approval_status" class="form-control approval-status-dropdown">
            <option value="Pending" {{ $drug->approval_status === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Approved" {{ $drug->approval_status === 'Approved' ? 'selected' : '' }}>Approved</option>
            <option value="Rejected" {{ $drug->approval_status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
        </select>

        @if ($drug->rejection_note === null)
        <div class="form-group rejection-note-container" style="{{ $drug->approval_status === 'Rejected' ? 'display:block;' : 'display:none;' }}">
            <label for="rejection_note">Rejection Note:</label>
            <textarea name="rejection_note" class="form-control rejection-note-input" rows="3">{{ $drug->rejection_note }}</textarea>
        </div>
        @else
        <!-- Display the rejection note -->
        <button type="button" class="btn btn-link rejection-note-button" data-toggle="modal" data-target="#rejectionModal{{ $drug->id }}">
            View Rejection Note
        </button>
        @endif

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</td>

<!-- Modal for Rejection Note -->
<div class="modal fade" id="rejectionModal{{ $drug->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectionModalLabel">Rejection Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ $drug->rejection_note }}</p>
            </div>
        </div>
    </div>
</div>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get elements
        const approvalStatusDropdown = document.querySelector(".approval-status-dropdown");
        const rejectionNoteContainer = document.querySelector(".rejection-note-container");

        // Initial visibility
        toggleRejectionNoteInput(approvalStatusDropdown.value);

        // Listen for changes in approval status
        approvalStatusDropdown.addEventListener("change", function() {
            toggleRejectionNoteInput(approvalStatusDropdown.value);
        });

        // Function to toggle rejection note input
        function toggleRejectionNoteInput(selectedStatus) {
            if (selectedStatus === "Rejected") {
                rejectionNoteContainer.style.display = "block";
            } else {
                rejectionNoteContainer.style.display = "none";
            }
        }
    });
</script>


</body>
</html>

@endsection
