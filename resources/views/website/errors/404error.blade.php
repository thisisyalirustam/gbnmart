@extends('website.layout.content');
@section('webcontent')
<style>
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f8f9fa;
    }

    .error-page {
      text-align: center;
      padding: 30px;
      border-radius: 10px;
      background: white;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
    }

    .error-page h1 {
      font-size: 150px;
      font-weight: bold;
      color: #343a40;
    }

    .error-page p {
      font-size: 1.2rem;
      color: #6c757d;
    }

    .error-page img {
      max-width: 200px;
      margin-bottom: 30px;
    }

    .btn-custom {
      background-color: #007bff;
      color: white;
      font-size: 1.1rem;
      padding: 10px 20px;
      border-radius: 30px;
      text-decoration: none;
    }

    .btn-custom:hover {
      background-color: #0056b3;
      text-decoration: none;
    }
  </style>
<div class="error-page">
<img src="https://via.placeholder.com/200" alt="404 Image">
<h1>404</h1>
<p>Oops! The page you're looking for cannot be found.</p>
<a href="/" class="btn-custom">Go Back Home</a>
</div>

<!-- Bootstrap 4 JS (Optional for some components) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
@endsection