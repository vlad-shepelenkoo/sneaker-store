<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slide;
use App\Services\Admin\SliderService;

class SlideController extends Controller
{
    public function __construct(private SliderService $sliderService)
    {
    }

    public function slides(){
        $slides = Slide::sortBy('id', 'DESC')->paginate(12);
        return view('admin.slides', compact('slides'));
    }

    public function slide_add(){
        return view('admin.slide-add');
    }

    public function slide_store(SliderRequest $request){
        $this->sliderService->store($request->validated());
        return redirect()->route('admin.slides')->with('status', 'Slide added successfully');
    }

    public function slide_edit($id){
        $slide = Slide::find($id);
        return view('admin.slide-edit', compact('slide'));
    }

    public function slide_update(SliderRequest $request){
        $slide = Slide::find($request->id);
        $this->sliderService->update($request->validated(), $slide);
        return redirect()->route('admin.slides')->with('status', 'Slide has been updated successfully');
    }

    public function slide_delete($id){
        $this->sliderService->delete($id);
        return redirect()->route('admin.slides')->with('status', 'Slide deleted successfully!');
    }
}