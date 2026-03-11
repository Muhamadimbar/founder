<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $team = [
            ['name' => 'Imbar', 'role' => 'CEO & Founder', 'photo' => null],
            ['name' => 'Dani Kusuma', 'role' => 'Lead Designer', 'photo' => null],
            ['name' => 'Peni', 'role' => 'Web Developer', 'photo' => null],
            ['name' => 'Adit Tianur', 'role' => 'IT Technician', 'photo' => null],
        ];

        $stats = [
            ['value' => '500+', 'label' => 'Klien Puas'],
            ['value' => '3+', 'label' => 'Tahun Pengalaman'],
            ['value' => '1000+', 'label' => 'Proyek Selesai'],
            ['value' => '24/7', 'label' => 'Support'],
        ];

        return view('about', compact('team', 'stats'));
    }
}
