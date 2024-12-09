//whatsapp-order-button

//miladjef

function add_whatsapp_button_to_product_page() {
    global $product;

    // Ensure we're on a single product page
    if (!is_product()) {
        return;
    }

    // Get product data
    $product_url = get_permalink($product->get_id());
    $product_availability = $product->is_in_stock();
    $whatsapp_number = '+*******';

    // Button text and message based on product availability
    if ($product_availability) {
        $button_text = '<i class="fab fa-whatsapp"></i> Order product via WhatsApp';
        $button_style = 'background-color: #25d366; color: #fff;';
        $whatsapp_message = urlencode("Hello, I wanted this product: $product_url");
    } else {
        $button_text = '<i class="fab fa-whatsapp"></i> Make this product available to me';
        $button_style = 'background-color: #f00; color: #fff;';
        $whatsapp_message = urlencode("Hello, product: $product_url is not available, can you make it available for me");
    }

    // Output the button HTML
    echo '<a href="https://wa.me/' . str_replace('+', '', $whatsapp_number) . '?text=' . $whatsapp_message . '" target="_blank" class="button whatsapp-order-button" style="' . $button_style . '">' . $button_text . '</a>';
}

// Add the button to the single product page, always
add_action('woocommerce_single_product_summary', 'add_whatsapp_button_to_product_page', 35);

// Optional: Add styles for the WhatsApp button
function add_whatsapp_button_styles() {
    echo '<style>
        .whatsapp-order-button {
            display: inline-block;
            margin-top: 10px;
            margin-left: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
        }
        .whatsapp-order-button i {
            margin-right: 8px;
            font-size: 18px;
        }
        .whatsapp-order-button:hover {
            opacity: 0.9;
        }
    </style>';
}
add_action('wp_head', 'add_whatsapp_button_styles');

// Enqueue Font Awesome for WhatsApp icon
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
