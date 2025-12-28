    <!-- Footer -->
    <footer class="footer bg-gray-900 text-white py-12 mt-auto">
        <div class="container">
            <div class="footer-content grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="footer-col max-md:flex flex-col items-center">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo flex items-center gap-3 mb-4">
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
                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>" class="w-12">
                            <?php
                        }
                        $cname = snowremoval_get_option('cname', '');
                        ?>
                        <div class="flex flex-col">
                            <?php if (!empty($cname)) : ?>
                                <strong class="text-2xl/8 -mb-0.5 text-white"><?php echo esc_html($cname); ?></strong>
                            <?php endif; ?>
                            <span class="text-gray-300 text-sm">Snow Removal Services</span>
                        </div>
                    </a>
                    <p class="text-gray-400 max-md:text-center">
                        Professional snow removal services for residential and commercial properties.
                    </p>
                </div>
                
                <div class="footer-col md:col-span-2 ">
                    <h4 class="text-xl font-bold mb-4 text-white">Our Services</h4>
                    <ul class="space-y-2 list-none space-y-2 grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-3 gap-1 pl-0">
                        <li><a href="<?php echo esc_url(home_url('/'));?>" class="text-gray-300 hover:text-white transition-colors">Home</a></li>
                        <li><a href="<?php echo esc_url(home_url('/residential/')); ?>" class="text-gray-300 hover:text-white transition-colors">Residential Snow Plowing</a></li>
                        <li><a href="<?php echo esc_url(home_url('/commercial/')); ?>" class="text-gray-300 hover:text-white transition-colors">Commercial Snow Plowing</a></li>
                        <li><a href="<?php echo esc_url(home_url('/shoveling-snow/')); ?>" class="text-gray-300 hover:text-white transition-colors">Snow Shoveling Services</a></li>
                        <li><a href="<?php echo esc_url(home_url('/ice-management/')); ?>" class="text-gray-300 hover:text-white transition-colors">Professional Salting</a></li>
                        <li><a href="<?php echo esc_url(home_url('/snow-blowing/')); ?>" class="text-gray-300 hover:text-white transition-colors">Snow Blowing Services</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    © <?php echo date('Y'); ?> <?php 
                    $cname = snowremoval_get_option('cname', '');
                    if (!empty($cname)) {
                        echo esc_html($cname) . ' ';
                    }
                    ?>Snow Removal Services. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>

