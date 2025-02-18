<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>404 - Page Not Found</title>
  <!-- Bootstrap 4 CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Animate.css for animations -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
    }

    .error-page {
      text-align: center;
      padding: 40px;
      border-radius: 15px;
      background: white;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
      animation: fadeIn 1s ease-in-out;
    }

    .error-page h1 {
      font-size: 150px;
      font-weight: bold;
      color: #343a40;
      margin-bottom: 20px;
      animation: bounce 1.5s infinite;
    }

    .error-page p {
      font-size: 1.2rem;
      color: #6c757d;
      margin-bottom: 30px;
    }

    .error-page img {
      max-width: 200px;
      margin-bottom: 30px;
      animation: float 3s ease-in-out infinite;
    }

    .btn-custom {
      background-color: #007bff;
      color: white;
      font-size: 1.1rem;
      padding: 10px 20px;
      border-radius: 30px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #0056b3;
      text-decoration: none;
    }

    .additional-links {
      margin-top: 20px;
    }

    .additional-links a {
      color: #007bff;
      text-decoration: none;
      margin: 0 10px;
      transition: color 0.3s ease;
    }

    .additional-links a:hover {
      color: #0056b3;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
      40% { transform: translateY(-30px); }
      60% { transform: translateY(-15px); }
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-20px); }
    }
  </style>
</head>
<body>

  <div class="error-page">
    <img src="{{asset('errors/404/pngtree-error-404-under-construction-sign-3d-icon-website-banner-concept-png-image_7382633.png')}}" alt="404 Image" class="animate__animated animate__fadeIn">
    <h1 class="animate__animated animate__bounce">404</h1>
    <p>Oops! The page you're looking for cannot be found.</p>
    <a href="/" class="btn-custom">Go Back Home</a>
    <div class="additional-links">
      <a href="/about">About Us</a>
      <a href="/contact">Contact Us</a>
      <a href="/support">Support</a>
    </div>
  </div>

  <!-- Bootstrap 4 JS (Optional for some components) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>