<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function addReview(Request $request, Order $o){

        $rules = [
            'rating' => 'required',
            'comment' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'status' => 'FINISHED'
        ]);

        DB::table('reviews')->insert(array_merge(
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
                'order_id' =>  $o->id,
                'vendor_id' => $o->vendor_id
            ]
        ));
        $this->calculcateAndSaveNewRating($o);

        return redirect('orderlist')->with('message','Order #'.$o->id.' status edited successfully!');
    }

    public function calculcateAndSaveNewRating(Order $o){
        $vendor = Vendor::where('id',$o->vendor_id)->first();
        $totalRating = Review::where('vendor_id',$o->vendor_id)->sum('rating') + $vendor->rating;
        $totalReview = Review::where('vendor_id',$o->vendor_id)->count() + 1;
        $newRating = round(($totalRating/$totalReview));
        $vendor->rating = $newRating;
        $vendor->save();

    }

    public function finishWithoutReview(Order $o){
        DB::table('orders')->where([
            ['id',$o->id]
            ])->update([
            'status' => 'FINISHED'
        ]);
        return redirect('orderlist')->with('message','Order #'.$o->id.' status edited successfully!');
    }
}
