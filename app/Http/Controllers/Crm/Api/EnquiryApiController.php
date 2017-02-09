<?php

namespace App\Http\Controllers\Crm\Api;

use App\Client;
use App\Contact;
use App\Enquiry;
use App\Http\Requests\EnquiryFormRequest;
use App\Mail\EnquiryConfirmation;
use App\Mail\NotifyDuShaunEnquiry;
use App\WebProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EnquiryApiController extends Controller
{
    /**
     * Return index of all Enquiries on database.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $enquiries = Enquiry::all();

        return response()->json([
            'enquiries' => $enquiries
        ], 200);
    }

    /**
     * Get requested Enquiry to display to user.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $enquiry = Enquiry::find($id);

        return response()->json([
            'enquiry' => $enquiry
        ], 200);
    }

    /**
     *
     */
    public function read()
    {
        $enquiry = Enquiry::find(request('id'));
        $enquiry->read = 1;
        $enquiry->save();
    }

    /**
     * Accept and enquiry.
     * Create Client to move onto creating a Job.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function accept()
    {
        $enquiry = Enquiry::find(request('id'));
        $enquiry->accepted = 1;
        $enquiry->converted = 1;
        $enquiry->save();

        $client = $this->makeClient($enquiry);

        return response()->json([
            "client_id" => $client->id
        ], 200);
    }

    /**
     * Reject a select Enquiry.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function reject()
    {
        $enquiry = Enquiry::find(request('id'));

        $enquiry->accepted = 2;
        $enquiry->save();

        return response('Rejected', 200);
    }

    /**
     * Convert Enquiry details into a Client.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function convert()
    {
        $enquiry = Enquiry::find(request('id'));
        $enquiry->converted = 1;
        $enquiry->save();

        $client = $this->makeClient($enquiry);

        return response()->json([
            "client_id" => $client->id
        ], 200);
    }

    /**
     * Submit enquiry to database
     *
     * @param EnquiryFormRequest $request
     */
    public function submitEnquiry(EnquiryFormRequest $request)
    {
        $enquiry = new Enquiry();
        $enquiry->first_name = $request->enquiry['first_name'];
        $enquiry->last_name = $request->enquiry['last_name'];
        $enquiry->company = $request->enquiry['company'];
        $enquiry->company_name = $request->enquiry['company_name'];
        $enquiry->email = $request->enquiry['email'];
        $enquiry->message = $request->enquiry['message'];
        $enquiry->tel_number = $request->enquiry['tel_number'];
        $enquiry->product_id = $request->enquiry['product_id'];

        $enquiry->save();
        $product = WebProduct::find($enquiry->product_id);

        $notification = new NotifyDuShaunEnquiry($enquiry, $product);
        $confirmation = new EnquiryConfirmation($enquiry, $product);
        Mail::to('dushaun.ac@gmail.com')->send($notification);
        Mail::to($enquiry->email)->send($confirmation);
    }

    /**
     * Get a list of web products for the enquiry form
     * TO BE REFACTORED TO ITS OWN CONTROLLER!
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProducts()
    {
        $products = WebProduct::get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'description' => $product->description,
                    'unit_price' => $product->unit_price
                ];
            });

        return response()->json([
            'products' => $products
        ], 200);
    }

    /**
     * Make a Client from provided Enquiry.
     *
     * @param $enquiry
     * @return Client
     */
    private function makeClient($enquiry)
    {
        $client = new Client();

        if (!$enquiry->company) {
            $client->from_enquiry = 1;
            $client->first_name = $enquiry->first_name;
            $client->last_name = $enquiry->last_name;
            $client->email = $enquiry->email;
            $client->tel_number = $enquiry->tel_number;

            $client->save();
            return $client;
        } else {
            $client->save();

            $contact = new Contact();
            $contact->client_id = $client->id;
            $contact->first_name = $enquiry->first_name;
            $contact->last_name = $enquiry->last_name;
            $contact->email = $enquiry->email;
            $contact->tel_number = $enquiry->tel_number;
            $contact->save();

            $client->company = 1;
            $client->company_name = $enquiry->company_name;
            $client->main_contact_id = $contact->id;
            $client->save();
            return $client;
        }
    }
}
