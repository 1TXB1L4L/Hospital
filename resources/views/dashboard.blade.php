@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white p-4 shadow-md rounded-md">
            <h1 class="text-xl font-bold text-gray-800">Most Used Medicines</h1>
            <canvas id="most-used-medicines"></canvas>
        </div>
    </div>
    <!-- axios -->
    <scripts src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></scripts>
@endsection
@push('scripts')
    let mostUsedMedicines = document.getElementById('most-used-medicines').getContext('2d');
    let mumApi = window.location.origin + '/api/dashboard/most-used-medicines';
    function getMostUsedMedicines() {
        axios.get(mumApi)
            .then(response => {
                console.log(response.data);
            })
            .catch(error => {
                console.error(error);
            });
    }
    console.log(getMostUsedMedicines());
    console.log('Dashboard');
@endpush
