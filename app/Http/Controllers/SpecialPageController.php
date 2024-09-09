<?php

namespace App\Http\Controllers;

use App\Models\LuckyResult;
use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SpecialPageController extends Controller
{
    public function show($link)
    {
        $linkRecord = Link::where('link', $link)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        Auth::loginUsingId($linkRecord->user_id);

        return view('special_page', ['link' => $linkRecord]);
    }

    public function generateNewLink($link)
    {
        $linkRecord = Link::where('link', $link)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        $newLink = Str::random(40);

        Link::create([
            'user_id' => $linkRecord->user_id,
            'link' => $newLink,
            'expires_at' => now()->addDays(7),
        ]);

        $linkRecord->expires_at = now(); // Установить время истечения как текущее
        $linkRecord->save();

        return redirect()->route('special_page', ['link' => $newLink])
            ->with('status', 'New link generated successfully!');
    }

    public function deactivateLink($link)
    {
        $linkRecord = Link::where('link', $link)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        $linkRecord->expires_at = now();
        $linkRecord->save();

        return redirect()->back()
            ->with('status', 'Link has been deactivated successfully!');
    }

    public function imFeelingLucky()
    {
        $randomNumber = rand(1, 1000);
        $result = $randomNumber % 2 === 0 ? 'Win' : 'Lose';
        $winAmount = $result === 'Win' ? $this->calculateWinAmount($randomNumber) : 0;

        LuckyResult::create([
            'user_id' => Auth::id(),
            'random_number' => $randomNumber,
            'result' => $result,
            'win_amount' => $winAmount,
        ]);

        return view('imfeelinglucky', [
            'randomNumber' => $randomNumber,
            'result' => $result,
            'winAmount' => $winAmount,
        ]);
    }

    public function showHistory()
    {
        $results = LuckyResult::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('history', ['results' => $results]);
    }

    private function calculateWinAmount($randomNumber)
    {
        if ($randomNumber > 900) {
            return $randomNumber * 0.70;
        } elseif ($randomNumber > 600) {
            return $randomNumber * 0.50;
        } elseif ($randomNumber > 300) {
            return $randomNumber * 0.30;
        } else {
            return $randomNumber * 0.10;
        }
    }
}
