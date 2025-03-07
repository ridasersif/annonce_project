
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        @foreach($offers as $offer)
            <div class="col-md-4 mb-4">
                <div class="card modern-card">
                    <div class="card-img-top position-relative">
                        <div class="gradient-overlay"></div>
                        <span class="price-badge">{{ $offer->price }} MAD</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $offer->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($offer->description, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="capacity-badge"><i class="fas fa-users"></i> {{ $offer->capacity }}</span>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="btn btn-outline-dark btn-details" data-bs-toggle="modal" data-bs-target="#showOfferModal{{ $offer->id }}">
                                <i class="fas fa-eye"></i> Détails
                            </button>
                            @if(Auth::user()->role_id !=3 && Auth::user()->role_id !=1) 
                                 @if(Auth::check()) 
                                <a href="#" class="btn btn-reserve" data-bs-toggle="modal" data-bs-target="#confirmReservationModal{{ $offer->id }}">
                                    <i class="fas fa-calendar-check"></i> Réserver
                                </a>
                                @else
                                    <a href="#" class="btn btn-reserve" data-bs-toggle="modal" data-bs-target="#loginPromptModal">
                                        <i class="fas fa-calendar-check"></i> Réserver
                                    </a>
                                @endif
                            @endif

                           
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal for Showing Offer --}}
            <div class="modal fade" id="showOfferModal{{ $offer->id }}" tabindex="-1" aria-labelledby="showOfferModalLabel{{ $offer->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content modern-modal">
                        <div class="modal-header">
                            <div class="modal-title-wrapper">
                                <h5 class="modal-title" id="showOfferModalLabel{{ $offer->id }}">{{ $offer->title }}</h5>
                                <span class="modal-subtitle">Détails de l'offre</span>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="modal-image-container">
                                        <div class="modal-image-placeholder">
                                            <i class="fas fa-images fa-3x"></i>
                                        </div>
                                        <div class="modal-price">
                                            <span>{{ number_format($offer->price, 2) }} MAD</span>
                                        </div>
                                    </div>
                                  
                                    <div class="modal-highlights mt-4">
                                        <div class="highlight-item">
                                            <i class="fas fa-users"></i>
                                            <div>
                                                <h6>Capacité</h6>
                                                <p>{{ $offer->capacity }} personnes</p>
                                            </div>
                                        </div>

                                        <div class="highlight-item">
                                            <i class="fas fa-calendar"></i>
                                            <div>
                                                <h6>Disponibilité</h6>
                                                <p>{{ $offer->start_date }} - {{ $offer->end_date }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-md-7">
                                    <div class="modal-description">
                                        <h5 class="section-title"><i class="fas fa-info-circle me-2"></i>Description</h5>
                                        <p>{{ $offer->description }}</p>

                                        <h5 class="section-title mt-4"><i class="fas fa-list-check me-2"></i>Caractéristiques</h5>
                                        <ul class="features-list">
                                            <li><i class="fas fa-check"></i> Offre disponible immédiatement</li>
                                            <li><i class="fas fa-check"></i> Annulation gratuite jusqu'à 24h avant</li>
                                            <li><i class="fas fa-check"></i> Service client 7j/7</li>
                                            <li><i class="fas fa-check"></i> Satisfaction garantie</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                           
                            @if(Auth::user()->role_id !=3 && Auth::user()->role_id !=1) 
                                @if(Auth::check()) 
                                    <a href="#" class="btn btn-reserve" data-bs-toggle="modal" data-bs-target="#confirmReservationModal{{ $offer->id }}">
                                        <i class="fas fa-calendar-check"></i>Réserver maintenant
                                    </a>
                                @else
                                    <a href="#" class="btn btn-reserve" data-bs-toggle="modal" data-bs-target="#loginPromptModal">
                                        <i class="fas fa-calendar-check"></i>Réserver maintenant
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal for Showing Offer --}}

            {{-- Modal for confirming reservation --}}
            <div class="modal fade" id="confirmReservationModal{{ $offer->id }}" tabindex="-1" aria-labelledby="confirmReservationModalLabel{{ $offer->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modern-modal">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmReservationModalLabel{{ $offer->id }}">Confirmation de réservation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir réserver cette offre ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                            <a href="#" class="btn btn-reserve-modal">
                                <i class="fas fa-check"></i> Confirmer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal for Confirming Reservation --}}

            {{-- Modal for prompting login --}}
            <div class="modal fade" id="loginPromptModal" tabindex="-1" aria-labelledby="loginPromptModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modern-modal">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginPromptModalLabel">Veuillez vous connecter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Vous devez être connecté pour pouvoir effectuer une réservation.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> Se connecter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal for Login Prompt --}}
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination-container mt-4">
        {{ $offers->links() }}
    </div>
