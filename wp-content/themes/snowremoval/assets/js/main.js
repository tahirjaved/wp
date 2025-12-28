// Snow Removal Services - Main JavaScript

// ========================================
// Mobile Menu Toggle
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileNav = document.getElementById('mobileNav');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    
    function closeMobileMenu() {
        if (mobileNav && mobileMenuOverlay) {
            mobileNav.classList.remove('active');
            mobileNav.classList.add('hidden');
            mobileMenuOverlay.classList.remove('active');
            mobileMenuOverlay.classList.add('hidden');
            document.body.style.overflow = '';
            
            // Reset hamburger icon
            if (mobileMenuBtn) {
                const spans = mobileMenuBtn.querySelectorAll('span');
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
            
            // Close all dropdowns
            if (mobileNav) {
                mobileNav.querySelectorAll('.nav-dropdown').forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        }
    }
    
    function openMobileMenu() {
        if (mobileNav && mobileMenuOverlay) {
            mobileNav.classList.remove('hidden');
            mobileNav.classList.add('active');
            mobileMenuOverlay.classList.remove('hidden');
            mobileMenuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Animate hamburger icon to X
            if (mobileMenuBtn) {
                const spans = mobileMenuBtn.querySelectorAll('span');
                spans[0].style.transform = 'rotate(45deg) translate(6px, 6px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(7px, -7px)';
            }
            
            // Auto-expand dropdowns that contain current menu items
            const dropdowns = mobileNav.querySelectorAll('.nav-dropdown');
            dropdowns.forEach(dropdown => {
                // Check if dropdown has current item in children
                const currentItem = dropdown.querySelector('.dropdown-menu a.current-menu-item');
                // Also check if parent link itself has current-menu-item (when child is current)
                const parentLink = dropdown.querySelector('.nav-link');
                const hasCurrentParent = parentLink && parentLink.classList.contains('current-menu-item');
                
                if (currentItem || hasCurrentParent) {
                    dropdown.classList.add('active');
                }
            });
        }
    }
    
    if (mobileMenuBtn && mobileNav && mobileMenuOverlay) {
        // Toggle mobile menu
        mobileMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            if (mobileNav.classList.contains('active')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
        
        // Close menu when clicking overlay
        mobileMenuOverlay.addEventListener('click', function() {
            closeMobileMenu();
        });
        
        // Handle dropdown toggles in mobile menu
        const dropdownToggles = mobileNav.querySelectorAll('.nav-dropdown > .nav-link');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const dropdown = this.closest('.nav-dropdown');
                if (dropdown) {
                    dropdown.classList.toggle('active');
                }
            });
        });
        
        // Close menu when clicking on regular links
        const regularLinks = mobileNav.querySelectorAll('.nav-link:not(.nav-dropdown > .nav-link)');
        regularLinks.forEach(link => {
            link.addEventListener('click', function() {
                closeMobileMenu();
            });
        });
        
        // Close menu when clicking on dropdown menu items
        const dropdownItems = mobileNav.querySelectorAll('.dropdown-menu a');
        dropdownItems.forEach(link => {
            link.addEventListener('click', function() {
                closeMobileMenu();
            });
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
                closeMobileMenu();
            }
        });
        
        // Close menu when window is resized to desktop size
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth >= 768 && mobileNav.classList.contains('active')) {
                    closeMobileMenu();
                }
            }, 250);
        });
    }
});

