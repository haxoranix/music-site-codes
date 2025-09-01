add_filter( 'elementor_pro/posts/query/vendor_loop', function( $query ) {
    // Get vendor users
    $vendors = get_users( [
        'role'    => 'seller',
        'orderby' => 'registered',
        'order'   => 'DESC',
        'fields'  => ['ID'] // Only return user IDs
    ] );

    // If no vendors, stop
    if ( empty( $vendors ) ) {
        $query->set( 'post__in', [0] ); // Prevent empty loop error
        return;
    }

    // Get the latest post by each vendor — you could customize this
    $vendor_posts = get_posts( [
        'post_type'   => 'product', // or 'post', 'any' if needed
        'author__in'  => $vendors,
        'numberposts' => 100, // Get some posts to show in grid
        'fields'      => 'ids'
    ] );

    if ( empty( $vendor_posts ) ) {
        $query->set( 'post__in', [0] ); // Prevent empty loop
        return;
    }

    // Send post IDs to Elementor
    $query->set( 'post_type', 'product' ); // or 'any'
    $query->set( 'post__in', $vendor_posts );
    $query->set( 'orderby', 'post__in' );
}, 10, 1 );
