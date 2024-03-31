<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::withTrashed()->orderBy('id')->get();
        return view('faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('faqs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'img_path.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $faq = new Faq;
        $faq->category = $validatedData['category'];
        $faq->question = $validatedData['question'];
        $faq->answer = $validatedData['answer'];

        if ($request->hasFile('img_path')) {
            $newImagePaths = [];
            foreach ($request->file('img_path') as $image) {
                $imagePath = $image->store('public/images');
                $newImagePaths[] = str_replace('public/', 'storage/', $imagePath);
            }
        }

        $faq->img_path = implode(',', $newImagePaths);

        $faq->save();

        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully!');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('faqs.edit', compact('faq'));
    }

    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'category' => 'required',
    //         'question' => 'required',
    //         'answer' => 'required',
    //         'img_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $faq = Faq::findOrFail($id);
    //     $faq->category = $validatedData['category'];
    //     $faq->question = $validatedData['question'];
    //     $faq->answer = $validatedData['answer'];

    //     if ($request->hasFile('img_path')) {
    //                 $newImagePaths = [];
    //                 foreach ($request->file('img_path') as $file) {
    //                     $path = $file->store('public/images');
    //                     $newImagePaths[] = str_replace('public/', 'storage/', $path);
    //                 }
    //                 $faq->img_path = implode(',', $newImagePaths);
    //             }
    //     $faq->save();

    //     return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully!');
    // }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'img_path.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->category = $validatedData['category'];
        $faq->question = $validatedData['question'];
        $faq->answer = $validatedData['answer'];

        if ($request->hasFile('img_path')) {
                    $newImagePaths = [];
                    foreach ($request->file('img_path') as $file) {
                        $path = $file->store('public/images');
                        $newImagePaths[] = str_replace('public/', 'storage/', $path);
                    }
                    $faq->img_path = implode(',', $newImagePaths);
                }
        $faq->save();

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully!');
    }


    public function destroy($id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully!');
    }

    public function restore($id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        $faq->restore();

        return redirect()->route('faqs.index')->with('success', 'FAQ restored successfully!');
    }

    public function index1()
    {
        $faqs = Faq::all();
        return view('contact.faqwel', compact('faqs'));
    }
}