// ========================================
// Weather API Integration
// ========================================
async function fetchWeather() {
    try {
        // Get location from WordPress customizer settings
        const latitude = snowremovalData?.weatherLat || '42.3601';
        const longitude = snowremovalData?.weatherLng || '-71.0589';
        const locationName = snowremovalData?.weatherLocation || 'Boston';
        
        // Open-Meteo API (free, no API key needed)
        const url = `https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current=temperature_2m,weathercode,windspeed_10m&temperature_unit=fahrenheit&windspeed_unit=mph&timezone=America/New_York`;
        
        const response = await fetch(url);
        const data = await response.json();
        
        const temp = Math.round(data.current.temperature_2m);
        const windSpeed = Math.round(data.current.windspeed_10m);
        const weatherCode = data.current.weathercode;
        
        // Weather code interpretation
        const weatherConditions = {
            0: '☀️ Clear',
            1: '🌤️ Mostly Clear',
            2: '⛅ Partly Cloudy',
            3: '☁️ Overcast',
            45: '🌫️ Foggy',
            48: '🌫️ Foggy',
            51: '🌧️ Light Drizzle',
            53: '🌧️ Drizzle',
            55: '🌧️ Heavy Drizzle',
            61: '🌧️ Light Rain',
            63: '🌧️ Rain',
            65: '🌧️ Heavy Rain',
            71: '🌨️ Light Snow',
            73: '🌨️ Snow',
            75: '❄️ Heavy Snow',
            76: '🌨️ Snow Grains',
            77: '🌨️ Snow Grains',
            80: '🌧️ Rain Showers',
            81: '🌧️ Rain Showers',
            82: '🌧️ Heavy Rain Showers',
            85: '🌨️ Snow Showers',
            86: '❄️ Heavy Snow Showers',
            95: '⛈️ Thunderstorm',
            96: '⛈️ Thunderstorm with Hail',
            99: '⛈️ Severe Thunderstorm'
        };
        
        const condition = weatherConditions[weatherCode] || '🌡️ Weather Update';
        const phone = snowremovalData?.phone || '';
        
        // Update ticker with multiple items for continuous scroll
        const weatherContent = document.getElementById('weatherContent');
        if (weatherContent) {
            const weatherInfo = `🌡️ ${locationName} Weather: ${temp}°F | ${condition} | 💨 Wind: ${windSpeed} mph | Updated: ${new Date().toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' })}`;
            
            // Duplicate content for seamless scrolling
            weatherContent.innerHTML = `
                <span class="weather-item px-10 inline-block">${weatherInfo}</span>
                <span class="weather-item px-10 inline-block">${weatherInfo}</span>
                <span class="weather-item px-10 inline-block">${weatherInfo}</span>
                <span class="weather-item px-10 inline-block">${weatherInfo}</span>
            `;
        }
    } catch (error) {
        console.error('Error fetching weather:', error);
        const weatherContent = document.getElementById('weatherContent');
        if (weatherContent) {
            const locationName = snowremovalData?.weatherLocation || 'Boston';
            const phone = snowremovalData?.phone || '';
            const defaultInfo = `🌡️ ${locationName} Snow Removal Services | 24/7 Emergency Service | ${phone}`;
            weatherContent.innerHTML = `
                <span class="weather-item px-10 inline-block">${defaultInfo}</span>
                <span class="weather-item px-10 inline-block">${defaultInfo}</span>
                <span class="weather-item px-10 inline-block">${defaultInfo}</span>
                <span class="weather-item px-10 inline-block">${defaultInfo}</span>
            `;
        }
    }
}

// Fetch weather on page load
if (document.getElementById('weatherContent')) {
    fetchWeather();
    // Update weather every 10 minutes
    setInterval(fetchWeather, 10 * 60 * 1000);
}

// ========================================
// Contact Form Handling
// ========================================
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = {
            firstName: document.getElementById('firstName')?.value || '',
            lastName: document.getElementById('lastName')?.value || '',
            email: document.getElementById('email')?.value || '',
            phone: document.getElementById('phone')?.value || '',
            propertyType: document.getElementById('propertyType')?.value || '',
            serviceType: document.getElementById('serviceType')?.value || '',
            address: document.getElementById('address')?.value || '',
            message: document.getElementById('message')?.value || ''
        };
        
        // Basic validation
        if (!formData.firstName || !formData.lastName || !formData.email || !formData.phone) {
            alert('Please fill in all required fields.');
            return;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(formData.email)) {
            alert('Please enter a valid email address.');
            return;
        }
        
        // Phone validation (basic)
        const phoneRegex = /^[\d\s\-\(\)]+$/;
        if (!phoneRegex.test(formData.phone)) {
            alert('Please enter a valid phone number.');
            return;
        }
        
        // Submit via AJAX if available
        if (typeof snowremovalData !== 'undefined' && snowremovalData.ajaxUrl) {
            // You can implement AJAX form submission here
            console.log('Form submitted:', formData);
        }
        
        // Show success message
        alert('Thank you for your inquiry! We will contact you within 24 hours.');
        
        // Reset form
        contactForm.reset();
    });
}

// ========================================
// Smooth Scrolling for Anchor Links
// ========================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && href.length > 1) {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    });
});

// ========================================
// Scroll Animations
// ========================================
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe service cards, trust cards, etc.
document.querySelectorAll('.service-card, .trust-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(card);
});

