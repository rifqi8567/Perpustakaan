@extends('layouts.mazer')

@section('page-heading', 'Grafik User')
@section('content')

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Grafik Pengunjung</h4>
        </div>
        <div class="card-body">
            @php
                $labels = $visitors->pluck('date'); // Mengambil tanggal
                $data = $visitors->pluck('total_visitors'); // Mengambil total pengunjung
            @endphp

            <!-- Tempat untuk menampilkan grafik -->
            <div class="chart-container" style="position: relative; width:100%; height:70vh;">
                <canvas id="visitorBarChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Tambahkan pustaka Chart.js -->
            <script>
                const visitorLabels = @json($labels); // Mengirim data tanggal ke JavaScript
                const visitorData = @json($data); // Mengirim data jumlah pengunjung ke JavaScript

                window.onload = function () {
                    var ctx = document.getElementById('visitorBarChart').getContext('2d');

                    // Membuat grafik batang
                    var visitorBarChart = new Chart(ctx, {
                        type: 'bar', // Jenis grafik: batang
                        data: {
                            labels: visitorLabels, // Data label (tanggal)
                            datasets: [{
                                label: 'Total Visitors', // Label grafik
                                data: visitorData, // Data jumlah pengunjung
                                backgroundColor: [
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)'
                                ],
                                borderWidth: 1 // Ketebalan garis tepi batang
                            }]
                        },
                        options: {
                            responsive: true, // Grafik akan menyesuaikan ukuran layar
                            maintainAspectRatio: false, // Memastikan grafik tidak terdistorsi
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                },
                                title: {
                                    display: true,
                                    text: 'Grafik Jumlah Pengunjung Harian'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true, // Mulai dari nol
                                    title: {
                                        display: true,
                                        text: 'Jumlah Pengunjung' // Judul sumbu Y
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Tanggal' // Judul sumbu X
                                    }
                                }
                            }
                        }
                    });
                };
            </script>
        </div>
    </div>
</div>
@endsection
