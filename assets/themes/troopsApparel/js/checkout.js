$(document).ready(function() {
    const BITESHIP_TOKEN = 'biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiVGVzdGluZyIsInVzZXJJZCI6IjY4M2M2ZmUxN2YwNGNlMDAxMjk0YjZiMiIsImlhdCI6MTc0ODgyOTg0MX0.857GlvJl5atH049dsjs5kBouNTkh4UEnOJZjWNUgtmQ';
    const ORIGIN_POSTAL_CODE = '53183';
    // Koordinat toko (sesuaikan dengan lokasi toko sebenarnya)
    const STORE_LATITUDE = -7.392587936263608;
    const STORE_LONGITUDE = 109.25007320266478;
    let typingTimer;
    const doneTypingInterval = 500;

    // Get site_url from the global scope if available, otherwise construct it
    const site_url = (typeof siteUrl !== 'undefined') ? siteUrl : window.location.origin + '/troops/index.php/';

    // Courier code mapping
    const COURIER_MAPPING = {
        'JNE': 'jne',
        'J&T': 'jnt',
        'SICEPAT': 'sicepat',
        'ANTERAJA': 'anteraja',
        'POS': 'pos'
    };

    // Load available couriers when page loads
    loadCouriers();

    // Search location when typing
    $('#search_location').on('keyup', function() {
        clearTimeout(typingTimer);
        const query = $(this).val();
        
        if (query.length < 3) {
            $('#location_results').hide();
            return;
        }

        typingTimer = setTimeout(() => searchLocation(query), doneTypingInterval);
    });

    // Load available couriers (STATIC, NO API)
    function loadCouriers() {
        const couriers = [
            { code: 'tiki', name: 'TIKI' },
            { code: 'jnt', name: 'J&T' },
            { code: 'jne', name: 'JNE' },
            { code: 'pos', name: 'POS Indonesia' },
            { code: 'sicepat', name: 'SiCepat' }
        ];
        $('#courier').empty();
        $('#courier').append('<option value="">Pilih Kurir</option>');
        couriers.forEach(courier => {
            $('#courier').append(`<option value="${courier.code}">${courier.name}</option>`);
        });
    }

    // Search location
    function searchLocation(query) {
        // Show loading state
        $('#location_results').empty();
        $('#location_results').append('<div class="list-group-item">Mencari lokasi...</div>');
        $('#location_results').show();

        const params = {
            countries: 'ID',
            input: query,
            type: 'single'
        };

        $.ajax({
            url: 'https://api.biteship.com/v1/maps/areas',
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${BITESHIP_TOKEN}`
            },
            data: params,
            success: function(response) {
                console.log('Location Response:', response);
                $('#location_results').empty();

                if (response && response.success && response.areas && response.areas.length > 0) {
                    response.areas.forEach(area => {
                        if (area) {
                            // Extract location data from API response
                            const province = area.administrative_division_level_1_name || '';
                            const city = area.administrative_division_level_2_name || '';
                            const district = area.administrative_division_level_3_name || '';
                            const urban = area.administrative_division_level_4_name || '';
                            const postalCode = area.postal_code || '';
                            const latitude = area.latitude || '';
                            const longitude = area.longitude || '';

                            $('#location_results').append(`
                                <a href="#" class="list-group-item list-group-item-action location-item" 
                                data-postal-code="${postalCode}"
                                data-province="${province}"
                                data-city="${city}"
                                data-district="${district}"
                                data-urban="${urban}"
                                data-latitude="${latitude}"
                                data-longitude="${longitude}"
                                >
                                    ${province}${city ? ', ' + city : ''}
                                    ${district ? ', ' + district : ''}
                                    ${urban ? ', ' + urban : ''}
                                    ${postalCode ? ' (' + postalCode + ')' : ''}
                                </a>
                            `);
                        }
                    });
                    $('#location_results').show();
                } else {
                    console.log('No locations found for query:', query);
                    $('#location_results').append('<div class="list-group-item">Lokasi tidak ditemukan</div>');
                    $('#location_results').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error searching location:', {
                    status: xhr.status,
                    response: xhr.responseText,
                    error: error
                });
                $('#location_results').empty();
                $('#location_results').append('<div class="list-group-item text-danger">Gagal mencari lokasi. Silakan coba lagi.</div>');
                $('#location_results').show();
            }
        });
    }

    // Handle location selection
    $(document).on('click', '.location-item', function(e) {
        e.preventDefault();
        const item = $(this);

        // Get data with fallback to empty string
        const province = item.data('province') || '';
        const city = item.data('city') || '';
        const district = item.data('district') || '';
        const urban = item.data('urban') || '';
        const postalCode = item.data('postal-code') || '';
        const latitude = item.data('latitude') || '';
        const longitude = item.data('longitude') || '';

        // Set values with null check
        $('#provinsi').val(province);
        $('#kabupaten').val(city);
        $('#kecamatan').val(district);
        $('#desa').val(urban);
        $('#kode_pos').val(postalCode);

        // Store coordinates for shipping calculation
        $('#kode_pos').data('latitude', latitude);
        $('#kode_pos').data('longitude', longitude);

        // Update search field with selected location
        $('#search_location').val(`${province}, ${city}, ${district}, ${urban}`);
        $('#location_results').hide();

        // Trigger shipping cost calculation if courier is selected
        if ($('#courier').val()) {
            calculateShipping();
        }
    });

    // Disable checkout button by default
    $('#checkout-button').prop('disabled', true);

    // Calculate shipping when courier changes
    $('#courier').change(function() {
        if ($(this).val()) {
            calculateShipping();
        } else {
            $('#service').empty().append('<option value="">Pilih Layanan (otomatis termurah)</option>');
            updateShippingCost(0);
            $('#checkout-button').prop('disabled', true);
        }
    });

    // Enable/disable checkout button when service changes
    $('#service').change(function() {
        const serviceSelected = $(this).val() !== '';
        $('#checkout-button').prop('disabled', !serviceSelected);
        
        const selected = $(this).find('option:selected');
        const cost = selected.data('cost') || 0;
        updateShippingCost(cost);
    });

    // Calculate shipping costs
    function calculateShipping() {
        const courier = $('#courier').val();
        const destination = $('#kode_pos').val();
        
        if (!courier || !destination) {
            $('#service').empty().append('<option value="">Pilih Layanan (otomatis termurah)</option>');
            updateShippingCost(0);
            $('#checkout-button').prop('disabled', true);
            return;
        }

        // Show loading state
        $('#service').empty().append('<option value="">Loading...</option>');
        $('#checkout-button').prop('disabled', true);

        // Get product ID from small text
        const idText = $('.product-name small.text-muted').text();
        const productId = idText.replace('ID: ', '').trim();

        if (!productId) {
            console.error('Product ID not found');
            $('#service').empty()
                .append('<option value="">Pilih Layanan (otomatis termurah)</option>')
                .append('<option value="" disabled>Gagal mendapatkan ID produk</option>');
            updateShippingCost(0);
            $('#checkout-button').prop('disabled', true);
            return;
        }

        // Get product details from database
        $.ajax({
            url: site_url.replace(/\/$/, '') + '/shop/cart_api?action=get_products_detail',
            method: 'POST',
            data: {
                product_ids: productId
            },
            success: function(response) {
                try {
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
                    
                    if (!response.data || response.data.length === 0) {
                        throw new Error('No product data received');
                    }

                    const product = response.data[0];
                    const quantity = parseInt($('.quantity input').val()) || 1;
                    
                    const items = [{
                        name: product.name,
                        description: product.description || product.name,
                        value: parseInt($('.price').text().replace(/[^0-9]/g, '')),
                        length: parseInt(product.length) || 20,
                        width: parseInt(product.width) || 20,
                        height: parseInt(product.height) || 10,
                        weight: parseInt(product.weight) || 800,
                        quantity: quantity
                    }];

                    const requestData = {
                        origin_postal_code: ORIGIN_POSTAL_CODE,
                        destination_postal_code: destination,
                        couriers: courier.toLowerCase(),
                        items: items
                    };

                    console.log('Request Data:', requestData); // Debug log

                    // Call shipping API
                    $.ajax({
                        url: 'https://api.biteship.com/v1/rates/couriers',
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${BITESHIP_TOKEN}`,
                            'Content-Type': 'application/json'
                        },
                        data: JSON.stringify(requestData),
                        success: function(response) {
                            $('#service').empty().append('<option value="">Pilih Layanan (otomatis termurah)</option>');

                            if (response && response.success && response.pricing && response.pricing.length > 0) {
                                // Sort services by price
                                response.pricing.sort((a, b) => a.price - b.price);
                                
                                // Auto select cheapest service
                                response.pricing.forEach((service, index) => {
                                    const option = $(`<option value="${service.courier_service_code}" 
                                        data-cost="${service.price}">
                                        ${service.courier_name} - ${service.courier_service_name}
                                        (Rp ${formatRupiah(service.price)})
                                        ${service.duration ? '(' + service.duration + ')' : ''}
                                    </option>`);
                                    
                                    $('#service').append(option);
                                    
                                    // Select first (cheapest) option
                                    if (index === 0) {
                                        $('#service').val(service.courier_service_code);
                                        updateShippingCost(service.price);
                                        $('#checkout-button').prop('disabled', false);
                                    }
                                });
                            } else {
                                $('#service').append('<option value="" disabled>Layanan tidak tersedia</option>');
                                updateShippingCost(0);
                                $('#checkout-button').prop('disabled', true);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error calculating shipping:', error);
                            $('#service').empty()
                                .append('<option value="">Pilih Layanan (otomatis termurah)</option>')
                                .append('<option value="" disabled>Gagal menghitung ongkir</option>');
                            updateShippingCost(0);
                            $('#checkout-button').prop('disabled', true);
                        }
                    });
                } catch (e) {
                    console.error('Error parsing product data:', e);
                    $('#service').empty()
                        .append('<option value="">Pilih Layanan (otomatis termurah)</option>')
                        .append('<option value="" disabled>Gagal memproses data produk</option>');
                    updateShippingCost(0);
                    $('#checkout-button').prop('disabled', true);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error getting product details:', error);
                $('#service').empty()
                    .append('<option value="">Pilih Layanan (otomatis termurah)</option>')
                    .append('<option value="" disabled>Gagal mengambil data produk</option>');
                updateShippingCost(0);
                $('#checkout-button').prop('disabled', true);
            }
        });
    }

    // Update shipping cost and total
    function updateShippingCost(cost) {
        $('#ongkir').text('Rp ' + formatRupiah(cost));
        $('input[name="shipping_cost"]').val(cost);
        
        const subtotal = parseInt($('#subtotal').data('value')) || 0;
        const total = subtotal + cost;
        
        $('.total-price span:last').text('Rp ' + formatRupiah(total));
    }

    // Format number to Rupiah
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    // Initial check if courier is selected
    if ($('#courier').val()) {
        calculateShipping();
    }
}); 