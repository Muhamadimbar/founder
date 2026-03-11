<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@sib.com',
            'password' => Hash::make('admin1234'),
            'role'     => 'admin',
        ]);
        // Create Services
        $services = [
            [
                'name'        => 'Desain Grafis',
                'description' => 'Kami menyediakan layanan desain grafis profesional untuk kebutuhan bisnis Anda, mulai dari logo, banner, poster, flyer, konten media sosial, hingga identitas brand yang kuat dan berkesan. Tim desainer berpengalaman kami siap mewujudkan visi kreatif Anda dengan hasil berkualitas tinggi.',
                'price'       => 'Mulai Rp 150.000',
                'icon'        => 'palette',
            ],
            [
                'name'        => 'Perbaikan Laptop',
                'description' => 'Layanan perbaikan laptop dan komputer dengan teknisi berpengalaman dan bergaransi. Menangani berbagai masalah seperti kerusakan hardware, virus, instalasi sistem operasi, upgrade RAM & SSD, hingga penggantian layar dan keyboard. Cepat, tepat, dan terpercaya.',
                'price'       => 'Mulai Rp 75.000',
                'icon'        => 'laptop',
            ],
            [
                'name'        => 'Joki Tugas',
                'description' => 'Bantuan pengerjaan tugas akademik, makalah, skripsi, laporan, presentasi, dan berbagai kebutuhan akademis lainnya. Dikerjakan oleh tenaga ahli di bidangnya dengan kualitas terjamin, tepat waktu, dan original. Mendukung berbagai format dan standar penulisan ilmiah.',
                'price'       => 'Mulai Rp 50.000',
                'icon'        => 'book-open',
            ],
            [
                'name'        => 'Pembuatan Website UMKM',
                'description' => 'Wujudkan kehadiran digital bisnis UMKM Anda dengan website profesional yang modern, responsif, dan mudah dikelola. Kami menyediakan desain custom, integrasi toko online, sistem manajemen konten, dan optimasi SEO untuk memaksimalkan visibilitas bisnis Anda di internet.',
                'price'       => 'Mulai Rp 500.000',
                'icon'        => 'globe',
            ],
        ];
        foreach ($services as $service) {
            Service::create(array_merge($service, [
                'slug'      => Str::slug($service['name']),
                'is_active' => true,
            ]));
        }
        // Create testimonials
        $testimonials = [
            [
                'name'    => 'budi santoso',
                'role'    => 'pemilik usaha',
                'message' => 'Layanan desain grafis dari SIB sangat memuaskan! Desain logo dan banner yang mereka buat benar-benar sesuai dengan visi bisnis saya. Timnya sangat profesional dan responsif, selalu siap membantu dengan ide-ide kreatif. Hasilnya berkualitas tinggi dan membuat brand saya semakin menonjol di pasar. Saya sangat merekomendasikan SIB untuk kebutuhan desain grafis Anda!',
                'rating'  => 5,
            ],
            [
                'name'    => 'siti nurhaliza',
                'role'    => 'mahasiswa',
                'message' => 'Saya sangat puas dengan layanan joki tugas dari SIB. Mereka membantu saya menyelesaikan tugas akademik dengan kualitas tinggi dan tepat waktu. Timnya sangat profesional dan membantu saya memahami konsep yang sulit. Saya sangat merekomendasikan SIB untuk kebutuhan joki tugas Anda!',
                'rating'  => 5,
            ],
            [
                'name'    => 'ahmad fauzi',
                'role'    => 'pemilik usaha',
                'message' => 'Layanan pembuatan website UMKM dari SIB sangat memuaskan! Mereka membantu saya membuat website yang profesional, responsif, dan mudah dikelola. Timnya sangat kreatif dan membantu saya mengoptimalkan SEO untuk meningkatkan visibilitas bisnis saya di internet. Saya sangat merekomendasikan SIB untuk kebutuhan pembuatan website UMKM Anda!',
                'rating'  => 5,
            ],
            [
                'name'    => 'lina wijaya',
                'role'    => 'pelanggan',
                'message' => 'Layanan perbaikan laptop dari SIB sangat memuaskan! Teknisi mereka sangat berpengalaman dan cepat dalam menangani masalah laptop saya. Mereka berhasil memperbaiki kerusakan hardware dan menginstal sistem operasi baru dengan hasil yang sangat baik. Saya sangat merekomendasikan SIB untuk kebutuhan perbaikan laptop Anda!',
                'rating'  => 5,
            ],
            [
                'name'    => 'dedi kurniawan',
                'role'    => 'pelanggan',
                'message' => 'Saya sangat puas dengan layanan desain grafis dari SIB. Mereka membantu saya membuat desain logo dan banner yang sangat kreatif dan sesuai dengan visi bisnis saya. Timnya sangat profesional dan responsif, selalu siap membantu dengan ide-ide kreatif. Hasilnya berkualitas tinggi dan membuat brand saya semakin menonjol di pasar. Saya sangat merekomendasikan SIB untuk kebutuhan desain grafis Anda!',
                'rating'  => 5,
            ],
            [
                'name'    => 'sari putri',
                'role'    => 'mahasiswa',
                'message' => 'Layanan joki tugas dari SIB sangat membantu saya menyelesaikan tugas akademik dengan kualitas tinggi dan tepat waktu. Timnya sangat profesional dan membantu saya memahami konsep yang sulit. Saya sangat merekomendasikan SIB untuk kebutuhan joki tugas Anda!',
                'rating'  => 5,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create(array_merge($testimonial, [
                'is_active' => true,
            ]));
        }
    }
}