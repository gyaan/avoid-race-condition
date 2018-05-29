<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function buyPhone($userId)
    {

        if (empty($userId))
            return response()->json("specify the user id");

        $user = DB::table('users')->where('id', '=', $userId)->first();

        if (empty($user))
            return response()->json("user not found!");

        //assume that user can buy only one phone
        $soldPhoneDetails = DB::table('phones')->where('user_id', '=', $userId)->first();

        if (!empty($soldPhoneDetails))
            return response()->json("You already bought one phone. you can buy only one phone");

        try {

            //user is there
            DB::beginTransaction();

            //get the unSold Phone details from table and lock it for the specific user
            $unSoledPhone = DB::table('phones')->where('user_id', null)->lockForUpdate()->first();

            \Log::Info("Unsold Phone Details:" . json_encode($unSoledPhone, true));

            //no phone remaining
            if (empty($unSoledPhone))
                return response()->json("All phone sold out.");

            //sleep for to complete payment.
            //here you can do payment confirmation stuff.
            sleep(30);


            //if everything is fine then update the customer id against to that phone
            DB::table('phones')->where('iemi', $unSoledPhone->iemi)->update([
                'selling_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => $user->id,
            ]);
            DB::commit();

            return response()->json("order placed successfully!");
        } catch (\Exception $exception) {
            DB::rollBack(); //rollback the phone selling data
            \Log::error($exception->getMessage());
            return response()->json('order failed!');
        }

    }
}
