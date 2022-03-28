<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FitmentQuotation;
use Zxing\QrReader as QrReader;

class FitmentQuotationController extends Controller
{
    
    public function index()
    {
       
    }

    public function quotation_request(Request $request)
    {
 
        if($request->hasFile('licence_qr')){
            $image = $request->file('licence_qr');
            $image_name = $image->getClientOriginalName();
            //Move the image to the images directory in the public folder
            $path = public_path('/images');
            $image->move($path,$image_name);        
            $image_path = $path. "/". $image_name;
            $qr_code = new QrReader($image_path);
            $qr_text = $qr_code->text();
            $text_array =  explode(";",$qr_text);
            
            if(!empty($text_array) && !empty($text_array[0]) && sizeof($text_array) == 7)
                return response()->json([
                    'success' => true,
                    'reference' => uniqid(), 
                    //This is a placeholder for the  fitment cost value. A randonly generated figure for testing
                    'fitment_cost'    => rand(500,999),        
                    'data' => $text_array
                ], 400);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'No valid QR code detected'
                ], 500);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No image uploaded'
            ], 500);
        }
        
        
    }

    public function quotation_response(Request $request)
    {        
     
        $this->validate($request, [
            'reference' =>  ['required'],
            'vin' => 'required',
            'make' => 'required',
            'manufacturer' => 'required',
            'year' => 'required',
            'registration' => 'required',
            'issue_date' => 'required',
            'expires_date' => 'required',
            'fitment_cost' => 'required',
            'fitment_centre_id' => ['required','integer', 'exists:fitment_centres,id'],
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'accepted' => 'required',
        ]);
       //Check if the quotation has already been created first
        $fitment_quotation = FitmentQuotation::where('reference' , request('reference'))->first();

        if($fitment_quotation == null){
            $fitment_quotation = FitmentQuotation::firstOrNew(['reference' =>  request('reference')]);
            $fitment_quotation->vin = $request->vin;
            $fitment_quotation->make = $request->make;
            $fitment_quotation->manufacturer =  $request->manufacturer;
            $fitment_quotation->year =  $request->year;
            $fitment_quotation->registration =  $request->registration;
            $fitment_quotation->issue_date =  date("Y-m-d", strtotime($request->issue_date));
            $fitment_quotation->expires_date =   date("Y-m-d", strtotime($request->expires_date));
            $fitment_quotation->fitment_cost =  $request->fitment_cost;
            $fitment_quotation->fitment_centre_id =  $request->fitment_centre_id;
            $fitment_quotation->first_name = $request->first_name;
            $fitment_quotation->last_name = $request->last_name;
            $fitment_quotation->email = $request->email;
            $fitment_quotation->mobile = $request->mobile;
            $fitment_quotation->accepted = $request->accepted;
    
            if ($fitment_quotation->save())
                return response()->json([
                    'success' => true,
                    'data' => $fitment_quotation->toArray()
                ],201);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Quotation could not be added!'
                ], 500);

        }else{
            return response()->json([
                'success' => false,
                'message' => 'Quotation already created'
            ], 500);
        }
        
    }
}
