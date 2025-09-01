add_action('woocommerce_after_shop_loop_item', 'show_artist_name_below_price', 25);

function show_artist_name_below_price() {
    global $product;

    if (function_exists('dokan_get_store_info')) {
        $author_id = get_post_field('post_author', $product->get_id());
        $store_url  = dokan_get_store_url($author_id);
        $store_info = dokan_get_store_info($author_id);
        $store_name = $store_info['store_name'];

        if (!empty($store_name)) {
            echo '<div class="music-artist-name"><a href="' . esc_url($store_url) . '">' . esc_html($store_name) . '</a></div>';
            return;
        }
    }

    // Fallback if not a vendor or store name is empty
    echo '<div class="music-artist-name">Jengu</div>';
}
