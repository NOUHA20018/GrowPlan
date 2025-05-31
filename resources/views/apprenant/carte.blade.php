@extends('layoutsApprenant.apprenantApp')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/apprenantStyle/carte.css') }}">

@endsection

@section('content')
<div class="payment-container">
    <div class="payment-header">
        <h1>Paiement sécurisé</h1>
        <p>Remplissez les informations de votre carte pour finaliser votre achat</p>
    </div>

    <div class="course-info">
        <span class="course-title">{{ $cour->title }}</span>
        <span class="course-price">{{ number_format($cour->prix, 2) }} DH</span>
    </div>

    <form id="payment-form" method="POST" action="{{ route('apprenant.paiement.effectuer', $cour->id) }}">
        @csrf
        <div id="card-element">
        </div>
        <div id="card-errors" role="alert"></div>

        <input type="hidden" name="amount" value="{{ $cour->prix }}">
        <input type="hidden" name="mode" value="stripe">

        <button type="submit" class="btn-pay">
            Payer maintenant
        </button>
    </form>

    <div class="secure-payment">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
        </svg>
        Paiement 100% sécurisé avec Stripe
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('pk_test_51RRgnpCFpRKWQ9MgOdiDaGl9bCLYL8TQ857Um0yMhAf6l9eLeFqiFjH0VXKi9vj9PtNdzPImj5NSaGJc03A76bzb00fcSAc317'); 
    
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        style: {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        }
    });

    cardElement.mount('#card-element');
    cardElement.on('change', function(event) {
        const displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.textContent = 'Traitement en cours...';

        const { token, error } = await stripe.createToken(cardElement);

        if (error) {

            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
            submitButton.disabled = false;
            submitButton.textContent = 'Payer maintenant';
        } else {
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
</script>
@endsection