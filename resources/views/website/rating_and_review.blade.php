@extends('website.layout.content')

@section('webcontent')
<style>
    .review-item {
        background-color: #f9f9f9;
        transition: transform 0.3s ease-in-out;
    }

    .review-item:hover {
        transform: translateY(-5px);
    }

    .star-rating {
        display: flex;
        direction: row-reverse;
    }

    .star-rating input {
        display: none;
    }

    .star {
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .star-rating input:checked ~ .star,
    .star:hover,
    .star:hover ~ .star {
        color: gold;
    }

    textarea {
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        padding: 10px;
        resize: vertical;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .form-group label {
        font-size: 16px;
        font-weight: bold;
    }
</style>

<div class="container py-5">
    <h1 class="text-center mb-4">Review Your Order</h1>

    <form action="{{ route('review.store', ['token' => $order->review_token]) }}" method="POST">
        @csrf
        @if ($orderItems && $orderItems->count() > 0)
            @foreach ($orderItems as $item)
                <div class="review-item mb-4 p-4 border rounded shadow-sm">
                    <h3 class="mb-3">{{ $item->product->name }}</h3>

                    <!-- Star Rating System -->
                    <div class="form-group">
                        <label class="font-weight-bold">Rating:</label>
                        <div class="star-rating">
                            <input type="radio" id="star5_{{ $item->id }}" name="rating[{{ $item->id }}]" value="5" required />
                            <label for="star5_{{ $item->id }}" class="star">&#9733;</label>
                            <input type="radio" id="star4_{{ $item->id }}" name="rating[{{ $item->id }}]" value="4" />
                            <label for="star4_{{ $item->id }}" class="star">&#9733;</label>
                            <input type="radio" id="star3_{{ $item->id }}" name="rating[{{ $item->id }}]" value="3" />
                            <label for="star3_{{ $item->id }}" class="star">&#9733;</label>
                            <input type="radio" id="star2_{{ $item->id }}" name="rating[{{ $item->id }}]" value="2" />
                            <label for="star2_{{ $item->id }}" class="star">&#9733;</label>
                            <input type="radio" id="star1_{{ $item->id }}" name="rating[{{ $item->id }}]" value="1" />
                            <label for="star1_{{ $item->id }}" class="star">&#9733;</label>
                        </div>
                    </div>

                    <!-- Review Text Area -->
                    <div class="form-group">
                        <label for="review_{{ $item->id }}" class="font-weight-bold">Review (optional):</label>
                        <textarea name="review[{{ $item->id }}]" id="review_{{ $item->id }}" rows="4" class="form-control" placeholder="Write your review here..." required></textarea>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit Review</button>
        @else
            <p class="text-center">No items found in this order.</p>
        @endif
    </form>
</div>
@endsection




