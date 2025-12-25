# WooCommerce Video Gallery Enhancer

**WooCommerce Video Gallery Enhancer** allows you to seamlessly integrate video content into your WooCommerce product galleries. Replace or supplement static images with YouTube or self-hosted videos to increase conversion rates and customer engagement by giving users a dynamic view of your products.

---

## 🚀 Features

* **Multi-Platform Support:** Add videos from YouTube or upload your own (MP4) directly via the WordPress Media Library.
* **Precise Position Control:** Use the "Display Position" setting to decide exactly where the video appears in the thumbnail strip (e.g., first, middle, or last).
* **Divi Compatible:** Fully compatible with the **Divi Product Image Module** settings and layout.
* **Seamless Integration:** Hooks into the native WooCommerce gallery filters to ensure compatibility with most themes.
* **Automatic Thumbnails:** Automatically fetches YouTube cover images or uses the video's metadata for local files.
* **Lightbox Playback:** Includes built-in support for **Magnific Popup**, allowing videos to play in a beautiful, responsive overlay.
* **Lightweight:** Optimized to load assets only when necessary, keeping your site fast.

---

## 📸 Screenshots

### Product Page View
![Product Page View](https://github.com/AnkushShingari/WooCommerce-Video-Gallery-Enhancer/blob/main/plugin-screenshots/WooCommerce-Video-Gallery-Enhancer-screenshot-frontend-product-page-view.png?raw=true)

*The video icon appears over the gallery thumbnail to indicate playable content.*


### Backend Settings
![Backend Settings](https://raw.githubusercontent.com/AnkushShingari/WooCommerce-Video-Gallery-Enhancer/afc6b7ad69a840ff31d8458934e51fdcc226a4da/plugin-screenshots/WooCommerce-Video-Gallery-Enhancer-screenshot-backend-settings-tab.png)

*Initial setup tab in the product editor sidebar.*


![Backend Settings Filled](https://github.com/AnkushShingari/WooCommerce-Video-Gallery-Enhancer/blob/main/plugin-screenshots/WooCommerce-Video-Gallery-Enhancer-screenshot-backend-settings-tab-filled.png?raw=true)

*Example of a filled YouTube URL and position control.*

### Divi Compatibility
![Backend Settings Compatible With Divi](https://github.com/AnkushShingari/WooCommerce-Video-Gallery-Enhancer/blob/main/plugin-screenshots/WooCommerce-Video-Gallery-Enhancer-screenshot-backend-compatible-with-divi.png?raw=true)

*Seamlessly works with Divi's Product Image module settings.*

---

## 🛠 Installation

### Via WordPress Dashboard
1.  **Download** the plugin repository as a `.zip` file.
2.  Go to your **WordPress Dashboard** -> **Plugins** -> **Add New**.
3.  Click **Upload Plugin** and select the downloaded `.zip` file.
4.  Click **Install Now** and then **Activate**.

### Via FTP/SFTP
1.  **Extract** the `woocommerce-video-gallery-enhancer` folder from the downloaded `.zip` file.
2.  Connect to your server using an FTP client (like FileZilla or WinSCP).
3.  Navigate to the `/wp-content/plugins/` directory.
4.  **Upload** the entire `woocommerce-video-gallery-enhancer` folder to that directory.
5.  Go to **WordPress Dashboard** -> **Plugins** and click **Activate** next to the plugin name.

---

## ⚙️ Configuration

To add a video to a product:

1.  **Edit** a Product.
2.  Locate the **Product Video Gallery** meta box on the right-hand sidebar.
3.  **Input URL:** Paste a YouTube link or click the **Upload icon** (dashicon) to select a video from your Media Library.
4.  **Set Position:** Enter a number (e.g., "1" to make it the first thumbnail) to define where the video appears.
5.  **Save/Update** the product.

---

## 💻 Technical Details

The plugin utilizes the `woocommerce_single_product_image_thumbnail_html` filter to inject the video container and enqueues **Magnific Popup** for high-performance lightbox rendering.

### Requirements:
* **PHP:** 7.4 or higher
* **WordPress:** 6.0+
* **WooCommerce:** 7.0+

---

## 🤝 Contributing

Contributions make the open-source community an amazing place to learn and create.

1.  Fork the Project.
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`).
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`).
4.  Push to the Branch (`git push origin feature/AmazingFeature`).
5.  Open a Pull Request.

---

## 👤 Author

**AnkushShingari**
* GitHub: [@AnkushShingari](https://github.com/AnkushShingari)

## 📄 License

This project is an open-source tool created and updated by the author. It is provided "as-is" for the community to use and improve.
