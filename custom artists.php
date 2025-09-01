add_shortcode('custom_artist_cards', function () {
    if (!function_exists('dokan')) return 'Dokan plugin not active';

    $vendors = get_users([
        'role__in' => ['vendor', 'seller'],
        'number'   => -1, // fetch all vendors
    ]);

    if (empty($vendors)) return 'No artists found.';

    ob_start(); ?>
    <style>
        .artist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .artist-card {
            background: #131111;
            border: 1px solid #333;
            border-radius: 12px;
            text-align: center;
            padding: 25px 15px 50px;
            color: #F1FFFD;
            transition: all 0.3s ease;
        }

        .artist-card:hover {
            border-color: #00D6B2;
            box-shadow: 0 0 10px #00D6B2;
        }

        .artist-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: none;
            overflow: hidden;
            margin: 0 auto 15px;
            background: #fff;
        }

        .artist-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .artist-name {
            font-size: 18px;
            font-weight: 600;
			padding: 15px;
        }

        @media(max-width: 768px) {
            .artist-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 480px) {
            .artist-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="artist-grid">
        <?php foreach ($vendors as $vendor): 
            $store_url = dokan_get_store_url($vendor->ID);
            $store_info = dokan_get_store_info($vendor->ID);
            $store_name = $store_info['store_name'] ?? $vendor->display_name;
            $avatar_url = get_avatar_url($vendor->ID, ['size' => 150]);
        ?>
            <div class="artist-card">
                <a href="<?php echo esc_url($store_url); ?>" class="artist-avatar">
                    <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($store_name); ?>">
                </a>
                <div class="artist-name"><?php echo esc_html($store_name); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
});
