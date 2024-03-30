<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    // public function index()
    // {
    //     $user = Auth::user();

    //     $feedback = Feedback::where('customer_id', $user->customer->id)
    //                         ->orderByDesc('created_at')
    //                         ->get();
    //     $allFeedback = Feedback::orderByDesc('created_at')->get();
    //     $filteredFeedback = $allFeedback->filter(function ($item) use ($user) {
    //         return $item->customer_id == $user->customer->id;
    //     });

    //     return view('feedback.index', compact('feedback', 'filteredFeedback', 'allFeedback'));
    // }

    public function showFeedback($id)
    {
        $product = Product::findOrFail($id);
        $feedbacks = $product->feedbacks()->orderByDesc('created_at')->get();

        // dd($feedbacks);

        return view('feedback.show', compact('feedbacks', 'product'));
    }

    public function index()
    {
        $user = Auth::user();

        $feedback = Feedback::where('customer_id', $user->customer->id)
                            ->orderByDesc('created_at')
                            ->get();

        $allFeedback = Feedback::orderByDesc('created_at')->get();

        // Prioritize feedback of the currently logged-in customer
        $priorityFeedback = $allFeedback->filter(function ($item) use ($user) {
            return $item->customer_id == $user->customer->id;
        });

        $otherFeedback = $allFeedback->diff($priorityFeedback);

        // Merge the prioritized feedback with the rest
        $sortedFeedback = $priorityFeedback->merge($otherFeedback);

        return view('feedback.index', compact('feedback', 'sortedFeedback'));
    }

    public function create(Request $request)
    {
        $products = Product::all();
        $product_id = $request->query('product_id');
        $product = Product::find($product_id);

        return view('feedback.create', compact('product', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comments' => 'required|string',
            'img_path.*' => 'required|image|mimes:jpg,bmp,png|max:2048',
        ]);

        $user = Auth::user();
        $feedback = new Feedback();
        $feedback->comments = $request->comments;
        $feedback->customer_id = $user->customer->id;
        $feedback->product_id = $request->product_id;

        $img_paths = [];
        if ($request->hasFile('img_path')) {
            foreach ($request->file('img_path') as $image) {
                $path = $image->store('public/images');
                $img_paths[] = str_replace('public/', 'storage/', $path);
            }
            $feedback->img_path = implode(',', $img_paths);
        }
        $feedback->save();
        return redirect()->route('review.index')->with('success', 'Feedback created successfully.');
    }

    public function edit($id)
    {
        // Find the feedback by its ID
        $feedback = Feedback::findOrFail($id);

        // Check if the logged-in user owns this feedback
        if ($feedback->customer_id != Auth::user()->customer->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('feedback.edit', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        // Find the feedback by its ID
        $feedback = Feedback::findOrFail($id);

        // Check if the logged-in user owns this feedback
        if ($feedback->customer_id != Auth::user()->customer->id) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request data
        $request->validate([
            'comments' => 'required|string',
            'img_path.*' => 'image|mimes:jpg,bmp,png|max:4080', // Adjust validation rules for images
        ]);

        // Update the feedback's comments
        $feedback->comments = $request->comments;

        // Handle image update
        if ($request->hasFile('img_path')) {
            $img_paths = [];
            foreach ($request->file('img_path') as $image) {
                $path = $image->store('public/images');
                $img_paths[] = str_replace('public/', 'storage/', $path);
            }
            // Combine new image paths with existing ones
            // $existing_paths = explode(',', $feedback->img_path);
            // $updated_paths = array_merge($existing_paths, $img_paths);
            $feedback->img_path = implode(',', $img_paths);
        }

        // Save the updated feedback
        $feedback->save();

        return redirect()->route('review.index')->with('success', 'Feedback updated successfully.');
    }

    public function delete($id)
    {
        $feedback = Feedback::findOrFail($id);
        if ($feedback->customer_id != Auth::user()->customer->id) {
            abort(403, 'Unauthorized action.');
        }
        $feedback->delete();
        return redirect()->route('review.index')->with('success', 'Feedback deleted successfully.');
    }
}
