<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .footer {
            background-color: white;
            color: #333;
            padding: 20px 0;
            bottom: 0;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .footer p {
            margin: 0;
        }

        .footer .social-media {
            margin-top: 10px;
        }

        .footer .social-media a {
            color: #333;
            margin: 0 10px;
            text-decoration: none;
            font-size: 1.5em;
            transition: color 0.3s;
        }

        .footer .social-media a:hover {
            color: red;
        }

        .footer .quick-links {
            margin-top: 10px;
        }

        .footer .quick-links a {
            color: #333;
            margin: 0 10px;
            text-decoration: none;
            position: relative;
        }

        .footer .quick-links a::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0;
            height: 2px;
            background-color: royalblue;
            transition: all 0.3s;
        }

        .footer .quick-links a:hover::after {
            background-color: red;
            left: 0;
            width: 100%;
        }

        .footer .footer-info {
            text-align: center;
        }
    </style>
</head>
<body>

    @yield('footer')
    <hr>
    <footer class="footer">
        <div class="footer-info">
            <p>&copy; 2024 Bioskop. All rights reserved.</p>
            <p>Alamat: Jl. Bioskop No. 123, Jakarta, Indonesia</p>
            <p>Kontak: +62 123 456 7890 | Email: info@bioskop.com</p>
            <div class="social-media">
                <a href="https://www.facebook.com" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="https://www.twitter.com" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
            <div class="quick-links">
                <a href="/about">Tentang Kami</a>
                <a href="/contact">Kontak</a>
                <a href="/privacy">Kebijakan Privasi</a>
                <a href="/terms">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>

    @yield('footer')
</body>
</html>
