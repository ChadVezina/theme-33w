<?php

/**
 * Gabarit pour la section filtre dynamique avec accordéon
 * Entièrement alimenté par REST API
 */
?>

<section class="filtres-destinations" id="filtres-destinations">
    <div class="container">
        <div class="filtres-destinations__header">
            <h2 class="filtres-destinations__titre">
                <span class="filtres-destinations__icon">🔍</span>
                Explorer nos Destinations
            </h2>
            <p class="filtres-destinations__description">
                Découvrez nos voyages organisés par catégories et trouvez votre prochaine aventure
            </p>
        </div>

        <!-- Barre de recherche -->
        <div class="filtres-destinations__search">
            <div class="search-bar">
                <input
                    type="text"
                    id="destination-search"
                    class="search-bar__input"
                    placeholder="Rechercher une destination..."
                    aria-label="Rechercher une destination">
                <button class="search-bar__button" type="button" id="search-button">
                    <svg class="search-bar__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Contrôles du filtre -->
        <div class="filtres-destinations__controls">
            <button class="filter-toggle" id="toggle-all-categories">
                <span class="filter-toggle__text">Tout déplier</span>
                <svg class="filter-toggle__icon" width="16" height="16" viewBox="0 0 16 16">
                    <path d="M2 5l6 6 6-6" stroke="currentColor" stroke-width="2" fill="none" />
                </svg>
            </button>

            <div class="filter-stats">
                <span class="filter-stats__text">
                    <span id="destinations-count">0</span> destination(s) trouvée(s)
                </span>
            </div>
        </div>

        <!-- Loading spinner -->
        <div class="filtres-destinations__loading" id="loading-spinner">
            <div class="spinner">
                <div class="spinner__circle"></div>
            </div>
            <p>Chargement des destinations...</p>
        </div>

        <!-- Accordéon des catégories -->
        <div class="filtres-destinations__accordion" id="categories-accordion">
            <!-- Les catégories seront chargées dynamiquement ici -->
        </div>

        <!-- Zone d'affichage des résultats de recherche -->
        <div class="filtres-destinations__results" id="search-results" style="display: none;">
            <div class="search-results">
                <h3 class="search-results__title">Résultats de recherche</h3>
                <button class="search-results__clear" id="clear-search">
                    Effacer la recherche
                </button>
                <div class="search-results__grid" id="search-results-grid">
                    <!-- Les résultats de recherche seront affichés ici -->
                </div>
            </div>
        </div>

        <!-- Message d'erreur -->
        <div class="filtres-destinations__error" id="error-message" style="display: none;">
            <div class="error-message">
                <h3>Oups ! Une erreur s'est produite</h3>
                <p>Impossible de charger les destinations. Veuillez réessayer.</p>
                <button class="btn btn--secondary" id="retry-button">Réessayer</button>
            </div>
        </div>
    </div>
</section>

<!-- Template pour les cartes de destination - Structure identique aux carte-categorie -->
<template id="destination-card-template">
    <article class="destination-card">
        <a href="#" class="destination-card__link">
            <div class="destination-card__image">
                <img src="" alt="" class="destination-card__img">
                <div class="destination-card__overlay"></div>
            </div>
            <div class="destination-card__content">
                <h3 class="destination-card__title"></h3>
                <p class="destination-card__excerpt"></p>
                <div class="destination-card__meta">
                    <span class="destination-card__category"></span>
                </div>
                <div class="destination-card__cta">
                    <span class="destination-card__bouton">
                        Découvrir
                        <svg class="destination-card__arrow" width="16" height="16" viewBox="0 0 16 16">
                            <path d="M8 0l8 8-8 8-1.5-1.5L12 9H0V7h12L6.5 1.5z" />
                        </svg>
                    </span>
                </div>
            </div>
        </a>
    </article>
</template>

<!-- Template pour les items d'accordéon -->
<template id="accordion-item-template">
    <div class="accordion-item">
        <button class="accordion-item__header" type="button">
            <span class="accordion-item__title"></span>
            <span class="accordion-item__count"></span>
            <svg class="accordion-item__icon" width="16" height="16" viewBox="0 0 16 16">
                <path d="M2 5l6 6 6-6" stroke="currentColor" stroke-width="2" fill="none" />
            </svg>
        </button>
        <div class="accordion-item__content">
            <div class="accordion-item__description"></div>
            <div class="accordion-item__destinations">
                <!-- Les destinations de cette catégorie -->
            </div>
        </div>
    </div>
</template>