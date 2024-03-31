<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    public function showFeedback($id)
    {
        $product = Product::findOrFail($id);
        $feedbacks = $product->feedbacks()->orderByDesc('created_at')->get();
        return view('feedback.show', compact('feedbacks', 'product'));
    }

    // public function index($product_id)
    // {
    //     $user = Auth::user();

    //     $feedback = Feedback::where('customer_id', $user->customer->id)
    //                         ->orderByDesc('created_at')
    //                         ->get();
    //     $sortedFeedback = Feedback::where('product_id', $product_id)
    //                                 ->orderByDesc('created_at')
    //                                 ->get();
    //     return view('feedback.index', compact('feedback', 'sortedFeedback'));
    // }

    public function create(Request $request, $id)
    {
        $product_id = $request->query('product_id');
        $product = Product::find($id);

        return view('feedback.create', compact('product'));
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
        return redirect()->route('feedback', ['product_id' => $request->product_id])->with('success', 'Feedback created successfully.');
    }

    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        if ($feedback->customer_id != Auth::user()->customer->id) {
            abort(403, 'Unauthorized action.');
        }
        return view('feedback.edit', compact('feedback'));
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        if ($feedback->customer_id != Auth::user()->customer->id) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'comments' => 'required|string',
            'img_path.*' => 'image|mimes:jpg,bmp,png|max:4080', // Adjust validation rules for images
        ]);

        $feedback->comments = $request->comments;
        if ($request->hasFile('img_path')) {
            $img_paths = [];
            foreach ($request->file('img_path') as $image) {
                $path = $image->store('public/images');
                $img_paths[] = str_replace('public/', 'storage/', $path);
            }
            $feedback->img_path = implode(',', $img_paths);
        }
        $feedback->save();
        return redirect()->route('feedback.index')->with('success', 'Feedback updated successfully.');
    }

    public function delete($id)
    {
        $feedback = Feedback::findOrFail($id);
        if ($feedback->customer_id != Auth::user()->customer->id) {
            abort(403, 'Unauthorized action.');
        }
        $feedback->delete();
        return redirect()->route('feedback.index')->with('success', 'Feedback deleted successfully.');
    }

    public function forceDelete($id)
    {
        $record = Feedback::find($id);

        if ($record) {
            $record->forceDelete();
            return redirect()->route('admin.feedback')->with('success', 'Record permanently deleted.');
        } else {
            return redirect()->route('admin.feedback')->with('error', 'Record not found.');
        }
    }
}
