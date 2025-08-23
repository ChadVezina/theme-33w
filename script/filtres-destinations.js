/**
 * Gestionnaire pour la section filtre dynamique avec accordéon
 * Utilise l'API REST pour charger et filtrer les destinations
 */

class DestinationFilter {
    constructor() {
        this.apiBaseUrl = window.wpApiSettings ? window.wpApiSettings.root + "destinations/v1" : "/wp-json/destinations/v1";
        this.nonce = window.wpApiSettings ? window.wpApiSettings.nonce : "";
        this.categories = [];
        this.currentSearch = "";
        this.isAllExpanded = false;

        this.init();
    }

    init() {
        this.bindEvents();
        this.loadCategories();
    }

    bindEvents() {
        // Recherche
        const searchInput = document.getElementById("destination-search");
        const searchButton = document.getElementById("search-button");
        const clearSearch = document.getElementById("clear-search");

        if (searchInput) {
            searchInput.addEventListener("input", this.debounce(this.handleSearch.bind(this), 300));
            searchInput.addEventListener("keypress", (e) => {
                if (e.key === "Enter") {
                    e.preventDefault();
                    this.handleSearch();
                }
            });
        }

        if (searchButton) {
            searchButton.addEventListener("click", this.handleSearch.bind(this));
        }

        if (clearSearch) {
            clearSearch.addEventListener("click", this.clearSearch.bind(this));
        }

        // Toggle global
        const toggleAll = document.getElementById("toggle-all-categories");
        if (toggleAll) {
            toggleAll.addEventListener("click", this.toggleAllCategories.bind(this));
        }

        // Retry button
        const retryButton = document.getElementById("retry-button");
        if (retryButton) {
            retryButton.addEventListener("click", this.loadCategories.bind(this));
        }
    }

