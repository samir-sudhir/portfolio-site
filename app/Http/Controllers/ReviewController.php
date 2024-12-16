<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Helpers\Helper;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // List all reviews
    public function index()
    {
        $reviews = Review::all();
        return Helper::result('Reviews retrieved successfully', 200, $reviews);
    }

    // Show a specific review
    public function show(Review $review)
    {
        return Helper::result('Review retrieved successfully', 200, $review);
    }

    // Create a new review
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required',
            'customer_name' => 'required|string|max:255',
        ]);

        $review = Review::create($validated);

        return Helper::result('Review created successfully', 201, $review);
    }

    // Update an existing review
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required',
            'customer_name' => 'required|string|max:255',
        ]);

        $review->update($validated);

        return Helper::result('Review updated successfully', 200, $review);
    }

    // Delete a review
    public function destroy(Review $review)
    {
        $review->delete();
        return Helper::result('Review deleted successfully', 200);
    }
}
