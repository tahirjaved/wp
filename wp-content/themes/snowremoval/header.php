<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow" />
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Weather Ticker -->
<div class="weather-ticker">
    <div class="weather-content" id="weatherContent">
        <span class="weather-item">🌡️ Loading weather...</span>
    </div>
</div>

<!-- Header -->
<header class="header">
    <div class="container">
        <div class="header-content">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo flex items-center gap-3">
                <?php
                if (has_custom_logo()) {
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    if ($logo) {
                        echo '<img src="' . esc_url($logo[0]) . '" alt="' . esc_attr(get_bloginfo('name')) . '" class="h-16 w-auto">';
                    }
                } else {
                    $logo_url = get_template_directory_uri() . '/assets/images/logo.png';
                    if (file_exists(get_template_directory() . '/assets/images/logo.svg')) {
                        $logo_url = get_template_directory_uri() . '/assets/images/logo.svg';
                    }
                    ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>" class="h-16 w-auto">
                    <?php
                }
                $cname = snowremoval_get_option('cname', '');
                ?>
                <div class="flex flex-col logo-text">
                    <?php if (!empty($cname)) : ?>
                        <strong class="text-3xl/8 -mb-0.5"><?php echo esc_html($cname); ?></strong>
                    <?php endif; ?>
                    <span class="text-gray-900">Snow Removal Services</span>
                </div>
            </a>
            <nav class="nav hidden md:flex" id="mainNav">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'nav',
                        'walker' => new SnowRemoval_Walker_Nav_Menu(),
                    ));
                } else {
                    snowremoval_default_menu();
                }
                ?>
            </nav>
            <button class="mobile-menu-btn md:hidden" id="mobileMenuBtn" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay hidden" id="mobileMenuOverlay"></div>
        <!-- Mobile Menu -->
        <nav class="nav-mobile md:hidden hidden" id="mobileNav">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => '',
                    'walker' => new SnowRemoval_Walker_Nav_Menu(),
                ));
            } else {
                snowremoval_default_menu();
            }
            ?>
        </nav>
    </div>
</header>

<?php
// Default menu fallback
function snowremoval_default_menu() {
    // Get current page URL for comparison
    $current_url = trailingslashit((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    
    // Define menu items array
    $menu_items = array(
        array(
            'title' => 'Home',
            'url' => home_url('/'),
            'type' => 'link',
            'is_current' => is_front_page() || is_home(),
        ),
        array(
            'title' => 'Services',
            'url' => '#',
            'type' => 'dropdown',
            'children' => array(
                array(
                    'title' => 'Residential Snow Plowing',
                    'url' => home_url('/residential/'),
                    'slug' => 'residential',
                ),
                array(
                    'title' => 'Commercial Snow Plowing',
                    'url' => home_url('/commercial/'),
                    'slug' => 'commercial',
                ),
                array(
                    'title' => 'Snow Shoveling Services',
                    'url' => home_url('/shoveling-snow/'),
                    'slug' => 'shoveling-snow',
                ),
                array(
                    'title' => 'Professional Salting',
                    'url' => home_url('/ice-management/'),
                    'slug' => 'ice-management',
                ),
                array(
                    'title' => 'Snow Blowing Services',
                    'url' => home_url('/snow-blowing/'),
                    'slug' => 'snow-blowing',
                ),
            ),
        ),
        array(
            'title' => 'Contact',
            'url' => home_url('/contact/'),
            'type' => 'link',
            'is_current' => is_page('contact'),
        ),
    );
    
    // Loop through menu items
    foreach ($menu_items as $item) {
        // Build class string
        $classes = array('nav-link');
        if (!empty($item['is_current']) && $item['is_current']) {
            $classes[] = 'current-menu-item';
        }
        
        if ($item['type'] === 'dropdown') {
            // Check if any child is current (for parent highlighting)
            $has_current_child = false;
            $children_data = array();
            
            // First pass: check all children and collect data
            foreach ($item['children'] as $child) {
                // Check if child is current page
                $is_current = false;
                if (is_page($child['slug'])) {
                    $is_current = true;
                } elseif (get_query_var('pagename') === $child['slug']) {
                    $is_current = true;
                } elseif ($current_url === trailingslashit($child['url'])) {
                    $is_current = true;
                } elseif (strpos($current_url, '/' . $child['slug'] . '/') !== false) {
                    $is_current = true;
                } elseif (is_singular() && get_post_field('post_name') === $child['slug']) {
                    $is_current = true;
                }
                
                if ($is_current) {
                    $has_current_child = true;
                }
                
                $children_data[] = array(
                    'child' => $child,
                    'is_current' => $is_current,
                );
            }
            
            // Add current-menu-item to parent if any child is current
            if ($has_current_child) {
                $classes[] = 'current-menu-item';
            }
            
            $class_string = implode(' ', $classes);
            
            // Output dropdown menu
            echo '<div class="nav-dropdown">';
            echo '<a href="' . esc_url($item['url']) . '" class="' . esc_attr($class_string) . '">' . esc_html($item['title']) . ' <span class="dropdown-arrow">▼</span></a>';
            echo '<div class="dropdown-menu">';
            
            // Second pass: output children with classes
            foreach ($children_data as $child_data) {
                $child = $child_data['child'];
                $is_current = $child_data['is_current'];
                
                $child_classes = array();
                if ($is_current) {
                    $child_classes[] = 'current-menu-item';
                }
                $child_class_string = !empty($child_classes) ? ' class="' . esc_attr(implode(' ', $child_classes)) . '"' : '';
                
                echo '<a href="' . esc_url($child['url']) . '"' . $child_class_string . '>' . esc_html($child['title']) . '</a>';
            }
            
            echo '</div>';
            echo '</div>';
        } else {
            // Output regular link
            $class_string = implode(' ', $classes);
            echo '<a href="' . esc_url($item['url']) . '" class="' . esc_attr($class_string) . '">' . esc_html($item['title']) . '</a>';
        }
    }
}
?>