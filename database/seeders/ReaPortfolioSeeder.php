<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Event;
use App\Models\Resource;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReaPortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds for REA (Resources, Events, Agents) model.
     */
    public function run(): void
    {
        // ----------------------------------------------------
        // 1. AGENTS (Economic Agents)
        // ----------------------------------------------------

        // Internal Agent: Portfolio Owner
        $owner = Agent::updateOrCreate(
            ['email' => 'gofranmuttaqi@gmail.com'],
            [
                'name' => 'Gofran Muttaqi Likhan',
                'type' => 'internal',
                'role' => 'Mahasiswa Informatika & IoT/AI Developer',
                'company_name' => 'ITB PalComTech',
                'phone' => '+6285669548964',
                'avatar' => '/gofran-profile.png',
                'website' => 'https://palcomtech.ac.id/',
                'metadata' => [
                    'gpa' => '3.95',
                    'max_gpa' => '4.00',
                    'semester' => 5,
                    'major' => 'Informatika',
                    'institution' => 'Institut Teknologi dan Bisnis PalComTech, Palembang',
                    'location' => 'Palembang, Indonesia',
                    'status_badge' => 'Tersedia untuk bekerjasama',
                    'headline' => 'Halo Semua, Saya Gofran Muttaqi Likhan',
                    'subheadline' => 'Mahasiswa Informatika dengan latar belakang lintas bidang: administrasi, penjualan, layanan pelanggan, dan dukungan jaringan. Saat ini fokus membangun proyek berbasis IoT dan AI untuk menjawab masalah nyata di sekitar.',
                    'about_title' => 'Lintas bidang, satu cara berpikir: amati, catat, perbaiki.',
                    'about_description' => 'Saya mahasiswa Informatika dengan pengalaman lintas bidang — administrasi, pengolahan data, operasional, penjualan, serta pelayanan pelanggan. Terbiasa bekerja secara individu maupun dalam tim, dan belakangan aktif mengeksplorasi teknologi AI dan IoT untuk menyelesaikan masalah yang saya temui langsung di lapangan, mulai dari kualitas udara di transportasi umum hingga proses penjualan kendaraan.',
                    'domains' => [
                        'Administrasi & pelaporan',
                        'Penjualan & layanan pelanggan',
                        'Jaringan komputer',
                        'IoT & AI',
                    ],
                    'highlights' => [
                        ['title' => 'Technical Support', 'caption' => 'Network · Hardware · Software'],
                        ['title' => 'Networking', 'caption' => 'MikroTik · Cisco · Infrastruktur'],
                        ['title' => 'Administrasi', 'caption' => 'Excel · Data · Pelaporan'],
                        ['title' => 'Operasional', 'caption' => 'Koordinasi · Maintenance'],
                        ['title' => 'Teknologi', 'caption' => 'IoT · AI · Python'],
                    ],
                    'contact_channels' => [
                        [
                            'icon' => 'whatsapp',
                            'label' => 'WhatsApp',
                            'href' => 'https://wa.me/6285669548964?text=Halo%21%20saya%20ingin%20bekerja%20sama%20dengan%20anda',
                            'primary' => true,
                        ],
                        [
                            'icon' => 'email',
                            'label' => 'Email',
                            'href' => 'mailto:gofranmuttaqi@gmail.com?subject=Peluang%20Bekerjasama%20%2F%20Kolaborasi&body=Halo%20Gofran%2C%0A%0ASaya%20ingin%20membahas%20peluang%20bekerjasama%20atau%20kolaborasi%20dengan%20Anda.%0A%0ATerima%20kasih.',
                            'primary' => false,
                        ],
                        [
                            'icon' => 'linkedin',
                            'label' => 'LinkedIn',
                            'href' => 'https://www.linkedin.com/in/gofran-ml',
                            'primary' => false,
                        ],
                    ],
                ],
            ]
        );

        // External Agents: Companies & Organizations
        $agentBangka = Agent::firstOrCreate(
            ['company_name' => 'PT. Bangka Cakra Karya, Palembang'],
            [
                'name' => 'PT. Bangka Cakra Karya',
                'type' => 'organization',
                'role' => 'Perusahaan Rental Alat Berat & Konstruksi',
                'website' => null,
            ]
        );

        $agentToyota = Agent::firstOrCreate(
            ['company_name' => 'Toyota Tunas Auto Graha, Palembang'],
            [
                'name' => 'Toyota Tunas Auto Graha',
                'type' => 'organization',
                'role' => 'Dealer Resmi Toyota',
                'website' => 'https://toyotatag.com',
            ]
        );

        $agentUmak = Agent::firstOrCreate(
            ['company_name' => 'Kedai Kopi Umak, Palembang'],
            [
                'name' => 'Kedai Kopi Umak',
                'type' => 'organization',
                'role' => 'F&B Enterprise',
                'website' => null,
            ]
        );

        $agentHonda = Agent::firstOrCreate(
            ['company_name' => 'Honda Maju Motor Group, Palembang'],
            [
                'name' => 'Honda Maju Motor Group',
                'type' => 'organization',
                'role' => 'Dealer Resmi Honda Mobil',
                'website' => null,
            ]
        );

        $agentSekda = Agent::firstOrCreate(
            ['company_name' => 'Sekretariat Daerah Kota Palembang'],
            [
                'name' => 'Sekretariat Daerah Kota Palembang',
                'type' => 'organization',
                'role' => 'Lembaga Pemerintah Daerah',
                'website' => 'https://palembang.go.id',
            ]
        );

        $agentPalcomtech = Agent::firstOrCreate(
            ['company_name' => 'Institut Teknologi dan Bisnis PalComTech'],
            [
                'name' => 'ITB PalComTech',
                'type' => 'organization',
                'role' => 'Institusi Pendidikan Tinggi',
                'website' => 'https://palcomtech.ac.id/',
            ]
        );

        // ----------------------------------------------------
        // 2. RESOURCES (Economic Resources)
        // ----------------------------------------------------

        // 2.1 Featured Projects
        $proj1 = Resource::updateOrCreate(
            ['slug' => 'hyper-local-air-quality-mapping'],
            [
                'title' => 'Hyper-Local Air Quality Mapping via Public Transport-Based Sensing',
                'type' => 'project',
                'category' => 'IoT & Artificial Intelligence',
                'year' => 'Proyek Mahasiswa · 2026',
                'image_url' => '/project-air-quality.png',
                'description' => 'Riset dan pengembangan sistem pemantauan kualitas udara hyper-lokal dengan menempatkan perangkat sensor pada kendaraan umum. Sistem menggabungkan sensor, akuisisi data, pelacakan lokasi, serta pengolahan data untuk memetakan kondisi udara di sepanjang rute yang dilalui, lalu divisualisasikan sebagai heatmap secara real-time.',
                'points' => [
                    'Sensor partikulat & gas: PMS5003, SDS011, ZH03B, MQ-135',
                    'Pelacakan lokasi real-time dengan GPS Neo-6M',
                    'Visualisasi heatmap via Google Maps API',
                    'Interpolasi geospasial & filtering spatiotemporal',
                    'Prediksi dengan Fuzzy Tsukamoto dan KNN',
                    'Model KNN diekspor dengan joblib untuk inferensi',
                ],
                'stack' => ['ESP32', 'BME280', 'INA219', 'Firebase', 'Streamlit', 'Plotly', 'Laravel', 'MySQL', 'PHP', 'XAMPP'],
                'is_featured' => true,
                'sort_order' => 1,
                'metadata' => [
                    'gallery' => [
                        [
                            'id' => 'admin-dashboard',
                            'title' => 'Dashboard Admin PolluTrack (Command Center)',
                            'short_title' => 'Dashboard Admin',
                            'tag' => 'Command Center // Super Admin',
                            'description' => 'Command center pemantauan telemetri sensor partikulat (PM2.5, PM10, PM1), gas MQ135, kelembapan udara, tekanan atmosfer, dan deteksi hujan secara real-time disertai manajemen node cluster dan status kesehatan perangkat IoT.',
                            'image' => '/images/pollutrack/dashbord_admin_pollutrack.jpg',
                        ],
                        [
                            'id' => 'public-dashboard',
                            'title' => 'Dashboard Publik PolluTrack (Public Live Portal)',
                            'short_title' => 'Dashboard Publik',
                            'tag' => 'Public Portal // Live Heatmap',
                            'description' => 'Portal publik interaktif yang menampilkan kondisi kualitas udara kota secara langsung, indikator AQI untuk kelompok rentan, status stasiun pemantau aktif, serta integrasi peta spasial rute transportasi umum.',
                            'image' => '/images/pollutrack/dashbord_publik_pollutrack.jpg',
                        ],
                        [
                            'id' => 'admin-login',
                            'title' => 'Halaman Login Admin PolluTrack',
                            'short_title' => 'Login Admin',
                            'tag' => 'Autentikasi & Kontrol Akses',
                            'description' => 'Antarmuka autentikasi berkeamanan tinggi bagi administrator, operator, dan teknisi lapangan sebelum mengakses konfigurasi sistem IoT, manajemen user, dan data telemetri historis.',
                            'image' => '/images/pollutrack/login_admin_pollutrack.jpg',
                        ],
                    ],
                ],
            ]
        );

        $proj2 = Resource::updateOrCreate(
            ['slug' => 'website-penjualan-toyota-ai-chatbot'],
            [
                'title' => 'Website Penjualan Toyota dengan AI Chatbot',
                'type' => 'project',
                'category' => 'Web Development & AI Integration',
                'year' => 'Proyek Mahasiswa · 2026',
                'image_url' => '/project-toyota.png',
                'description' => 'Website bertema penjualan kendaraan Toyota sebagai eksplorasi web development dan integrasi AI, dengan chatbot yang berperan sebagai virtual salesman untuk membantu interaksi dan kebutuhan informasi calon pembeli.',
                'points' => [
                    'AI chatbot sebagai virtual salesman',
                    'Kalkulator simulasi kredit kendaraan',
                    'Tampilan visual 3D & fitur 360° interior/eksterior',
                    'Halaman model kendaraan & profil sales',
                    'Dashboard administrasi',
                    'URL shortener & tracking, dynamic branding',
                ],
                'stack' => ['Web Development', 'Artificial Intelligence', 'AI Chatbot', '3D Visualization', 'Admin Dashboard'],
                'is_featured' => true,
                'sort_order' => 2,
            ]
        );

        // 2.2 Skill Groups
        $skillsData = [
            'Networking' => ['MikroTik', 'Cisco', 'Router', 'Switch', 'Access Point', 'Network Installation', 'Network Monitoring', 'Troubleshooting'],
            'IT Support' => ['Hardware Troubleshooting', 'Software Troubleshooting', 'Preventive Maintenance', 'Server Monitoring', 'Computer Maintenance'],
            'Programming & Teknologi' => ['Python', 'Internet of Things (IoT)', 'Artificial Intelligence', 'Computer Networking', 'PHP', 'Laravel', 'MySQL'],
            'Administrasi' => ['Microsoft Office', 'Microsoft Excel', 'Data Entry', 'Data Processing', 'Reporting', 'Stock Opname'],
            'Operasional' => ['Operational Coordination', 'Documentation', 'Customer Service', 'Team Coordination'],
        ];

        $skillResources = [];
        $order = 1;
        foreach ($skillsData as $group => $items) {
            foreach ($items as $item) {
                $slug = Str::slug($group.'-'.$item);
                $skill = Resource::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'title' => $item,
                        'type' => 'skill',
                        'category' => $group,
                        'sort_order' => $order++,
                    ]
                );
                $skillResources[$item] = $skill;
            }
        }

        // 2.3 Strengths
        $strengths = [
            ['Problem Solving', 'Mampu mengidentifikasi masalah dan mencari solusi berdasarkan kondisi yang dihadapi.'],
            ['Troubleshooting', 'Berpengalaman menangani permasalahan jaringan, hardware, dan software.'],
            ['Network Management', 'Memahami pengelolaan perangkat dan infrastruktur jaringan dasar.'],
            ['Technical Support', 'Terbiasa memberikan dukungan teknis dan melakukan pemeliharaan perangkat.'],
            ['Administrasi', 'Teliti dalam pengolahan data, pencatatan, laporan, dan administrasi operasional.'],
            ['Adaptif & Cepat Belajar', 'Mampu beradaptasi dengan lingkungan kerja serta mempelajari teknologi dan sistem baru.'],
        ];

        foreach ($strengths as $index => [$title, $desc]) {
            Resource::updateOrCreate(
                ['slug' => Str::slug('strength-'.$title)],
                [
                    'title' => $title,
                    'type' => 'strength',
                    'description' => $desc,
                    'sort_order' => $index + 1,
                ]
            );
        }

        // 2.4 Certifications & Achievements
        $certifications = [
            ['group' => 'Pelatihan & sertifikasi AI', 'title' => 'Build an AI Agent', 'meta' => 'AWS AI Academy · 2026'],
            ['group' => 'Pelatihan & sertifikasi AI', 'title' => 'Introduction to Large Language Models', 'meta' => 'AWS AI Academy · 2026'],
            ['group' => 'Pelatihan & sertifikasi AI', 'title' => 'Intelligent by Design: Build an AI Agent', 'meta' => '2026'],
            ['group' => 'Pelatihan & sertifikasi AI', 'title' => 'Lab: Troubleshoot Your Code Using IBM Bob', 'meta' => '2026'],

            ['group' => 'Pencapaian kerja', 'title' => 'Karyawan magang terbaik', 'meta' => 'Sekretariat Daerah Palembang · 2021'],
            ['group' => 'Pencapaian kerja', 'title' => 'Apresiasi skor kepuasan penjualan tertinggi', 'meta' => '2025'],
            ['group' => 'Pencapaian kerja', 'title' => 'Honda Basic Sales Training', 'meta' => '2025'],

            ['group' => 'Seminar & mentoring', 'title' => 'Palcomtech Talk to AI', 'meta' => 'Seminar · 2024'],
            ['group' => 'Seminar & mentoring', 'title' => 'AI vs. Human Awareness: Building Your Digital Safety Shield', 'meta' => 'Expert Mentoring · 2025'],
        ];

        foreach ($certifications as $i => $cert) {
            Resource::updateOrCreate(
                ['slug' => Str::slug('cert-'.$cert['title'])],
                [
                    'title' => $cert['title'],
                    'type' => 'certification',
                    'category' => $cert['group'],
                    'metadata' => ['meta_label' => $cert['meta']],
                    'sort_order' => $i + 1,
                ]
            );
        }

        // 2.5 Education Resource
        Resource::updateOrCreate(
            ['slug' => 'education-palcomtech'],
            [
                'title' => 'Bachelor of Informatika',
                'type' => 'education',
                'category' => 'Pendidikan Formal',
                'description' => 'Institut Teknologi dan Bisnis PalComTech, Palembang · Sep 2024 – Nov 2028 (perkiraan)',
                'image_url' => '/palcomtech-logo.png',
                'external_url' => 'https://palcomtech.ac.id/',
                'points' => [
                    'Pemrograman Berorientasi Objek',
                    'Algoritma dan Struktur Data',
                    'Sistem Operasi dan Arsitektur Komputer',
                    'Kecerdasan Komputasional',
                    'Pemrosesan Data Terdistribusi',
                ],
                'metadata' => [
                    'gpa' => '3.95',
                    'max_gpa' => '4.00',
                ],
                'sort_order' => 1,
            ]
        );

        // ----------------------------------------------------
        // 3. EVENTS (Economic Events & Duality)
        // ----------------------------------------------------

        $experiences = [
            [
                'agent_id' => $agentBangka->id,
                'title' => 'Staf Umum',
                'organization' => 'PT. Bangka Cakra Karya, Palembang',
                'role_title' => 'Staf Umum',
                'period' => 'Jan – Mei 2026',
                'is_current' => true,
                'summary' => 'Mengelola operasional dan administrasi perusahaan sewa alat berat.',
                'details' => [
                    'Mengelola administrasi operasional, termasuk pencatatan pemasukan dari penyewaan alat berat',
                    'Menyusun laporan harian, mingguan, dan bulanan',
                    'Mengelola lebih dari 10 transaksi penjualan dan pembelian suku cadang alat berat',
                    'Mengoordinasikan operator dan sopir di lapangan',
                    'Mengelola administrasi kepegawaian, absensi, dan perhitungan upah',
                    'Memasang 10 unit CCTV di lingkungan kantor',
                ],
                'related_skills' => ['Microsoft Excel', 'Data Entry', 'Reporting', 'Operational Coordination', 'Hardware Troubleshooting'],
            ],
            [
                'agent_id' => $agentToyota->id,
                'title' => 'Sales Konsultan',
                'organization' => 'Toyota Tunas Auto Graha, Palembang',
                'role_title' => 'Sales Konsultan',
                'period' => 'Okt – Des 2025',
                'is_current' => false,
                'summary' => 'Konsultasi penjualan unit kendaraan roda empat dan pengelolaan relasi pelanggan.',
                'details' => [
                    'Mengelola database prospek minimal 10 nomor per hari lewat canvassing, relasi, dan iklan Facebook',
                    'Follow-up minimal 5 konsumen per hari & promosi produk di media sosial',
                    'Mendampingi pelanggan dalam kegiatan unit test drive',
                ],
                'related_skills' => ['Customer Service', 'Data Processing', 'Documentation'],
            ],
            [
                'agent_id' => $agentUmak->id,
                'title' => 'Barista & Kasir',
                'organization' => 'Kedai Kopi Umak, Palembang',
                'role_title' => 'Barista & Kasir',
                'period' => 'Mar – Nov 2025',
                'is_current' => false,
                'summary' => 'Pelayanan pelanggan dan transaksi kasir.',
                'details' => [
                    'Menyiapkan dan menyajikan minuman sesuai standar kedai',
                    'Melayani pelanggan dengan ramah, sopan, dan profesional',
                    'Memproses transaksi pembayaran tunai maupun non-tunai',
                ],
                'related_skills' => ['Customer Service', 'Team Coordination'],
            ],
            [
                'agent_id' => $agentHonda->id,
                'title' => 'Sales Konsultan',
                'organization' => 'Honda Maju Motor Group, Palembang',
                'role_title' => 'Sales Konsultan',
                'period' => 'Feb – Okt 2025',
                'is_current' => false,
                'summary' => 'Konsultan penjualan dan pelayanan pelanggan otomotif.',
                'details' => [
                    'Mengelola database prospek & mendapatkan lead lewat canvassing dan pameran mobil',
                    'Follow-up konsumen dan pendampingan unit test drive',
                    'Memberikan informasi produk dan pelayanan secara profesional',
                ],
                'related_skills' => ['Customer Service', 'Data Processing'],
            ],
            [
                'agent_id' => $agentSekda->id,
                'title' => 'Staf Helper — Jaringan Komputer',
                'organization' => 'Sekretariat Daerah Kota Palembang',
                'role_title' => 'Staf Helper — Jaringan Komputer',
                'period' => 'Jan – Apr 2021',
                'is_current' => false,
                'summary' => 'Instalasi dan pemeliharaan infrastruktur jaringan instansi pemerintahan.',
                'details' => [
                    'Instalasi & konfigurasi jaringan komputer di Ruang Pengadaan Barang dan Jasa',
                    'Mengelola infrastruktur jaringan: 20+ komputer klien, router, switch, access point',
                    'Konfigurasi dan troubleshooting perangkat MikroTik dan Cisco',
                    'Monitoring rutin jaringan & server untuk menjaga uptime',
                ],
                'related_skills' => ['MikroTik', 'Cisco', 'Router', 'Switch', 'Network Installation', 'Network Monitoring', 'Troubleshooting'],
            ],
        ];

        foreach ($experiences as $exp) {
            $relatedSkills = $exp['related_skills'];
            unset($exp['related_skills']);

            $event = Event::updateOrCreate(
                [
                    'organization' => $exp['organization'],
                    'title' => $exp['title'],
                    'period' => $exp['period'],
                ],
                array_merge($exp, ['type' => 'work_experience'])
            );

            // Connect REA Event with Resources (Skills used)
            $resourceIds = [];
            foreach ($relatedSkills as $skillName) {
                if (isset($skillResources[$skillName])) {
                    $resourceIds[$skillResources[$skillName]->id] = ['relationship_type' => 'uses'];
                }
            }
            if (! empty($resourceIds)) {
                $event->resources()->sync($resourceIds);
            }
        }
    }
}
