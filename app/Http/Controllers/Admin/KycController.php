<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\Verification\UserKycVerification;
use App\Notifications\Verification\KycVerification;
use Image;
use App\Models\Kyc;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;




class KycController extends Controller
{
    //

    public function picture($image)
    {
        return Image::make(storage_path() . '/app/kyc/' . $image)->response();
    }

    public function index()
    {
        $kycs     = Kyc::all(); 

        return view('admin.kyc.index')
            ->with(compact('kycs', 'kycs'));
    }

    public function verify($id)
    {
        $kyc     = Kyc::where('id', $id);
        $noti = $kyc->first();
        $user = User::find($noti->user_id);

        if($kyc->update(['verified' => 1]) && $user->update(['kyc_verification' => 1])){
            $noti->user->notify(new UserKycVerification());
        }
        return back();
    }

    public function reject($id)
    {
        $kyc     = Kyc::find($id);
        $kyc->verified = 2;
        $kyc->save();
        $noti = $kyc->first();
        $user = User::find($noti->user_id);
        $user->update(['kyc_verification' => 2]);
        $noti->user->notify(new KycVerification());
        return back();
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $kycs     = Kyc::all(); 

            return DataTables::of($kycs)
                ->addColumn('location', function ($data) {
                    return  $data->city . ',' . $data->state . ',' .  $data->country;
                })
                // ->addColumn('front', function ($data) {
                //     return view('admin.kyc.partials.front')
                //         ->with(compact('data'));
                // })
                ->addColumn('front', function ($data) {
                    return  "<button data-toggle='modal' data-target='#front-$data->id' class='btn btn-primary'>View</button>";
                })
                ->addColumn('back', function ($data) {
                    return  "<button data-toggle='modal' data-target='#back-$data->id' class='btn btn-primary'>View</button>";
                })
                ->addColumn('actions', function ($data) {
                    if ($data->verify  == 'Not Verified') {
                      return   "<a href='kyc/verify/$data->id' class='btn btn-primary'>Accept</a>
                        <a href='kyc/reject/$data->id' class='btn btn-primary'>Reject</a>";
                    } else {
                        return "<a href='kyc/verify/ $data->id' class='btn btn-primary disabled'>Accept</a>
                        <a href='kyc/reject/$data->id' class='btn btn-primary disabled'>Reject</a>";
                    }
                })
                ->editColumn('username', function ($data) {
                    return ucfirst($data->username);
                })
                ->editColumn('identity_type', function ($data) {
                    return strtoupper($data->identity_type);
                })
                ->rawColumns(['actions', 'identity_type', 'username', 'location', 'front', 'back'])
                ->make(true);
        } else {
            return abort(404);
        }
    }
}
