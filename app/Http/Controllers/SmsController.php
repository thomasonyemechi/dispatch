<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SmsController extends Controller
{
    function sendNow(Request $request)
    {

        $names = [
            'Jonh', 'Ade', 'Fela', 'Kuti', 'Daniel', 'Doll', 'Phil', 'Den', 'Jade', 'Smith', 'Fel', 'Davon', 
            'baz', 'Bren', 'Fish', 'Gota', 'Gde', 'dish', 'fat', 'mint', 'pit', 'dash', 'aremo', 'fendi', 'buggati', 
            'tate', 'andrew', 'oseni', 'eniola', 'victor', 'matt', 'tare', 'mac', 'marce', 'mark'
        ];

        $roles = [
            'administrator'
        ];


        $services = "
        Flex Banners Large (7ft x 3ft),
        Flex Banners Medium (5ft x 3ft),
        Roll Up Banners (Big Base),
        Roll Up Banners (Small Base),
        X-Banner,
        Backdrop Banners,
        Teardrop Banners,
        Trifold Brochures,
        A5 Bi-fold Brochures,
        A4 Bi-fold Brochures,
        Two-sided Business Cards,
        A5 Table Calendar (7 Sheets),
        A5 Table Calendar (13 Sheets),
        A3 Wall Calendar (7 Sheets),
        A2 Wall Calendar (13 Sheets),
        A2 Wall Calendar (13 Sheets),
        A2 Wall Calendar (7 Sheets),
        Clothe Tag,
        Magic Mugs,
        Magic Mugs,
        Metalic Keyrings,
        Custom Pens,
        Simple Mugs,
        A5 Flyers (Double Sided),
        A6 Flyers (Single Sided)";

        $services = explode(',', $services);


        $c_name = count($names);
        $c_roles = count($roles);
        $c_services = count($services);

        for($i=0; $i <= 1; $i++)
        {
            $phone = fake()->phoneNumber();
            $name = fake()->name();
            $role = $roles[rand(0, $c_roles-1)];
            $email =  strtolower($name.'_'.$role.'@dispatch.com') ;


            //create customers and orders
            // $num = rand(1,5); $ser = [];
            // for($j=0; $j <= $num; $j++)
            // {
            //     $ser[] = $services[rand(0, $c_services-1)];
            // }

            // $service_name = implode(',', $ser);

            // $creator = User::where(['role' => 'marketer'])->inrandomorder()->first()->id;
            // $customer = Customer::updateOrCreate([
            //     'phone' => $phone
            // ], [
            //     'name' => $name,
            //     'address' => fake()->address(),
            //     'email' => $email,
            //     'created_by' => $creator
            // ]);


            // $total = rand(5000, 200000);
    
            // $order = Order::query()->create([
            //     'customer_id' => $customer->id,
            //     'service_name' => $service_name,
            //     'receiver_address' => fake()->address(),
            //     'receiver_phone' => fake()->phoneNumber(),
            //     'total_price' => $total,
            //     'files' => json_encode([]),
            //     'advance_paid' => rand(0, $total),
            //     'receiving_date' => fake()->date(),
            //     'created_by' => $creator
            // ]);




            //create staffs
            User::create([
                'name' => $name,
                'role' => $role,
                'email' => $email,
                'phone' => $phone,
                'password' => Hash::make($phone),
            ]);
        }



        return 'done' ;

        // return $this->sendSms('Hello this is a test message', '09037577611');
    }
}