    async loadCategories() {
        try {
            this.showLoading();

            const response = await fetch(`${this.apiBaseUrl}/categories`, {
                headers: this.getHeaders(),
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            this.categories = data;

            this.renderAccordion();
            this.updateStats();
            this.hideLoading();
        } catch (error) {
            console.error("Erreur lors du chargement des catégories:", error);
            this.showError();
        }
    }

    renderAccordion() {
        const accordionContainer = document.getElementById("categories-accordion");
        const template = document.getElementById("accordion-item-template");

        if (!accordionContainer || !template) return;

        accordionContainer.innerHTML = "";

        this.categories.forEach((category, index) => {
            const item = template.content.cloneNode(true);

            // Configuration de l'en-tête
            const header = item.querySelector(".accordion-item__header");
            const title = item.querySelector(".accordion-item__title");
            const count = item.querySelector(".accordion-item__count");
            const content = item.querySelector(".accordion-item__content");
            const description = item.querySelector(".accordion-item__description");
            const destinationsContainer = item.querySelector(".accordion-item__destinations");

            title.textContent = category.category_name;
            count.textContent = `${category.destinations.length} destination${category.destinations.length > 1 ? "s" : ""}`;

            if (category.category_description) {
                description.textContent = category.category_description;
            } else {
                description.style.display = "none";
            }

            // ID unique pour l'accordéon
            const itemId = `accordion-item-${category.category_slug}`;
            header.setAttribute("aria-expanded", "false");
            header.setAttribute("aria-controls", itemId);
            content.id = itemId;

            // Rendu des destinations
            this.renderDestinations(destinationsContainer, category.destinations);

            // Event listener pour l'accordéon
            header.addEventListener("click", () => {
                this.toggleAccordionItem(header, content);
            });

            accordionContainer.appendChild(item);
        });
    }

    renderDestinations(container, destinations) {
        const cardTemplate = document.getElementById("destination-card-template");
        if (!cardTemplate) return;

        container.innerHTML = "";

        destinations.forEach((destination) => {
            const card = cardTemplate.content.cloneNode(true);

            const link = card.querySelector(".destination-card__link");
            const img = card.querySelector(".destination-card__img");
            const title = card.querySelector(".destination-card__title");
            const excerpt = card.querySelector(".destination-card__excerpt");
            const category = card.querySelector(".destination-card__category");

            link.href = destination.permalink;
            img.src = destination.featured_image || this.getDefaultImage();
            img.alt = destination.title;
            title.textContent = destination.title;
            excerpt.textContent = destination.excerpt;
            category.textContent = destination.categories.join(", ");

            // Animation au survol
            const cardElement = card.querySelector(".destination-card");
            cardElement.addEventListener("mouseenter", this.animateCardHover);

            container.appendChild(card);
        });
    }

    toggleAccordionItem(header, content) {
        const isExpanded = header.getAttribute("aria-expanded") === "true";
        const icon = header.querySelector(".accordion-item__icon");

        if (isExpanded) {
            // Fermer
            header.setAttribute("aria-expanded", "false");
            content.style.maxHeight = null;
            icon.style.transform = "rotate(0deg)";
            content.classList.remove("accordion-item__content--open");
        } else {
            // Ouvrir
            header.setAttribute("aria-expanded", "true");
            content.style.maxHeight = content.scrollHeight + "px";
            icon.style.transform = "rotate(180deg)";
            content.classList.add("accordion-item__content--open");
        }
    }

    toggleAllCategories() {
        const toggleButton = document.getElementById("toggle-all-categories");
        const toggleText = toggleButton.querySelector(".filter-toggle__text");
        const headers = document.querySelectorAll(".accordion-item__header");

        this.isAllExpanded = !this.isAllExpanded;

        headers.forEach((header) => {
            const content = document.getElementById(header.getAttribute("aria-controls"));
            if (this.isAllExpanded) {
                header.setAttribute("aria-expanded", "true");
                content.style.maxHeight = content.scrollHeight + "px";
                header.querySelector(".accordion-item__icon").style.transform = "rotate(180deg)";
                content.classList.add("accordion-item__content--open");
            } else {
                header.setAttribute("aria-expanded", "false");
                content.style.maxHeight = null;
                header.querySelector(".accordion-item__icon").style.transform = "rotate(0deg)";
                content.classList.remove("accordion-item__content--open");
            }
        });

        toggleText.textContent = this.isAllExpanded ? "Tout replier" : "Tout déplier";
    }

    async handleSearch() {
        const searchInput = document.getElementById("destination-search");
        const searchTerm = searchInput.value.trim();

        if (searchTerm === this.currentSearch) return;

        this.currentSearch = searchTerm;

        if (searchTerm === "") {
            this.clearSearch();
            return;
        }

        try {
            this.showLoading();

            const response = await fetch(`${this.apiBaseUrl}/filter?search=${encodeURIComponent(searchTerm)}`, {
                headers: this.getHeaders(),
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            this.showSearchResults(data.destinations, searchTerm);
            this.hideLoading();
        } catch (error) {
            console.error("Erreur lors de la recherche:", error);
            this.showError();
        }
    }

    showSearchResults(destinations, searchTerm) {
        const accordion = document.getElementById("categories-accordion");
        const searchResults = document.getElementById("search-results");
        const resultsGrid = document.getElementById("search-results-grid");
        const resultsTitle = searchResults.querySelector(".search-results__title");
        const filterControls = document.querySelector(".filtres-destinations__controls");

        // Masquer l'accordéon et les contrôles de filtres
        accordion.style.display = "none";
        if (filterControls) {
            filterControls.style.display = "none";
        }
        
        // Afficher uniquement les résultats de recherche
        searchResults.style.display = "block";

        resultsTitle.textContent = `Résultats pour "${searchTerm}" (${destinations.length})`;

        // Appliquer une classe spéciale pour un seul résultat
        if (destinations.length === 1) {
            resultsGrid.classList.add("search-results__grid--single-result");
        } else {
            resultsGrid.classList.remove("search-results__grid--single-result");
        }

        this.renderDestinations(resultsGrid, destinations);
    }

    clearSearch() {
        const searchInput = document.getElementById("destination-search");
        const accordion = document.getElementById("categories-accordion");
        const searchResults = document.getElementById("search-results");
        const filterControls = document.querySelector(".filtres-destinations__controls");

        searchInput.value = "";
        this.currentSearch = "";

        // Restaurer l'affichage de l'accordéon et des contrôles
        accordion.style.display = "block";
        if (filterControls) {
            filterControls.style.display = "flex";
        }
        
        // Masquer les résultats de recherche
        searchResults.style.display = "none";

        this.updateStats();
    }

    updateStats() {
        const countElement = document.getElementById("destinations-count");
        if (countElement) {
            const totalDestinations = this.categories.reduce((total, cat) => total + cat.destinations.length, 0);
            countElement.textContent = totalDestinations;
        }
    }

    showLoading() {
        const loading = document.getElementById("loading-spinner");
        if (loading) loading.style.display = "block";

        const accordion = document.getElementById("categories-accordion");
        if (accordion) accordion.style.display = "none";

        const error = document.getElementById("error-message");
        if (error) error.style.display = "none";
    }

    hideLoading() {
        const loading = document.getElementById("loading-spinner");
        if (loading) loading.style.display = "none";

        // Seulement afficher l'accordéon et les contrôles si on n'est pas en mode recherche
        if (this.currentSearch === "") {
            const accordion = document.getElementById("categories-accordion");
            const filterControls = document.querySelector(".filtres-destinations__controls");
            
            if (accordion) accordion.style.display = "block";
            if (filterControls) filterControls.style.display = "flex";
        }
    }

    showError() {
        const loading = document.getElementById("loading-spinner");
        if (loading) loading.style.display = "none";

        const error = document.getElementById("error-message");
        if (error) error.style.display = "block";

        const accordion = document.getElementById("categories-accordion");
        if (accordion) accordion.style.display = "none";
    }

    getHeaders() {
        const headers = {
            "Content-Type": "application/json",
        };

        if (this.nonce) {
            headers["X-WP-Nonce"] = this.nonce;
        }

        return headers;
    }

    getDefaultImage() {
        return "/wp-content/themes/33w-ete-25/images/destination1.jpg";
    }

    animateCardHover(event) {
        const card = event.currentTarget;
        card.style.transform = "translateY(-5px)";
        card.style.transition = "transform 0.3s ease";
    }

    // Utilitaire debounce
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

// Initialisation quand le DOM est prêt
document.addEventListener("DOMContentLoaded", () => {
    const filterSection = document.getElementById("filtres-destinations");
    if (filterSection) {
        new DestinationFilter();
    }
});

// Accessibilité : gestion du clavier pour l'accordéon
document.addEventListener("keydown", (e) => {
    if (e.target.classList.contains("accordion-item__header")) {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            e.target.click();
        }
    }
});
