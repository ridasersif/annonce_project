@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="hero-section py-5">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4">Découvrez le monde avec <span class="text-primary">Voyage Express</span></h1>
                <p class="lead mb-4">Explorez des destinations exceptionnelles et créez des souvenirs inoubliables avec nos offres de voyage personnalisées.</p>
                <div class="d-flex gap-3">
                    @if (!Auth::check())
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-user-plus me-2"></i> Créer un compte
                    </a>
                    @endif
                    
                    <a href="{{ route('offers.index') }}" class="btn btn-outline-primary btn-lg px-4">
                        <i class="fas fa-search me-2"></i> Voir les offres
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <img src="{{ asset('images/image.png') }}" alt="Voya" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="features-section py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Pourquoi nous choisir?</h2>
            <p class="lead text-muted">Nous offrons une expérience de voyage exceptionnelle</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary text-white rounded-circle mx-auto mb-4">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 class="h5 mb-3">Destinations variées</h3>
                        <p class="card-text text-muted">Des centaines de destinations à travers le monde pour tous les goûts et tous les budgets.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary text-white rounded-circle mx-auto mb-4">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h3 class="h5 mb-3">Meilleurs prix</h3>
                        <p class="card-text text-muted">Nous garantissons les tarifs les plus compétitifs pour toutes vos aventures.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon bg-primary text-white rounded-circle mx-auto mb-4">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="h5 mb-3">Support 24/7</h3>
                        <p class="card-text text-muted">Notre équipe est disponible à tout moment pour vous assister durant votre voyage.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cta-section py-5 bg-primary text-white">
    <div class="container py-4 text-center">
        <h2 class="fw-bold mb-4">Prêt à commencer votre prochaine aventure?</h2>
        <p class="lead mb-4">Rejoignez des milliers de voyageurs satisfaits qui ont choisi Voyage Express</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5">
            <i class="fas fa-paper-plane me-2"></i> Commencer maintenant
        </a>
    </div>
</div>

<style>
    .hero-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
    }
    
    .feature-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 70px;
        height: 70px;
        font-size: 30px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .hero-section {
            min-height: auto;
            padding: 3rem 0;
        }
    }
</style>
@endsection