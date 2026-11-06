<?php

namespace App\Http\Controllers;

use App\Models\Pertunjukan;
use App\Models\Booking;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
{
    $keyword = $request->input('keyword');

    $shows = Pertunjukan::query()
        ->when($keyword, function ($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('location', 'LIKE', "%{$keyword}%");
            });
        })
        ->get();

    return view('frontpage.landingpage', compact('shows', 'keyword'));
}

    public function schedule()
    {
        $shows = Pertunjukan::all();

        return view('frontpage.schedule', compact('shows'));
    }

    public function detail($id)
    {
        $show = Pertunjukan::findOrFail($id);

        return view('frontpage.detail', compact('show'));
    }

    public function booking($id)
    {
        $show = Pertunjukan::findOrFail($id);

        return view('frontpage.booking', compact('show'));
    }

   
public function storeBooking(Request $request, $id)
{
    $show = Pertunjukan::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:150',
        'category' => 'required|in:domestic,foreign',
        'quantity' => 'required|integer|min:1|max:10',
    ]);

    // Tentukan harga sesuai kategori tiket
    $price = $validated['category'] === 'domestic'
        ? $show->price_domestic
        : $show->price_foreign;

    // Hitung total pembayaran
    $total = $price * $validated['quantity'];

    // Simpan booking ke database
    $savedBooking = Booking::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'pertunjukan_id' => $show->id,
        'ticket_category' => $validated['category'],
        'quantity' => $validated['quantity'],
        'ticket_price' => $price,
        'total_price' => $total,
    ]);

    // Data untuk ditampilkan pada halaman konfirmasi
    $booking = $validated;

    return view('frontpage.confirmation', compact(
        'show',
        'booking',
        'price',
        'total',
        'savedBooking'
    ));
}


    public function about()
    {
        return view('frontpage.about');
    }

    public function products()
    {
        return redirect()->route('schedule');
    }

    public function contact()
    {
        return view('frontpage.contact');
    }
}
