<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\CreateCarouselErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCarouselRequest;
use App\Models\Carousel;
use App\Repositories\CarouselRepository;
use Illuminate\Http\UploadedFile;

class CarouselController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        return view('admin.carousels.create');
    }

    /**
     * @param CreateCarouselRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws CreateCarouselErrorException
     */
    public function store(CreateCarouselRequest $request)
    {
        try {
            $data = $request->except('_token');
            if ($request->hasFile('image') && $request->file('image') instanceof UploadedFile) {
                $data['src'] = $request->file('image')->store('carousels', ['disk' => 'public']);
            }

            $carouselRepo = new CarouselRepository(new Carousel);
            $carouselRepo->createCarousel($data);

            $request->session()->flash('message', 'Create carousel successful!');

            return redirect()->route('admin.carousel.index');
        } catch (CreateCarouselErrorException $e) {
            $request->session()->flash('error', $e->getMessage());

            return redirect()->back()->withInput();
        }
    }
}
