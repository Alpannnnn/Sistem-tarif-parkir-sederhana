</main> <style>
            /* Reset dasar agar tidak ada margin aneh */
            html, body {
                height: 100%;
                margin: 0;
            }
            /* Body sebagai kontainer utama vertikal */
            body {
                display: flex;
                flex-direction: column;
            }
            /* Paksa konten di atas footer untuk mengambil sisa ruang */
            /* Ini yang menjamin footer terdorong ke paling bawah */
            main {
                flex: 1 0 auto;
                width: 100%; /* Menjamin form tidak mengecil */
            }
            /* Footer tetap di bawah */
            footer {
                flex-shrink: 0;
                width: 100%;
            }
        </style>

        <footer class="bg-white border-t mt-16">
            <div class="max-w-7xl mx-auto px-6 py-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-5">

                    <div class="flex items-center gap-3">
                        <div class="bg-blue-600 text-white font-bold rounded-lg px-3 py-1 text-lg">
                            🅿️
                        </div>
                        <div class="text-left">
                            <h2 class="text-lg font-semibold text-gray-800">
                                Sistem Parkir
                            </h2>
                            <p class="text-sm text-gray-500">
                                Manajemen parkir modern & efisien
                            </p>
                        </div>
                    </div>

                    <div class="text-center md:text-right text-sm text-gray-500">
                        <p>
                            © <?= date('Y'); ?> Sistem Parkir
                        </p>
                        <p class="text-xs">
                            All Rights Reserved
                        </p>
                    </div>

                </div>

                <div class="border-t mt-4 pt-4 text-center text-xs text-gray-400">
                    Sistem Parkir — Dibuat untuk kebutuhan akademik & implementasi aplikasi web
                </div>
            </div>
        </footer>

    </body>
</html>