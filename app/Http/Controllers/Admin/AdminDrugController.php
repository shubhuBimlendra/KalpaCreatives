<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drug;
use Auth;

class AdminDrugController extends Controller
{
    public function index(){
        $drugs=Drug::orderBy('id','desc')->paginate(5);
        return view('admin.admin-drug',compact('drugs'));
    }

    public function updateApproval(Request $request, $id) {
        $drug = Drug::findOrFail($id);
        $approvalStatus = $request->input('approval_status');

        if ($approvalStatus === 'Rejected') {
            $rejectionNote = $request->input('rejection_note');
            $drug->rejection_note = $rejectionNote;
        }else {
            $drug->rejection_note = null;
        }

        $drug->approval_status = $approvalStatus;
        $drug->updated_by = Auth::user()->name;
        $drug->approval_date = now();
        $drug->expiration_date = now()->addYear();
        $drug->save();

        $message = 'Drug application updated successfully.';
        if ($approvalStatus === 'Rejected') {
            $message = 'Drug application rejected successfully.';
        }
        if ($approvalStatus === 'Approved') {
            $message = 'Drug application approved successfully.';
        }
        return redirect()->back()->with('message', $message);
    }


}
