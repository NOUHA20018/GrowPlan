<link href="{{ asset('assets/css/apprenantStyle/index.css') }}" rel="stylesheet">       
<link href="{{ asset('assets/css/apprenantStyle/paiment.css') }}" rel="stylesheet">
@extends('layoutsApprenant.apprenantApp')

@section('styles')
<link href="{{ asset('css/apprenantStyle/payment.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="payment-container">
    <div class="payment-card">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="course-summary">
            <h1 class="payment-title">Finalisation de votre inscription</h1>
            <p class="payment-subtitle">Vous êtes sur le point de vous inscrire au cours :</p>
            
            <div class="course-info">
                <div class="course-image">
                    <img src="{{ asset('Cours/'.$cour->id.'/'.$cour->image) }}" alt="{{ $cour->title }}">
                </div>
                <div class="course-details">
                    <h2 class="course-name">{{ $cour->title }}</h2>
                    <div class="instructor">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Formateur : {{ $cour->user->name }}</span>
                    </div>
                    <div class="price-section">
                        <span class="price-label">Total à payer :</span>
                        <span class="price-amount">{{ number_format($cour->prix, 2) }} DH</span>
                    </div>
                </div>
            </div>
        </div>

        
        <form method="POST" action="{{ route('apprenant.paiement.effectuer', $cour->id) }}" class="payment-form">
            @csrf
            
            <h3 class="form-title">Méthode de paiement</h3>
            
            <div class="payment-methods">
                <div class="payment-option">
                    <input type="radio" name="mode" id="paypal" value="paypal" checked>
                    <label for="paypal">
                        <div class="method-logo">
                            <img src="{{ asset('payment/paypal.jpeg') }}" alt="PayPal">
                        </div>
                        <div class="method-info">
                            <span class="method-name">PayPal</span>
                            <span class="method-desc">Paiement sécurisé via PayPal</span>
                        </div>
                    </label>
                </div>
                
                <div class="payment-option">
                    <input type="radio" name="mode" id="stripe" value="stripe">
                    <label for="stripe">
                        <div class="method-logo">
                            <img src="{{ asset('payment/credit-card.jpeg') }}" alt="Carte bancaire">
                        </div>
                        <div class="method-info">
                            <span class="method-name">Carte bancaire</span>
                            <span class="method-desc">Visa, Mastercard, etc.</span>
                        </div>
                    </label>
                </div>
                
                <div class="payment-option">
                    <input type="radio" name="mode" id="espece" value="espece">
                    <label for="espece">
                        <div class="method-logo">
                            <img src="{{ asset('payment/espece.jpeg') }}" alt="espece">
                        </div>
                        <div class="method-info">
                            <span class="method-name">Paiement en espèce</span>
                            <span class="method-desc">Sur place à notre bureau</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="terms-section">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">
                    J'accepte les <a href="#" class="terms-link">conditions générales</a> et la 
                    <a href="#" class="terms-link">politique de confidentialité</a>
                </label>
            </div>

             <div id="card-element">
            <button type="submit" class="submit-btn">
                <i class="fas fa-lock"></i> Payer maintenant
            </button>
            <input type="hidden" name="amount" value="{{ $cour->prix }}">
             </div>
            <p class="security-note">
                <i class="fas fa-shield-alt"></i> Paiement 100% sécurisé - Vos données sont protégées
            </p>
        </form>
    </div>
</div>
@endsection

<script src="https://js.stripe.com/v3/"></script>
<script>
  const stripe = Stripe('pk_test_...'); 
  const elements = stripe.elements();
  const card = elements.create('card');
  card.mount('#card-element');

  const form = document.getElementById('payment-form');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const {token, error} = await stripe.createToken(card);
    if (error) {
      alert(error.message);
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