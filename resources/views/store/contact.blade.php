@extends('layouts.store')

@section('content')
<div class="bg-gradient-to-br from-indigo-50 to-white py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-center text-indigo-800 mb-10">📬 Hubungi Kami</h1>

        <p class="text-center text-gray-600 max-w-xl mx-auto mb-12">
            Ada pertanyaan, kritik, saran, atau ingin memesan novel? Tim kami siap membantu kamu dengan cepat dan ramah.
        </p>

        <div class="flex flex-col md:flex-row items-center justify-center gap-8 max-w-4xl mx-auto text-indigo-800">
            <!-- WhatsApp -->
            <div class="bg-white border border-indigo-200 rounded-xl shadow p-6 w-full md:w-1/3 text-center hover:shadow-md transition">
                <div class="text-3xl mb-2">📞</div>
                <h2 class="font-bold text-lg mb-1">WhatsApp</h2>
                <a href="https://wa.me/628123456789" class="text-indigo-600 hover:underline block">
                    +62 812 3456 789
                </a>
            </div>

            <!-- Email -->
            <div class="bg-white border border-indigo-200 rounded-xl shadow p-6 w-full md:w-1/3 text-center hover:shadow-md transition">
                <div class="text-3xl mb-2">📧</div>
                <h2 class="font-bold text-lg mb-1">Email</h2>
                <a href="mailto:novelita@email.com" class="text-indigo-600 hover:underline block">
                    novelita@email.com
                </a>
            </div>

            <!-- Lokasi -->
            <div class="bg-white border border-indigo-200 rounded-xl shadow p-6 w-full md:w-1/3 text-center hover:shadow-md transition">
                <div class="text-3xl mb-2">📍</div>
                <h2 class="font-bold text-lg mb-1">Alamat</h2>
                <p class="text-gray-600">Jl. Literasi No. 42, Jakarta</p>
            </div>
        </div>
    </div>
</div>
@endsection