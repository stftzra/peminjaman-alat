@extends('layouts.dashboard')

@section('content')
<div class="p-8">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Test Page</h1>
        <p class="text-gray-600">This is a test page to verify routing is working.</p>
        
        <div class="mt-6">
            <a href="{{ route('petugas.pengembalian.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Back to Pengembalian Index
            </a>
        </div>
    </div>
</div>
@endsection
