add_action('wp_footer', function () {
    ?>
    <!-- Jengu Preloader -->
    <div id="jengu-loader">
        <img src="https://jenguonline.com/wp-content/uploads/2025/06/jengu-logo.png" alt="Jengu Logo" class="jengu-logo">
        <div class="loading-dots">
            <span></span><span></span><span></span>
        </div>
    </div>
    <style>
        #jengu-loader {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: #131111;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 99999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }
        .jengu-logo {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
        }
        .loading-dots {
            display: flex;
            gap: 10px;
        }
        .loading-dots span {
            width: 10px;
            height: 10px;
            background: #00D6B2;
            border-radius: 50%;
            animation: loading 1.5s infinite ease-in-out;
        }
        .loading-dots span:nth-child(1) { animation-delay: 0s; }
        .loading-dots span:nth-child(2) { animation-delay: 0.2s; }
        .loading-dots span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes loading {
            0%, 100% { transform: scale(1); opacity: 0.6; }
            50% { transform: scale(1.5); opacity: 1; }
        }
        #jengu-loader.hidden {
            opacity: 0;
            visibility: hidden;
        }
    </style>
    <script>
        window.addEventListener("load", function () {
            const loader = document.getElementById("jengu-loader");
            if (loader) loader.classList.add("hidden");
        });
    </script>
    <?php
});
