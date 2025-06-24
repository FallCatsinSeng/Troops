<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-06-14 23:39:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:39:10 --> Config Class Initialized
INFO - 2025-06-14 23:39:10 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:39:10 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:39:10 --> Utf8 Class Initialized
INFO - 2025-06-14 23:39:10 --> URI Class Initialized
INFO - 2025-06-14 23:39:10 --> Router Class Initialized
INFO - 2025-06-14 23:39:10 --> Output Class Initialized
INFO - 2025-06-14 23:39:10 --> Security Class Initialized
DEBUG - 2025-06-14 23:39:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:39:10 --> Input Class Initialized
INFO - 2025-06-14 23:39:10 --> Language Class Initialized
INFO - 2025-06-14 23:39:10 --> Language Class Initialized
INFO - 2025-06-14 23:39:10 --> Config Class Initialized
INFO - 2025-06-14 23:39:10 --> Loader Class Initialized
DEBUG - 2025-06-14 23:39:10 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:39:10 --> Helper loaded: url_helper
INFO - 2025-06-14 23:39:10 --> Helper loaded: global_helper
INFO - 2025-06-14 23:39:10 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:39:10 --> Helper loaded: session_helper
INFO - 2025-06-14 23:39:10 --> Database Driver Class Initialized
INFO - 2025-06-14 23:39:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:39:10 --> Controller Class Initialized
DEBUG - 2025-06-14 23:39:10 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:39:10 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:39:10 --> Encryption Class Initialized
INFO - 2025-06-14 23:39:10 --> Helper loaded: cookie_helper
DEBUG - 2025-06-14 23:39:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Order_model.php
INFO - 2025-06-14 23:39:10 --> Language file loaded: language/english/pagination_lang.php
INFO - 2025-06-14 23:39:10 --> Pagination Class Initialized
DEBUG - 2025-06-14 23:39:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/header.php
DEBUG - 2025-06-14 23:39:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/orders/orders.php
DEBUG - 2025-06-14 23:39:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/footer.php
INFO - 2025-06-14 23:39:10 --> Final output sent to browser
DEBUG - 2025-06-14 23:39:10 --> Total execution time: 0.1296
ERROR - 2025-06-14 23:39:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:39:10 --> Config Class Initialized
INFO - 2025-06-14 23:39:10 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:39:10 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:39:10 --> Utf8 Class Initialized
INFO - 2025-06-14 23:39:10 --> URI Class Initialized
INFO - 2025-06-14 23:39:10 --> Router Class Initialized
INFO - 2025-06-14 23:39:10 --> Output Class Initialized
INFO - 2025-06-14 23:39:10 --> Security Class Initialized
DEBUG - 2025-06-14 23:39:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:39:10 --> Input Class Initialized
INFO - 2025-06-14 23:39:10 --> Language Class Initialized
INFO - 2025-06-14 23:39:10 --> Language Class Initialized
INFO - 2025-06-14 23:39:10 --> Config Class Initialized
INFO - 2025-06-14 23:39:10 --> Loader Class Initialized
DEBUG - 2025-06-14 23:39:10 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:39:10 --> Helper loaded: url_helper
INFO - 2025-06-14 23:39:10 --> Helper loaded: global_helper
INFO - 2025-06-14 23:39:10 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:39:10 --> Helper loaded: session_helper
INFO - 2025-06-14 23:39:10 --> Database Driver Class Initialized
INFO - 2025-06-14 23:39:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:39:10 --> Controller Class Initialized
DEBUG - 2025-06-14 23:39:10 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:39:10 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:39:10 --> Encryption Class Initialized
INFO - 2025-06-14 23:39:10 --> Helper loaded: cookie_helper
INFO - 2025-06-14 23:39:10 --> Model "Order_model" initialized
INFO - 2025-06-14 23:39:10 --> Starting order status update cron job at 2025-06-14 23:39:10
DEBUG - 2025-06-14 23:39:10 --> Finding orders for tracking update
DEBUG - 2025-06-14 23:39:10 --> SQL Query: SELECT `id`, `order_number`, `order_status`, `tracking_number`, `courier`
FROM `orders`
WHERE tracking_number IS NOT NULL
AND courier IS NOT NULL
AND `order_status` IN(2, 3)
DEBUG - 2025-06-14 23:39:10 --> Found 4 orders to check
INFO - 2025-06-14 23:39:10 --> Checking order #EUA2522512815 (Resi: 200961465942, Kurir: jnt)
ERROR - 2025-06-14 23:39:16 --> HTTP Error 400 for jnt - 200961465942: {"success":false,"error":"Failed to get tracking information. It's either invalid or expired. Please check again","code":40003001}
ERROR - 2025-06-14 23:39:16 --> Failed to get tracking info - API call failed
INFO - 2025-06-14 23:39:16 --> Checking order #HUK14625125945 (Resi: 11002024002271, Kurir: anteraja)
ERROR - 2025-06-14 23:39:19 --> Query error: Unknown column 'last_tracking_update' in 'field list' - Invalid query: UPDATE `orders` SET `last_tracking_update` = '2025-06-14 23:39:19', `tracking_status` = 'delivered', `tracking_history` = '[{\"note\":\"Pickup sudah di-request oleh shipper, dan SATRIA akan pickup paket Kamis 12 Juni 2025.\",\"updated_at\":\"2025-06-12T13:44:09+07:00\",\"status\":\"picking_up\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera di-pickup.\",\"updated_at\":\"2025-06-12T14:30:11+07:00\",\"status\":\"picking_up\"},{\"note\":\"Paket sudah di-pickup oleh SATRIA.\",\"updated_at\":\"2025-06-12T15:51:34+07:00\",\"status\":\"picked\"},{\"note\":\"Paket sedang diproses di Hub Jakarta Timur\",\"updated_at\":\"2025-06-12T23:34:38+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T05:03:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Tegal (proses transit).\",\"updated_at\":\"2025-06-13T13:30:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T14:53:24+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Banyumas (proses transit).\",\"updated_at\":\"2025-06-13T18:59:58+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket sedang diproses di Hub Banyumas\",\"updated_at\":\"2025-06-13T20:36:45+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Staging.\",\"updated_at\":\"2025-06-14T02:20:40+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket sudah tiba di SS Kab. Purbalingga - Majingklak untuk proses delivery.\",\"updated_at\":\"2025-06-14T07:50:46+07:00\",\"status\":\"dropping_off\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera diantar ke penerima.\",\"updated_at\":\"2025-06-14T08:16:36+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Delivery sukses oleh SATRIA dan paket telah diterima oleh melly(Penerima asli). Terima kasih sudah menggunakan jasa AnterAja #PastiBawaHepi.\",\"updated_at\":\"2025-06-14T12:59:56+07:00\",\"status\":\"delivered\"}]', `order_status` = 4
WHERE `id` = '50'
INFO - 2025-06-14 23:39:19 --> Language file loaded: language/english/db_lang.php
ERROR - 2025-06-14 23:39:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:39:19 --> Config Class Initialized
INFO - 2025-06-14 23:39:19 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:39:19 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:39:19 --> Utf8 Class Initialized
INFO - 2025-06-14 23:39:19 --> URI Class Initialized
INFO - 2025-06-14 23:39:19 --> Router Class Initialized
INFO - 2025-06-14 23:39:19 --> Output Class Initialized
INFO - 2025-06-14 23:39:19 --> Security Class Initialized
DEBUG - 2025-06-14 23:39:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:39:19 --> Input Class Initialized
INFO - 2025-06-14 23:39:19 --> Language Class Initialized
INFO - 2025-06-14 23:39:19 --> Language Class Initialized
INFO - 2025-06-14 23:39:19 --> Config Class Initialized
INFO - 2025-06-14 23:39:19 --> Loader Class Initialized
DEBUG - 2025-06-14 23:39:19 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:39:19 --> Helper loaded: url_helper
INFO - 2025-06-14 23:39:19 --> Helper loaded: global_helper
INFO - 2025-06-14 23:39:19 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:39:19 --> Helper loaded: session_helper
INFO - 2025-06-14 23:39:19 --> Database Driver Class Initialized
INFO - 2025-06-14 23:39:19 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:39:19 --> Controller Class Initialized
DEBUG - 2025-06-14 23:39:19 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:39:19 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:39:19 --> Encryption Class Initialized
INFO - 2025-06-14 23:39:19 --> Helper loaded: cookie_helper
INFO - 2025-06-14 23:39:19 --> Model "Order_model" initialized
INFO - 2025-06-14 23:39:19 --> Starting order status update cron job at 2025-06-14 23:39:19
DEBUG - 2025-06-14 23:39:19 --> Finding orders for tracking update
DEBUG - 2025-06-14 23:39:19 --> SQL Query: SELECT `id`, `order_number`, `order_status`, `tracking_number`, `courier`
FROM `orders`
WHERE tracking_number IS NOT NULL
AND courier IS NOT NULL
AND `order_status` IN(2, 3)
DEBUG - 2025-06-14 23:39:19 --> Found 4 orders to check
INFO - 2025-06-14 23:39:19 --> Checking order #EUA2522512815 (Resi: 200961465942, Kurir: jnt)
ERROR - 2025-06-14 23:39:23 --> HTTP Error 400 for jnt - 200961465942: {"success":false,"error":"Failed to get tracking information. It's either invalid or expired. Please check again","code":40003001}
ERROR - 2025-06-14 23:39:23 --> Failed to get tracking info - API call failed
INFO - 2025-06-14 23:39:23 --> Checking order #HUK14625125945 (Resi: 11002024002271, Kurir: anteraja)
ERROR - 2025-06-14 23:39:29 --> Query error: Unknown column 'last_tracking_update' in 'field list' - Invalid query: UPDATE `orders` SET `last_tracking_update` = '2025-06-14 23:39:29', `tracking_status` = 'delivered', `tracking_history` = '[{\"note\":\"Pickup sudah di-request oleh shipper, dan SATRIA akan pickup paket Kamis 12 Juni 2025.\",\"updated_at\":\"2025-06-12T13:44:09+07:00\",\"status\":\"picking_up\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera di-pickup.\",\"updated_at\":\"2025-06-12T14:30:11+07:00\",\"status\":\"picking_up\"},{\"note\":\"Paket sudah di-pickup oleh SATRIA.\",\"updated_at\":\"2025-06-12T15:51:34+07:00\",\"status\":\"picked\"},{\"note\":\"Paket sedang diproses di Hub Jakarta Timur\",\"updated_at\":\"2025-06-12T23:34:38+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T05:03:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Tegal (proses transit).\",\"updated_at\":\"2025-06-13T13:30:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T14:53:24+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Banyumas (proses transit).\",\"updated_at\":\"2025-06-13T18:59:58+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket sedang diproses di Hub Banyumas\",\"updated_at\":\"2025-06-13T20:36:45+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Staging.\",\"updated_at\":\"2025-06-14T02:20:40+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket sudah tiba di SS Kab. Purbalingga - Majingklak untuk proses delivery.\",\"updated_at\":\"2025-06-14T07:50:46+07:00\",\"status\":\"dropping_off\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera diantar ke penerima.\",\"updated_at\":\"2025-06-14T08:16:36+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Delivery sukses oleh SATRIA dan paket telah diterima oleh melly(Penerima asli). Terima kasih sudah menggunakan jasa AnterAja #PastiBawaHepi.\",\"updated_at\":\"2025-06-14T12:59:56+07:00\",\"status\":\"delivered\"}]', `order_status` = 4
WHERE `id` = '50'
INFO - 2025-06-14 23:39:29 --> Language file loaded: language/english/db_lang.php
ERROR - 2025-06-14 23:40:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:40:32 --> Config Class Initialized
INFO - 2025-06-14 23:40:32 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:40:32 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:40:32 --> Utf8 Class Initialized
INFO - 2025-06-14 23:40:32 --> URI Class Initialized
INFO - 2025-06-14 23:40:32 --> Router Class Initialized
INFO - 2025-06-14 23:40:32 --> Output Class Initialized
INFO - 2025-06-14 23:40:32 --> Security Class Initialized
DEBUG - 2025-06-14 23:40:32 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:40:32 --> Input Class Initialized
INFO - 2025-06-14 23:40:32 --> Language Class Initialized
INFO - 2025-06-14 23:40:32 --> Language Class Initialized
INFO - 2025-06-14 23:40:32 --> Config Class Initialized
INFO - 2025-06-14 23:40:32 --> Loader Class Initialized
DEBUG - 2025-06-14 23:40:32 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:40:32 --> Helper loaded: url_helper
INFO - 2025-06-14 23:40:32 --> Helper loaded: global_helper
INFO - 2025-06-14 23:40:32 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:40:32 --> Helper loaded: session_helper
INFO - 2025-06-14 23:40:32 --> Database Driver Class Initialized
INFO - 2025-06-14 23:40:32 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:40:32 --> Controller Class Initialized
DEBUG - 2025-06-14 23:40:32 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:40:32 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:40:32 --> Encryption Class Initialized
INFO - 2025-06-14 23:40:32 --> Helper loaded: cookie_helper
DEBUG - 2025-06-14 23:40:32 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Product_model.php
DEBUG - 2025-06-14 23:40:32 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Customer_model.php
DEBUG - 2025-06-14 23:40:32 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Order_model.php
DEBUG - 2025-06-14 23:40:32 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Payment_model.php
DEBUG - 2025-06-14 23:40:32 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/header.php
DEBUG - 2025-06-14 23:40:32 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/overview.php
DEBUG - 2025-06-14 23:40:32 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/footer.php
INFO - 2025-06-14 23:40:32 --> Final output sent to browser
DEBUG - 2025-06-14 23:40:32 --> Total execution time: 0.1168
ERROR - 2025-06-14 23:40:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:40:34 --> Config Class Initialized
INFO - 2025-06-14 23:40:34 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:40:34 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:40:34 --> Utf8 Class Initialized
INFO - 2025-06-14 23:40:34 --> URI Class Initialized
INFO - 2025-06-14 23:40:34 --> Router Class Initialized
INFO - 2025-06-14 23:40:34 --> Output Class Initialized
INFO - 2025-06-14 23:40:34 --> Security Class Initialized
DEBUG - 2025-06-14 23:40:34 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:40:34 --> Input Class Initialized
INFO - 2025-06-14 23:40:34 --> Language Class Initialized
INFO - 2025-06-14 23:40:34 --> Language Class Initialized
INFO - 2025-06-14 23:40:34 --> Config Class Initialized
INFO - 2025-06-14 23:40:34 --> Loader Class Initialized
DEBUG - 2025-06-14 23:40:34 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:40:34 --> Helper loaded: url_helper
INFO - 2025-06-14 23:40:34 --> Helper loaded: global_helper
INFO - 2025-06-14 23:40:34 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:40:34 --> Helper loaded: session_helper
INFO - 2025-06-14 23:40:34 --> Database Driver Class Initialized
INFO - 2025-06-14 23:40:34 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:40:34 --> Controller Class Initialized
DEBUG - 2025-06-14 23:40:34 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:40:34 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:40:34 --> Encryption Class Initialized
INFO - 2025-06-14 23:40:34 --> Helper loaded: cookie_helper
INFO - 2025-06-14 23:40:34 --> Model "Order_model" initialized
INFO - 2025-06-14 23:40:34 --> Starting order status update cron job at 2025-06-14 23:40:34
DEBUG - 2025-06-14 23:40:34 --> Finding orders for tracking update
DEBUG - 2025-06-14 23:40:34 --> SQL Query: SELECT `id`, `order_number`, `order_status`, `tracking_number`, `courier`
FROM `orders`
WHERE tracking_number IS NOT NULL
AND courier IS NOT NULL
AND `order_status` IN(2, 3)
DEBUG - 2025-06-14 23:40:34 --> Found 4 orders to check
INFO - 2025-06-14 23:40:34 --> Checking order #EUA2522512815 (Resi: 200961465942, Kurir: jnt)
ERROR - 2025-06-14 23:40:38 --> HTTP Error 400 for jnt - 200961465942: {"success":false,"error":"Failed to get tracking information. It's either invalid or expired. Please check again","code":40003001}
ERROR - 2025-06-14 23:40:38 --> Failed to get tracking info - API call failed
INFO - 2025-06-14 23:40:38 --> Checking order #HUK14625125945 (Resi: 11002024002271, Kurir: anteraja)
ERROR - 2025-06-14 23:40:45 --> Query error: Unknown column 'last_tracking_update' in 'field list' - Invalid query: UPDATE `orders` SET `last_tracking_update` = '2025-06-14 23:40:45', `tracking_status` = 'delivered', `tracking_history` = '[{\"note\":\"Pickup sudah di-request oleh shipper, dan SATRIA akan pickup paket Kamis 12 Juni 2025.\",\"updated_at\":\"2025-06-12T13:44:09+07:00\",\"status\":\"picking_up\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera di-pickup.\",\"updated_at\":\"2025-06-12T14:30:11+07:00\",\"status\":\"picking_up\"},{\"note\":\"Paket sudah di-pickup oleh SATRIA.\",\"updated_at\":\"2025-06-12T15:51:34+07:00\",\"status\":\"picked\"},{\"note\":\"Paket sedang diproses di Hub Jakarta Timur\",\"updated_at\":\"2025-06-12T23:34:38+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T05:03:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Tegal (proses transit).\",\"updated_at\":\"2025-06-13T13:30:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T14:53:24+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Banyumas (proses transit).\",\"updated_at\":\"2025-06-13T18:59:58+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket sedang diproses di Hub Banyumas\",\"updated_at\":\"2025-06-13T20:36:45+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Staging.\",\"updated_at\":\"2025-06-14T02:20:40+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket sudah tiba di SS Kab. Purbalingga - Majingklak untuk proses delivery.\",\"updated_at\":\"2025-06-14T07:50:46+07:00\",\"status\":\"dropping_off\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera diantar ke penerima.\",\"updated_at\":\"2025-06-14T08:16:36+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Delivery sukses oleh SATRIA dan paket telah diterima oleh melly(Penerima asli). Terima kasih sudah menggunakan jasa AnterAja #PastiBawaHepi.\",\"updated_at\":\"2025-06-14T12:59:56+07:00\",\"status\":\"delivered\"}]', `order_status` = 4
WHERE `id` = '50'
INFO - 2025-06-14 23:40:45 --> Language file loaded: language/english/db_lang.php
ERROR - 2025-06-14 23:40:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:40:45 --> Config Class Initialized
INFO - 2025-06-14 23:40:45 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:40:45 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:40:45 --> Utf8 Class Initialized
INFO - 2025-06-14 23:40:45 --> URI Class Initialized
INFO - 2025-06-14 23:40:45 --> Router Class Initialized
INFO - 2025-06-14 23:40:45 --> Output Class Initialized
INFO - 2025-06-14 23:40:45 --> Security Class Initialized
DEBUG - 2025-06-14 23:40:45 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:40:45 --> Input Class Initialized
INFO - 2025-06-14 23:40:45 --> Language Class Initialized
INFO - 2025-06-14 23:40:45 --> Language Class Initialized
INFO - 2025-06-14 23:40:45 --> Config Class Initialized
INFO - 2025-06-14 23:40:45 --> Loader Class Initialized
DEBUG - 2025-06-14 23:40:45 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:40:45 --> Helper loaded: url_helper
INFO - 2025-06-14 23:40:45 --> Helper loaded: global_helper
INFO - 2025-06-14 23:40:45 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:40:45 --> Helper loaded: session_helper
INFO - 2025-06-14 23:40:45 --> Database Driver Class Initialized
INFO - 2025-06-14 23:40:45 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:40:45 --> Controller Class Initialized
DEBUG - 2025-06-14 23:40:45 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:40:45 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:40:45 --> Encryption Class Initialized
INFO - 2025-06-14 23:40:45 --> Helper loaded: cookie_helper
INFO - 2025-06-14 23:40:45 --> Model "Order_model" initialized
INFO - 2025-06-14 23:40:45 --> Starting order status update cron job at 2025-06-14 23:40:45
DEBUG - 2025-06-14 23:40:45 --> Finding orders for tracking update
DEBUG - 2025-06-14 23:40:45 --> SQL Query: SELECT `id`, `order_number`, `order_status`, `tracking_number`, `courier`
FROM `orders`
WHERE tracking_number IS NOT NULL
AND courier IS NOT NULL
AND `order_status` IN(2, 3)
DEBUG - 2025-06-14 23:40:45 --> Found 4 orders to check
INFO - 2025-06-14 23:40:45 --> Checking order #EUA2522512815 (Resi: 200961465942, Kurir: jnt)
ERROR - 2025-06-14 23:40:59 --> HTTP Error 400 for jnt - 200961465942: {"success":false,"error":"Failed to get tracking information. It's either invalid or expired. Please check again","code":40003001}
ERROR - 2025-06-14 23:40:59 --> Failed to get tracking info - API call failed
INFO - 2025-06-14 23:40:59 --> Checking order #HUK14625125945 (Resi: 11002024002271, Kurir: anteraja)
ERROR - 2025-06-14 23:41:02 --> Query error: Unknown column 'last_tracking_update' in 'field list' - Invalid query: UPDATE `orders` SET `last_tracking_update` = '2025-06-14 23:41:02', `tracking_status` = 'delivered', `tracking_history` = '[{\"note\":\"Pickup sudah di-request oleh shipper, dan SATRIA akan pickup paket Kamis 12 Juni 2025.\",\"updated_at\":\"2025-06-12T13:44:09+07:00\",\"status\":\"picking_up\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera di-pickup.\",\"updated_at\":\"2025-06-12T14:30:11+07:00\",\"status\":\"picking_up\"},{\"note\":\"Paket sudah di-pickup oleh SATRIA.\",\"updated_at\":\"2025-06-12T15:51:34+07:00\",\"status\":\"picked\"},{\"note\":\"Paket sedang diproses di Hub Jakarta Timur\",\"updated_at\":\"2025-06-12T23:34:38+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T05:03:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Tegal (proses transit).\",\"updated_at\":\"2025-06-13T13:30:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T14:53:24+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Banyumas (proses transit).\",\"updated_at\":\"2025-06-13T18:59:58+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket sedang diproses di Hub Banyumas\",\"updated_at\":\"2025-06-13T20:36:45+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Staging.\",\"updated_at\":\"2025-06-14T02:20:40+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket sudah tiba di SS Kab. Purbalingga - Majingklak untuk proses delivery.\",\"updated_at\":\"2025-06-14T07:50:46+07:00\",\"status\":\"dropping_off\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera diantar ke penerima.\",\"updated_at\":\"2025-06-14T08:16:36+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Delivery sukses oleh SATRIA dan paket telah diterima oleh melly(Penerima asli). Terima kasih sudah menggunakan jasa AnterAja #PastiBawaHepi.\",\"updated_at\":\"2025-06-14T12:59:56+07:00\",\"status\":\"delivered\"}]', `order_status` = 4
WHERE `id` = '50'
INFO - 2025-06-14 23:41:02 --> Language file loaded: language/english/db_lang.php
ERROR - 2025-06-14 23:41:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:41:02 --> Config Class Initialized
INFO - 2025-06-14 23:41:02 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:41:02 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:41:02 --> Utf8 Class Initialized
INFO - 2025-06-14 23:41:02 --> URI Class Initialized
INFO - 2025-06-14 23:41:02 --> Router Class Initialized
INFO - 2025-06-14 23:41:02 --> Output Class Initialized
INFO - 2025-06-14 23:41:02 --> Security Class Initialized
DEBUG - 2025-06-14 23:41:02 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:41:02 --> Input Class Initialized
INFO - 2025-06-14 23:41:02 --> Language Class Initialized
INFO - 2025-06-14 23:41:02 --> Language Class Initialized
INFO - 2025-06-14 23:41:02 --> Config Class Initialized
INFO - 2025-06-14 23:41:02 --> Loader Class Initialized
DEBUG - 2025-06-14 23:41:02 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:41:02 --> Helper loaded: url_helper
INFO - 2025-06-14 23:41:02 --> Helper loaded: global_helper
INFO - 2025-06-14 23:41:02 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:41:02 --> Helper loaded: session_helper
INFO - 2025-06-14 23:41:02 --> Database Driver Class Initialized
INFO - 2025-06-14 23:41:02 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:41:02 --> Controller Class Initialized
DEBUG - 2025-06-14 23:41:02 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:41:02 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:41:02 --> Encryption Class Initialized
INFO - 2025-06-14 23:41:02 --> Helper loaded: cookie_helper
INFO - 2025-06-14 23:41:02 --> Model "Order_model" initialized
INFO - 2025-06-14 23:41:02 --> Starting order status update cron job at 2025-06-14 23:41:02
DEBUG - 2025-06-14 23:41:02 --> Finding orders for tracking update
DEBUG - 2025-06-14 23:41:02 --> SQL Query: SELECT `id`, `order_number`, `order_status`, `tracking_number`, `courier`
FROM `orders`
WHERE tracking_number IS NOT NULL
AND courier IS NOT NULL
AND `order_status` IN(2, 3)
DEBUG - 2025-06-14 23:41:02 --> Found 4 orders to check
INFO - 2025-06-14 23:41:02 --> Checking order #EUA2522512815 (Resi: 200961465942, Kurir: jnt)
ERROR - 2025-06-14 23:41:08 --> HTTP Error 400 for jnt - 200961465942: {"success":false,"error":"Failed to get tracking information. It's either invalid or expired. Please check again","code":40003001}
ERROR - 2025-06-14 23:41:08 --> Failed to get tracking info - API call failed
INFO - 2025-06-14 23:41:08 --> Checking order #HUK14625125945 (Resi: 11002024002271, Kurir: anteraja)
ERROR - 2025-06-14 23:41:11 --> Query error: Unknown column 'last_tracking_update' in 'field list' - Invalid query: UPDATE `orders` SET `last_tracking_update` = '2025-06-14 23:41:11', `tracking_status` = 'delivered', `tracking_history` = '[{\"note\":\"Pickup sudah di-request oleh shipper, dan SATRIA akan pickup paket Kamis 12 Juni 2025.\",\"updated_at\":\"2025-06-12T13:44:09+07:00\",\"status\":\"picking_up\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera di-pickup.\",\"updated_at\":\"2025-06-12T14:30:11+07:00\",\"status\":\"picking_up\"},{\"note\":\"Paket sudah di-pickup oleh SATRIA.\",\"updated_at\":\"2025-06-12T15:51:34+07:00\",\"status\":\"picked\"},{\"note\":\"Paket sedang diproses di Hub Jakarta Timur\",\"updated_at\":\"2025-06-12T23:34:38+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T05:03:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Tegal (proses transit).\",\"updated_at\":\"2025-06-13T13:30:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T14:53:24+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Banyumas (proses transit).\",\"updated_at\":\"2025-06-13T18:59:58+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket sedang diproses di Hub Banyumas\",\"updated_at\":\"2025-06-13T20:36:45+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Staging.\",\"updated_at\":\"2025-06-14T02:20:40+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket sudah tiba di SS Kab. Purbalingga - Majingklak untuk proses delivery.\",\"updated_at\":\"2025-06-14T07:50:46+07:00\",\"status\":\"dropping_off\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera diantar ke penerima.\",\"updated_at\":\"2025-06-14T08:16:36+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Delivery sukses oleh SATRIA dan paket telah diterima oleh melly(Penerima asli). Terima kasih sudah menggunakan jasa AnterAja #PastiBawaHepi.\",\"updated_at\":\"2025-06-14T12:59:56+07:00\",\"status\":\"delivered\"}]', `order_status` = 4
WHERE `id` = '50'
INFO - 2025-06-14 23:41:11 --> Language file loaded: language/english/db_lang.php
ERROR - 2025-06-14 23:41:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:41:47 --> Config Class Initialized
INFO - 2025-06-14 23:41:47 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:41:47 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:41:47 --> Utf8 Class Initialized
INFO - 2025-06-14 23:41:47 --> URI Class Initialized
INFO - 2025-06-14 23:41:47 --> Router Class Initialized
INFO - 2025-06-14 23:41:47 --> Output Class Initialized
INFO - 2025-06-14 23:41:47 --> Security Class Initialized
DEBUG - 2025-06-14 23:41:47 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:41:47 --> Input Class Initialized
INFO - 2025-06-14 23:41:47 --> Language Class Initialized
INFO - 2025-06-14 23:41:47 --> Language Class Initialized
INFO - 2025-06-14 23:41:47 --> Config Class Initialized
INFO - 2025-06-14 23:41:47 --> Loader Class Initialized
DEBUG - 2025-06-14 23:41:47 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:41:47 --> Helper loaded: url_helper
INFO - 2025-06-14 23:41:47 --> Helper loaded: global_helper
INFO - 2025-06-14 23:41:47 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:41:47 --> Helper loaded: session_helper
INFO - 2025-06-14 23:41:47 --> Database Driver Class Initialized
INFO - 2025-06-14 23:41:47 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:41:47 --> Controller Class Initialized
DEBUG - 2025-06-14 23:41:47 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:41:47 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:41:47 --> Encryption Class Initialized
INFO - 2025-06-14 23:41:47 --> Helper loaded: cookie_helper
INFO - 2025-06-14 23:41:47 --> Model "Order_model" initialized
INFO - 2025-06-14 23:41:47 --> Starting order status update cron job at 2025-06-14 23:41:47
DEBUG - 2025-06-14 23:41:47 --> Finding orders for tracking update
DEBUG - 2025-06-14 23:41:47 --> SQL Query: SELECT `id`, `order_number`, `order_status`, `tracking_number`, `courier`
FROM `orders`
WHERE tracking_number IS NOT NULL
AND courier IS NOT NULL
AND `order_status` IN(2, 3)
DEBUG - 2025-06-14 23:41:47 --> Found 4 orders to check
INFO - 2025-06-14 23:41:47 --> Checking order #EUA2522512815 (Resi: 200961465942, Kurir: jnt)
ERROR - 2025-06-14 23:41:51 --> HTTP Error 400 for jnt - 200961465942: {"success":false,"error":"Failed to get tracking information. It's either invalid or expired. Please check again","code":40003001}
ERROR - 2025-06-14 23:41:51 --> Failed to get tracking info - API call failed
INFO - 2025-06-14 23:41:51 --> Checking order #HUK14625125945 (Resi: 11002024002271, Kurir: anteraja)
ERROR - 2025-06-14 23:41:54 --> Query error: Unknown column 'last_tracking_update' in 'field list' - Invalid query: UPDATE `orders` SET `last_tracking_update` = '2025-06-14 23:41:54', `tracking_status` = 'delivered', `tracking_history` = '[{\"note\":\"Pickup sudah di-request oleh shipper, dan SATRIA akan pickup paket Kamis 12 Juni 2025.\",\"updated_at\":\"2025-06-12T13:44:09+07:00\",\"status\":\"picking_up\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera di-pickup.\",\"updated_at\":\"2025-06-12T14:30:11+07:00\",\"status\":\"picking_up\"},{\"note\":\"Paket sudah di-pickup oleh SATRIA.\",\"updated_at\":\"2025-06-12T15:51:34+07:00\",\"status\":\"picked\"},{\"note\":\"Paket sedang diproses di Hub Jakarta Timur\",\"updated_at\":\"2025-06-12T23:34:38+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T05:03:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Tegal (proses transit).\",\"updated_at\":\"2025-06-13T13:30:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T14:53:24+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Banyumas (proses transit).\",\"updated_at\":\"2025-06-13T18:59:58+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket sedang diproses di Hub Banyumas\",\"updated_at\":\"2025-06-13T20:36:45+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Staging.\",\"updated_at\":\"2025-06-14T02:20:40+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket sudah tiba di SS Kab. Purbalingga - Majingklak untuk proses delivery.\",\"updated_at\":\"2025-06-14T07:50:46+07:00\",\"status\":\"dropping_off\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera diantar ke penerima.\",\"updated_at\":\"2025-06-14T08:16:36+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Delivery sukses oleh SATRIA dan paket telah diterima oleh melly(Penerima asli). Terima kasih sudah menggunakan jasa AnterAja #PastiBawaHepi.\",\"updated_at\":\"2025-06-14T12:59:56+07:00\",\"status\":\"delivered\"}]', `order_status` = 4
WHERE `id` = '50'
INFO - 2025-06-14 23:41:54 --> Language file loaded: language/english/db_lang.php
ERROR - 2025-06-14 23:47:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:47:26 --> Config Class Initialized
INFO - 2025-06-14 23:47:26 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:47:26 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:47:26 --> Utf8 Class Initialized
INFO - 2025-06-14 23:47:26 --> URI Class Initialized
INFO - 2025-06-14 23:47:26 --> Router Class Initialized
INFO - 2025-06-14 23:47:26 --> Output Class Initialized
INFO - 2025-06-14 23:47:26 --> Security Class Initialized
DEBUG - 2025-06-14 23:47:26 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:47:26 --> Input Class Initialized
INFO - 2025-06-14 23:47:26 --> Language Class Initialized
INFO - 2025-06-14 23:47:26 --> Language Class Initialized
INFO - 2025-06-14 23:47:26 --> Config Class Initialized
INFO - 2025-06-14 23:47:26 --> Loader Class Initialized
DEBUG - 2025-06-14 23:47:26 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:47:26 --> Helper loaded: url_helper
INFO - 2025-06-14 23:47:26 --> Helper loaded: global_helper
INFO - 2025-06-14 23:47:26 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:47:26 --> Helper loaded: session_helper
INFO - 2025-06-14 23:47:26 --> Database Driver Class Initialized
INFO - 2025-06-14 23:47:26 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:47:26 --> Controller Class Initialized
DEBUG - 2025-06-14 23:47:26 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:47:26 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:47:26 --> Encryption Class Initialized
INFO - 2025-06-14 23:47:26 --> Helper loaded: cookie_helper
INFO - 2025-06-14 23:47:26 --> Model "Order_model" initialized
INFO - 2025-06-14 23:47:26 --> Starting order status update cron job at 2025-06-14 23:47:26
DEBUG - 2025-06-14 23:47:26 --> Finding orders for tracking update
DEBUG - 2025-06-14 23:47:26 --> SQL Query: SELECT `id`, `order_number`, `order_status`, `tracking_number`, `courier`
FROM `orders`
WHERE tracking_number IS NOT NULL
AND courier IS NOT NULL
AND `order_status` IN(2, 3)
DEBUG - 2025-06-14 23:47:26 --> Found 4 orders to check
INFO - 2025-06-14 23:47:26 --> Checking order #EUA2522512815 (Resi: 200961465942, Kurir: jnt)
ERROR - 2025-06-14 23:47:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:47:33 --> Config Class Initialized
INFO - 2025-06-14 23:47:33 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:47:33 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:47:33 --> Utf8 Class Initialized
INFO - 2025-06-14 23:47:33 --> URI Class Initialized
INFO - 2025-06-14 23:47:33 --> Router Class Initialized
INFO - 2025-06-14 23:47:33 --> Output Class Initialized
INFO - 2025-06-14 23:47:33 --> Security Class Initialized
DEBUG - 2025-06-14 23:47:33 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:47:33 --> Input Class Initialized
INFO - 2025-06-14 23:47:33 --> Language Class Initialized
INFO - 2025-06-14 23:47:33 --> Language Class Initialized
INFO - 2025-06-14 23:47:33 --> Config Class Initialized
INFO - 2025-06-14 23:47:33 --> Loader Class Initialized
DEBUG - 2025-06-14 23:47:33 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:47:33 --> Helper loaded: url_helper
INFO - 2025-06-14 23:47:33 --> Helper loaded: global_helper
INFO - 2025-06-14 23:47:33 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:47:33 --> Helper loaded: session_helper
INFO - 2025-06-14 23:47:33 --> Database Driver Class Initialized
ERROR - 2025-06-14 23:47:36 --> HTTP Error 400 for jnt - 200961465942: {"success":false,"error":"Failed to get tracking information. It's either invalid or expired. Please check again","code":40003001}
ERROR - 2025-06-14 23:47:36 --> Failed to get tracking info - API call failed
INFO - 2025-06-14 23:47:36 --> Checking order #HUK14625125945 (Resi: 11002024002271, Kurir: anteraja)
ERROR - 2025-06-14 23:47:46 --> Query error: Unknown column 'last_tracking_update' in 'field list' - Invalid query: UPDATE `orders` SET `last_tracking_update` = '2025-06-14 23:47:46', `tracking_status` = 'delivered', `tracking_history` = '[{\"note\":\"Pickup sudah di-request oleh shipper, dan SATRIA akan pickup paket Kamis 12 Juni 2025.\",\"updated_at\":\"2025-06-12T13:44:09+07:00\",\"status\":\"picking_up\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera di-pickup.\",\"updated_at\":\"2025-06-12T14:30:11+07:00\",\"status\":\"picking_up\"},{\"note\":\"Paket sudah di-pickup oleh SATRIA.\",\"updated_at\":\"2025-06-12T15:51:34+07:00\",\"status\":\"picked\"},{\"note\":\"Paket sedang diproses di Hub Jakarta Timur\",\"updated_at\":\"2025-06-12T23:34:38+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T05:03:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Tegal (proses transit).\",\"updated_at\":\"2025-06-13T13:30:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T14:53:24+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Banyumas (proses transit).\",\"updated_at\":\"2025-06-13T18:59:58+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket sedang diproses di Hub Banyumas\",\"updated_at\":\"2025-06-13T20:36:45+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Staging.\",\"updated_at\":\"2025-06-14T02:20:40+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket sudah tiba di SS Kab. Purbalingga - Majingklak untuk proses delivery.\",\"updated_at\":\"2025-06-14T07:50:46+07:00\",\"status\":\"dropping_off\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera diantar ke penerima.\",\"updated_at\":\"2025-06-14T08:16:36+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Delivery sukses oleh SATRIA dan paket telah diterima oleh melly(Penerima asli). Terima kasih sudah menggunakan jasa AnterAja #PastiBawaHepi.\",\"updated_at\":\"2025-06-14T12:59:56+07:00\",\"status\":\"delivered\"}]', `order_status` = 4
WHERE `id` = '50'
INFO - 2025-06-14 23:47:46 --> Language file loaded: language/english/db_lang.php
INFO - 2025-06-14 23:47:46 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:47:46 --> Controller Class Initialized
DEBUG - 2025-06-14 23:47:46 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:47:46 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:47:46 --> Encryption Class Initialized
INFO - 2025-06-14 23:47:46 --> Helper loaded: cookie_helper
ERROR - 2025-06-14 23:47:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
DEBUG - 2025-06-14 23:47:46 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Product_model.php
DEBUG - 2025-06-14 23:47:46 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Customer_model.php
INFO - 2025-06-14 23:47:46 --> Config Class Initialized
INFO - 2025-06-14 23:47:46 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:47:46 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Order_model.php
DEBUG - 2025-06-14 23:47:46 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Payment_model.php
DEBUG - 2025-06-14 23:47:46 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:47:46 --> Utf8 Class Initialized
INFO - 2025-06-14 23:47:46 --> URI Class Initialized
INFO - 2025-06-14 23:47:46 --> Router Class Initialized
INFO - 2025-06-14 23:47:46 --> Output Class Initialized
INFO - 2025-06-14 23:47:46 --> Security Class Initialized
DEBUG - 2025-06-14 23:47:46 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:47:46 --> Input Class Initialized
INFO - 2025-06-14 23:47:46 --> Language Class Initialized
DEBUG - 2025-06-14 23:47:46 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/header.php
INFO - 2025-06-14 23:47:46 --> Language Class Initialized
INFO - 2025-06-14 23:47:46 --> Config Class Initialized
INFO - 2025-06-14 23:47:46 --> Loader Class Initialized
DEBUG - 2025-06-14 23:47:46 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/overview.php
DEBUG - 2025-06-14 23:47:46 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
DEBUG - 2025-06-14 23:47:46 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/footer.php
INFO - 2025-06-14 23:47:46 --> Final output sent to browser
DEBUG - 2025-06-14 23:47:46 --> Total execution time: 13.4713
INFO - 2025-06-14 23:47:46 --> Helper loaded: url_helper
INFO - 2025-06-14 23:47:46 --> Helper loaded: global_helper
INFO - 2025-06-14 23:47:46 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:47:46 --> Helper loaded: session_helper
INFO - 2025-06-14 23:47:46 --> Database Driver Class Initialized
INFO - 2025-06-14 23:47:46 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:47:46 --> Controller Class Initialized
DEBUG - 2025-06-14 23:47:46 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:47:46 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:47:46 --> Encryption Class Initialized
INFO - 2025-06-14 23:47:46 --> Helper loaded: cookie_helper
INFO - 2025-06-14 23:47:46 --> Model "Order_model" initialized
INFO - 2025-06-14 23:47:46 --> Starting order status update cron job at 2025-06-14 23:47:46
DEBUG - 2025-06-14 23:47:46 --> Finding orders for tracking update
DEBUG - 2025-06-14 23:47:46 --> SQL Query: SELECT `id`, `order_number`, `order_status`, `tracking_number`, `courier`
FROM `orders`
WHERE tracking_number IS NOT NULL
AND courier IS NOT NULL
AND `order_status` IN(2, 3)
DEBUG - 2025-06-14 23:47:46 --> Found 4 orders to check
INFO - 2025-06-14 23:47:46 --> Checking order #EUA2522512815 (Resi: 200961465942, Kurir: jnt)
ERROR - 2025-06-14 23:47:49 --> HTTP Error 400 for jnt - 200961465942: {"success":false,"error":"Failed to get tracking information. It's either invalid or expired. Please check again","code":40003001}
ERROR - 2025-06-14 23:47:49 --> Failed to get tracking info - API call failed
INFO - 2025-06-14 23:47:49 --> Checking order #HUK14625125945 (Resi: 11002024002271, Kurir: anteraja)
ERROR - 2025-06-14 23:47:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:47:51 --> Config Class Initialized
INFO - 2025-06-14 23:47:51 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:47:51 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:47:51 --> Utf8 Class Initialized
INFO - 2025-06-14 23:47:51 --> URI Class Initialized
INFO - 2025-06-14 23:47:51 --> Router Class Initialized
INFO - 2025-06-14 23:47:51 --> Output Class Initialized
INFO - 2025-06-14 23:47:51 --> Security Class Initialized
DEBUG - 2025-06-14 23:47:51 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:47:51 --> Input Class Initialized
INFO - 2025-06-14 23:47:51 --> Language Class Initialized
INFO - 2025-06-14 23:47:51 --> Language Class Initialized
INFO - 2025-06-14 23:47:51 --> Config Class Initialized
INFO - 2025-06-14 23:47:51 --> Loader Class Initialized
DEBUG - 2025-06-14 23:47:51 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:47:51 --> Helper loaded: url_helper
INFO - 2025-06-14 23:47:51 --> Helper loaded: global_helper
INFO - 2025-06-14 23:47:51 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:47:51 --> Helper loaded: session_helper
INFO - 2025-06-14 23:47:51 --> Database Driver Class Initialized
INFO - 2025-06-14 23:47:52 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:47:52 --> Controller Class Initialized
DEBUG - 2025-06-14 23:47:52 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:47:52 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:47:52 --> Encryption Class Initialized
INFO - 2025-06-14 23:47:52 --> Helper loaded: cookie_helper
INFO - 2025-06-14 23:47:52 --> Model "Order_model" initialized
INFO - 2025-06-14 23:47:52 --> Starting order status update cron job at 2025-06-14 23:47:52
DEBUG - 2025-06-14 23:47:52 --> Finding orders for tracking update
DEBUG - 2025-06-14 23:47:52 --> SQL Query: SELECT `id`, `order_number`, `order_status`, `tracking_number`, `courier`
FROM `orders`
WHERE tracking_number IS NOT NULL
AND courier IS NOT NULL
AND `order_status` IN(2, 3)
DEBUG - 2025-06-14 23:47:52 --> Found 4 orders to check
INFO - 2025-06-14 23:47:52 --> Checking order #EUA2522512815 (Resi: 200961465942, Kurir: jnt)
ERROR - 2025-06-14 23:47:56 --> HTTP Error 400 for jnt - 200961465942: {"success":false,"error":"Failed to get tracking information. It's either invalid or expired. Please check again","code":40003001}
ERROR - 2025-06-14 23:47:56 --> Failed to get tracking info - API call failed
INFO - 2025-06-14 23:47:56 --> Checking order #HUK14625125945 (Resi: 11002024002271, Kurir: anteraja)
ERROR - 2025-06-14 23:47:57 --> Query error: Unknown column 'last_tracking_update' in 'field list' - Invalid query: UPDATE `orders` SET `last_tracking_update` = '2025-06-14 23:47:57', `tracking_status` = 'delivered', `tracking_history` = '[{\"note\":\"Pickup sudah di-request oleh shipper, dan SATRIA akan pickup paket Kamis 12 Juni 2025.\",\"updated_at\":\"2025-06-12T13:44:09+07:00\",\"status\":\"picking_up\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera di-pickup.\",\"updated_at\":\"2025-06-12T14:30:11+07:00\",\"status\":\"picking_up\"},{\"note\":\"Paket sudah di-pickup oleh SATRIA.\",\"updated_at\":\"2025-06-12T15:51:34+07:00\",\"status\":\"picked\"},{\"note\":\"Paket sedang diproses di Hub Jakarta Timur\",\"updated_at\":\"2025-06-12T23:34:38+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T05:03:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Tegal (proses transit).\",\"updated_at\":\"2025-06-13T13:30:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T14:53:24+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Banyumas (proses transit).\",\"updated_at\":\"2025-06-13T18:59:58+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket sedang diproses di Hub Banyumas\",\"updated_at\":\"2025-06-13T20:36:45+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Staging.\",\"updated_at\":\"2025-06-14T02:20:40+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket sudah tiba di SS Kab. Purbalingga - Majingklak untuk proses delivery.\",\"updated_at\":\"2025-06-14T07:50:46+07:00\",\"status\":\"dropping_off\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera diantar ke penerima.\",\"updated_at\":\"2025-06-14T08:16:36+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Delivery sukses oleh SATRIA dan paket telah diterima oleh melly(Penerima asli). Terima kasih sudah menggunakan jasa AnterAja #PastiBawaHepi.\",\"updated_at\":\"2025-06-14T12:59:56+07:00\",\"status\":\"delivered\"}]', `order_status` = 4
WHERE `id` = '50'
INFO - 2025-06-14 23:47:57 --> Language file loaded: language/english/db_lang.php
ERROR - 2025-06-14 23:48:04 --> Query error: Unknown column 'last_tracking_update' in 'field list' - Invalid query: UPDATE `orders` SET `last_tracking_update` = '2025-06-14 23:48:04', `tracking_status` = 'delivered', `tracking_history` = '[{\"note\":\"Pickup sudah di-request oleh shipper, dan SATRIA akan pickup paket Kamis 12 Juni 2025.\",\"updated_at\":\"2025-06-12T13:44:09+07:00\",\"status\":\"picking_up\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera di-pickup.\",\"updated_at\":\"2025-06-12T14:30:11+07:00\",\"status\":\"picking_up\"},{\"note\":\"Paket sudah di-pickup oleh SATRIA.\",\"updated_at\":\"2025-06-12T15:51:34+07:00\",\"status\":\"picked\"},{\"note\":\"Paket sedang diproses di Hub Jakarta Timur\",\"updated_at\":\"2025-06-12T23:34:38+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T05:03:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Tegal (proses transit).\",\"updated_at\":\"2025-06-13T13:30:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T14:53:24+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Banyumas (proses transit).\",\"updated_at\":\"2025-06-13T18:59:58+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket sedang diproses di Hub Banyumas\",\"updated_at\":\"2025-06-13T20:36:45+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Staging.\",\"updated_at\":\"2025-06-14T02:20:40+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket sudah tiba di SS Kab. Purbalingga - Majingklak untuk proses delivery.\",\"updated_at\":\"2025-06-14T07:50:46+07:00\",\"status\":\"dropping_off\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera diantar ke penerima.\",\"updated_at\":\"2025-06-14T08:16:36+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Delivery sukses oleh SATRIA dan paket telah diterima oleh melly(Penerima asli). Terima kasih sudah menggunakan jasa AnterAja #PastiBawaHepi.\",\"updated_at\":\"2025-06-14T12:59:56+07:00\",\"status\":\"delivered\"}]', `order_status` = 4
WHERE `id` = '50'
INFO - 2025-06-14 23:48:04 --> Language file loaded: language/english/db_lang.php
ERROR - 2025-06-14 23:48:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:48:17 --> Config Class Initialized
INFO - 2025-06-14 23:48:17 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:48:17 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:48:17 --> Utf8 Class Initialized
INFO - 2025-06-14 23:48:17 --> URI Class Initialized
INFO - 2025-06-14 23:48:17 --> Router Class Initialized
INFO - 2025-06-14 23:48:17 --> Output Class Initialized
INFO - 2025-06-14 23:48:17 --> Security Class Initialized
DEBUG - 2025-06-14 23:48:17 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:48:17 --> Input Class Initialized
INFO - 2025-06-14 23:48:17 --> Language Class Initialized
INFO - 2025-06-14 23:48:17 --> Language Class Initialized
INFO - 2025-06-14 23:48:17 --> Config Class Initialized
INFO - 2025-06-14 23:48:17 --> Loader Class Initialized
DEBUG - 2025-06-14 23:48:17 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:48:17 --> Helper loaded: url_helper
INFO - 2025-06-14 23:48:17 --> Helper loaded: global_helper
INFO - 2025-06-14 23:48:17 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:48:17 --> Helper loaded: session_helper
INFO - 2025-06-14 23:48:17 --> Database Driver Class Initialized
INFO - 2025-06-14 23:48:17 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:48:17 --> Controller Class Initialized
DEBUG - 2025-06-14 23:48:17 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:48:17 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:48:17 --> Encryption Class Initialized
INFO - 2025-06-14 23:48:17 --> Helper loaded: cookie_helper
DEBUG - 2025-06-14 23:48:17 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Product_model.php
DEBUG - 2025-06-14 23:48:17 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Customer_model.php
DEBUG - 2025-06-14 23:48:17 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Order_model.php
DEBUG - 2025-06-14 23:48:17 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Payment_model.php
DEBUG - 2025-06-14 23:48:17 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/header.php
DEBUG - 2025-06-14 23:48:17 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/overview.php
DEBUG - 2025-06-14 23:48:17 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/footer.php
INFO - 2025-06-14 23:48:17 --> Final output sent to browser
DEBUG - 2025-06-14 23:48:17 --> Total execution time: 0.1730
ERROR - 2025-06-14 23:48:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:48:19 --> Config Class Initialized
INFO - 2025-06-14 23:48:19 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:48:19 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:48:19 --> Utf8 Class Initialized
INFO - 2025-06-14 23:48:19 --> URI Class Initialized
INFO - 2025-06-14 23:48:19 --> Router Class Initialized
INFO - 2025-06-14 23:48:19 --> Output Class Initialized
INFO - 2025-06-14 23:48:19 --> Security Class Initialized
DEBUG - 2025-06-14 23:48:19 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:48:19 --> Input Class Initialized
INFO - 2025-06-14 23:48:19 --> Language Class Initialized
INFO - 2025-06-14 23:48:19 --> Language Class Initialized
INFO - 2025-06-14 23:48:19 --> Config Class Initialized
INFO - 2025-06-14 23:48:19 --> Loader Class Initialized
DEBUG - 2025-06-14 23:48:19 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:48:19 --> Helper loaded: url_helper
INFO - 2025-06-14 23:48:19 --> Helper loaded: global_helper
INFO - 2025-06-14 23:48:19 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:48:19 --> Helper loaded: session_helper
INFO - 2025-06-14 23:48:19 --> Database Driver Class Initialized
INFO - 2025-06-14 23:48:19 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:48:19 --> Controller Class Initialized
DEBUG - 2025-06-14 23:48:19 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:48:19 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:48:19 --> Encryption Class Initialized
INFO - 2025-06-14 23:48:19 --> Helper loaded: cookie_helper
INFO - 2025-06-14 23:48:19 --> Model "Order_model" initialized
INFO - 2025-06-14 23:48:19 --> Starting order status update cron job at 2025-06-14 23:48:19
DEBUG - 2025-06-14 23:48:19 --> Finding orders for tracking update
DEBUG - 2025-06-14 23:48:19 --> SQL Query: SELECT `id`, `order_number`, `order_status`, `tracking_number`, `courier`
FROM `orders`
WHERE tracking_number IS NOT NULL
AND courier IS NOT NULL
AND `order_status` IN(2, 3)
DEBUG - 2025-06-14 23:48:19 --> Found 4 orders to check
INFO - 2025-06-14 23:48:19 --> Checking order #EUA2522512815 (Resi: 200961465942, Kurir: jnt)
ERROR - 2025-06-14 23:48:23 --> HTTP Error 400 for jnt - 200961465942: {"success":false,"error":"Failed to get tracking information. It's either invalid or expired. Please check again","code":40003001}
ERROR - 2025-06-14 23:48:23 --> Failed to get tracking info - API call failed
INFO - 2025-06-14 23:48:23 --> Checking order #HUK14625125945 (Resi: 11002024002271, Kurir: anteraja)
ERROR - 2025-06-14 23:48:28 --> Query error: Unknown column 'last_tracking_update' in 'field list' - Invalid query: UPDATE `orders` SET `last_tracking_update` = '2025-06-14 23:48:28', `tracking_status` = 'delivered', `tracking_history` = '[{\"note\":\"Pickup sudah di-request oleh shipper, dan SATRIA akan pickup paket Kamis 12 Juni 2025.\",\"updated_at\":\"2025-06-12T13:44:09+07:00\",\"status\":\"picking_up\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera di-pickup.\",\"updated_at\":\"2025-06-12T14:30:11+07:00\",\"status\":\"picking_up\"},{\"note\":\"Paket sudah di-pickup oleh SATRIA.\",\"updated_at\":\"2025-06-12T15:51:34+07:00\",\"status\":\"picked\"},{\"note\":\"Paket sedang diproses di Hub Jakarta Timur\",\"updated_at\":\"2025-06-12T23:34:38+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T05:03:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Tegal (proses transit).\",\"updated_at\":\"2025-06-13T13:30:04+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket menuju ke Hub (proses transit).\",\"updated_at\":\"2025-06-13T14:53:24+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket tiba di Hub Banyumas (proses transit).\",\"updated_at\":\"2025-06-13T18:59:58+07:00\",\"status\":\"on_hold\"},{\"note\":\"Paket sedang diproses di Hub Banyumas\",\"updated_at\":\"2025-06-13T20:36:45+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket menuju ke Staging.\",\"updated_at\":\"2025-06-14T02:20:40+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Paket sudah tiba di SS Kab. Purbalingga - Majingklak untuk proses delivery.\",\"updated_at\":\"2025-06-14T07:50:46+07:00\",\"status\":\"dropping_off\"},{\"note\":\"SATRIA sudah ditugaskan dan paket akan segera diantar ke penerima.\",\"updated_at\":\"2025-06-14T08:16:36+07:00\",\"status\":\"dropping_off\"},{\"note\":\"Delivery sukses oleh SATRIA dan paket telah diterima oleh melly(Penerima asli). Terima kasih sudah menggunakan jasa AnterAja #PastiBawaHepi.\",\"updated_at\":\"2025-06-14T12:59:56+07:00\",\"status\":\"delivered\"}]', `order_status` = 4
WHERE `id` = '50'
INFO - 2025-06-14 23:48:28 --> Language file loaded: language/english/db_lang.php
ERROR - 2025-06-14 23:49:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:49:10 --> Config Class Initialized
INFO - 2025-06-14 23:49:10 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:49:10 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:49:10 --> Utf8 Class Initialized
INFO - 2025-06-14 23:49:10 --> URI Class Initialized
INFO - 2025-06-14 23:49:10 --> Router Class Initialized
INFO - 2025-06-14 23:49:10 --> Output Class Initialized
INFO - 2025-06-14 23:49:10 --> Security Class Initialized
DEBUG - 2025-06-14 23:49:10 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:49:10 --> Input Class Initialized
INFO - 2025-06-14 23:49:10 --> Language Class Initialized
INFO - 2025-06-14 23:49:10 --> Language Class Initialized
INFO - 2025-06-14 23:49:10 --> Config Class Initialized
INFO - 2025-06-14 23:49:10 --> Loader Class Initialized
DEBUG - 2025-06-14 23:49:10 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:49:10 --> Helper loaded: url_helper
INFO - 2025-06-14 23:49:10 --> Helper loaded: global_helper
INFO - 2025-06-14 23:49:10 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:49:10 --> Helper loaded: session_helper
INFO - 2025-06-14 23:49:10 --> Database Driver Class Initialized
INFO - 2025-06-14 23:49:10 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:49:10 --> Controller Class Initialized
DEBUG - 2025-06-14 23:49:10 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:49:10 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:49:10 --> Encryption Class Initialized
INFO - 2025-06-14 23:49:10 --> Helper loaded: cookie_helper
DEBUG - 2025-06-14 23:49:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Product_model.php
DEBUG - 2025-06-14 23:49:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Customer_model.php
DEBUG - 2025-06-14 23:49:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Order_model.php
DEBUG - 2025-06-14 23:49:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Payment_model.php
DEBUG - 2025-06-14 23:49:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/header.php
DEBUG - 2025-06-14 23:49:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/overview.php
DEBUG - 2025-06-14 23:49:10 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/footer.php
INFO - 2025-06-14 23:49:10 --> Final output sent to browser
DEBUG - 2025-06-14 23:49:10 --> Total execution time: 0.1554
ERROR - 2025-06-14 23:49:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:49:12 --> Config Class Initialized
INFO - 2025-06-14 23:49:12 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:49:12 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:49:12 --> Utf8 Class Initialized
INFO - 2025-06-14 23:49:12 --> URI Class Initialized
INFO - 2025-06-14 23:49:12 --> Router Class Initialized
INFO - 2025-06-14 23:49:12 --> Output Class Initialized
ERROR - 2025-06-14 23:49:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:49:12 --> Config Class Initialized
INFO - 2025-06-14 23:49:12 --> Security Class Initialized
INFO - 2025-06-14 23:49:12 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:49:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:49:12 --> Input Class Initialized
DEBUG - 2025-06-14 23:49:12 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:49:12 --> Utf8 Class Initialized
INFO - 2025-06-14 23:49:12 --> Language Class Initialized
INFO - 2025-06-14 23:49:12 --> URI Class Initialized
INFO - 2025-06-14 23:49:12 --> Router Class Initialized
INFO - 2025-06-14 23:49:12 --> Language Class Initialized
INFO - 2025-06-14 23:49:12 --> Config Class Initialized
INFO - 2025-06-14 23:49:12 --> Loader Class Initialized
INFO - 2025-06-14 23:49:12 --> Output Class Initialized
DEBUG - 2025-06-14 23:49:12 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:49:12 --> Helper loaded: url_helper
INFO - 2025-06-14 23:49:12 --> Security Class Initialized
INFO - 2025-06-14 23:49:12 --> Helper loaded: global_helper
DEBUG - 2025-06-14 23:49:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:49:12 --> Input Class Initialized
INFO - 2025-06-14 23:49:12 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:49:12 --> Language Class Initialized
INFO - 2025-06-14 23:49:12 --> Helper loaded: session_helper
INFO - 2025-06-14 23:49:12 --> Language Class Initialized
INFO - 2025-06-14 23:49:12 --> Config Class Initialized
INFO - 2025-06-14 23:49:12 --> Loader Class Initialized
INFO - 2025-06-14 23:49:12 --> Database Driver Class Initialized
DEBUG - 2025-06-14 23:49:12 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:49:12 --> Helper loaded: url_helper
INFO - 2025-06-14 23:49:12 --> Helper loaded: global_helper
INFO - 2025-06-14 23:49:12 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:49:12 --> Helper loaded: session_helper
INFO - 2025-06-14 23:49:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:49:12 --> Controller Class Initialized
INFO - 2025-06-14 23:49:12 --> Database Driver Class Initialized
INFO - 2025-06-14 23:49:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:49:12 --> Controller Class Initialized
DEBUG - 2025-06-14 23:49:12 --> Encryption: Auto-configured driver 'openssl'.
INFO - 2025-06-14 23:49:12 --> Encryption: OpenSSL initialized with method AES-128-CBC.
INFO - 2025-06-14 23:49:12 --> Encryption Class Initialized
INFO - 2025-06-14 23:49:12 --> Helper loaded: cookie_helper
DEBUG - 2025-06-14 23:49:12 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/models/Order_model.php
INFO - 2025-06-14 23:49:12 --> Language file loaded: language/english/pagination_lang.php
INFO - 2025-06-14 23:49:12 --> Pagination Class Initialized
DEBUG - 2025-06-14 23:49:12 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/header.php
DEBUG - 2025-06-14 23:49:12 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/orders/orders.php
DEBUG - 2025-06-14 23:49:12 --> File loaded: C:\First\htdocs\Troops\application\modules/admin/views/footer.php
INFO - 2025-06-14 23:49:12 --> Final output sent to browser
DEBUG - 2025-06-14 23:49:12 --> Total execution time: 0.0937
ERROR - 2025-06-14 23:49:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
INFO - 2025-06-14 23:49:12 --> Config Class Initialized
INFO - 2025-06-14 23:49:12 --> Hooks Class Initialized
DEBUG - 2025-06-14 23:49:12 --> UTF-8 Support Enabled
INFO - 2025-06-14 23:49:12 --> Utf8 Class Initialized
INFO - 2025-06-14 23:49:12 --> URI Class Initialized
INFO - 2025-06-14 23:49:12 --> Router Class Initialized
INFO - 2025-06-14 23:49:12 --> Output Class Initialized
INFO - 2025-06-14 23:49:12 --> Security Class Initialized
DEBUG - 2025-06-14 23:49:12 --> Global POST, GET and COOKIE data sanitized
INFO - 2025-06-14 23:49:12 --> Input Class Initialized
INFO - 2025-06-14 23:49:12 --> Language Class Initialized
INFO - 2025-06-14 23:49:12 --> Language Class Initialized
INFO - 2025-06-14 23:49:12 --> Config Class Initialized
INFO - 2025-06-14 23:49:12 --> Loader Class Initialized
DEBUG - 2025-06-14 23:49:12 --> Config file loaded: C:\First\htdocs\Troops\application\config/biteship.php
INFO - 2025-06-14 23:49:12 --> Helper loaded: url_helper
INFO - 2025-06-14 23:49:12 --> Helper loaded: global_helper
INFO - 2025-06-14 23:49:12 --> Helper loaded: themes_helper
INFO - 2025-06-14 23:49:12 --> Helper loaded: session_helper
INFO - 2025-06-14 23:49:12 --> Database Driver Class Initialized
INFO - 2025-06-14 23:49:12 --> Session: Class initialized using 'files' driver.
INFO - 2025-06-14 23:49:12 --> Controller Class Initialized
