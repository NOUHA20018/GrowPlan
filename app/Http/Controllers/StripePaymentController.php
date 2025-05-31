<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
   
    public function showForm()
    {
        return view('apprenant.payment');
    }
    public function carte($id){
    $cour = Cour::findOrFail($id);
    return view('apprenant.carte', compact('cour'));    }

public function makePayment(Request $request, $courId)
{
    $cour=Cour::find($courId);
    // dd($request);
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $token = $request->stripeToken;
    // dd($token);
    if(!$token) {
        return back()->withErrors('Stripe token is missing.');
    }
    try {
        $charge = Charge::create([
            "amount" => $cour->prix * 100, 
            "currency" => "usd",
            "source" => $token,
            "description" => "Paiement cours ID: $courId"
        ]);

        Paiement::create([
            'montant' => $charge->amount /100,
            'methode_paiement' => 'stripe',
            'statut' => 'payé',
            'user_id' => auth()->id(),
            'cour_id' => $courId,
            'date_paiement' => now(),
            'transaction_id' => $charge->id,
            'devise' => 'USD',
            'payment_response' => json_encode($charge)
        ]);
        $cour = Cour::find($courId);
        $formateur = $cour->user;
        $formateur->total_earnings += $charge->amount /100;
        // dd($formateur,$formateur->total_earnings);
        $formateur->save();

        return redirect()->route('apprenant.cours.show',$courId)->with('success', 'Paiement réussi !');
    } catch (\Exception $e) {
        return redirect()->route('apprenant.cours.show',$courId)->withErrors($e->getMessage());
    }
}


}