</div>

<style>
    /* Modern Card Styling */
    .modern-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        background: #fff;
        min-height: 320px;
    }
    
    .modern-card:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: linear-gradient(90deg, #6366F1, #8B5CF6);
        z-index: 2;
    }
    
    .modern-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .card-img-top {
        height: 100px;
    }
    
    .gradient-overlay {
        background: linear-gradient(180deg, rgba(99, 102, 241, 0.8) 0%, rgba(139, 92, 246, 0.8) 100%);
        height: 100px;
        opacity: 0.2;
        border-radius: 15px 15px 0 0;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
    }
    
    .card-body {
        padding: 1.5rem;
        position: relative;
        z-index: 1;
    }
    
    .card-title {
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        color: #1F2937;
    }
    
    .price-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #fff;
        color: #6366F1;
        font-weight: bold;
        padding: 8px 15px;
        border-radius: 50px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 10;
    }
    
    .capacity-badge {
        display: inline-block;
        background-color: #F3F4F6;
        color: #4B5563;
        padding: 5px 10px;
        border-radius: 50px;
        font-size: 0.85rem;
    }
    
    .rating {
        color: #FBBF24;
        font-size: 0.9rem;
    }
    
    .card-actions {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 1rem;
    }
    
    .btn-details {
        flex: 1;
        border-radius: 50px;
        padding: 8px 15px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-reserve {
        flex: 1;
        background: linear-gradient(90deg, #6366F1, #8B5CF6);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 8px 15px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-reserve:hover {
        background: linear-gradient(90deg, #4F46E5, #7C3AED);
        color: white;
        transform: translateY(-2px);
    }
    
    /* Pagination Styling */
    .pagination-container {
        display: flex;
        justify-content: center;
    }
    
    .pagination {
        --bs-pagination-color: #6366F1;
        --bs-pagination-hover-color: #4F46E5;
        --bs-pagination-active-bg: #6366F1;
        --bs-pagination-active-border-color: #6366F1;
    }
    
    .page-link {
        border-radius: 50%;
        margin: 0 5px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .page-item.active .page-link {
        background-color: #6366F1;
        border-color: #6366F1;
    }
    
    /* Modal Styling */
    .modern-modal {
        border-radius: 20px;
        overflow: hidden;
        border: none;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    }
    
    .modal-header {
        background: linear-gradient(90deg, rgba(99, 102, 241, 0.05), rgba(139, 92, 246, 0.05));
        border-bottom: 1px solid rgba(99, 102, 241, 0.1);
        padding: 1.5rem;
    }
    
    .modal-title-wrapper {
        display: flex;
        flex-direction: column;
    }
    
    .modal-title {
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 0.25rem;
    }
    
    .modal-subtitle {
        color: #6366F1;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .modal-image-container {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .modal-image-placeholder {
        height: 200px;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #a1a1aa;
    }
    
    .modal-price {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: #6366F1;
        color: white;
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 700;
        box-shadow: 0 4px 8px rgba(99, 102, 241, 0.2);
    }
    
    .modal-highlights {
        background: #f9fafb;
        border-radius: 15px;
        padding: 1.25rem;
    }
    
    .highlight-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    
    .highlight-item:last-child {
        margin-bottom: 0;
    }
    
    .highlight-item i {
        color: #6366F1;
        font-size: 1.25rem;
        margin-right: 1rem;
        margin-top: 0.25rem;
    }
    
    .highlight-item h6 {
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #4B5563;
    }
    
    .highlight-item p {
        margin-bottom: 0;
        color: #6B7280;
    }
    
    .modal-description {
        padding-left: 1rem;
    }
    
    .section-title {
        font-weight: 600;
        color: #1F2937;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        color: #6366F1;
    }
    
    .features-list {
        list-style: none;
        padding-left: 0;
    }
    
    .features-list li {
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
    }
    
    .features-list li i {
        color: #10B981;
        margin-right: 0.75rem;
    }
    
    .modal-footer {
        background: linear-gradient(90deg, rgba(99, 102, 241, 0.05), rgba(139, 92, 246, 0.05));
        border-top: 1px solid rgba(99, 102, 241, 0.1);
        padding: 1.25rem 1.5rem;
    }
    
    .btn-reserve-modal {
        background: linear-gradient(90deg, #6366F1, #8B5CF6);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-reserve-modal:hover {
        background: linear-gradient(90deg, #4F46E5, #7C3AED);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endpush
@endsection
