@php
    $appUrl = config('app.url');
    $siteUrl = ($appUrl && !str_contains($appUrl, 'localhost') && !str_contains($appUrl, '127.0.0.1') && !str_contains($appUrl, 'gofranmuttaqi'))
        ? rtrim($appUrl, '/')
        : 'https://portofolio-gofran.vercel.app';
    $ownerName = $portfolio->owner->name ?? 'Gofran Muttaqi Likhan';
    $ownerEmail = $portfolio->owner->email ?? 'gofranmuttaqi01@gmail.com';
    $institution = 'Institut Teknologi dan Bisnis PalComTech';

    $schemaData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Person',
                '@id' => $siteUrl . '/#person',
                'name' => $ownerName,
                'alternateName' => 'GML',
                'url' => $siteUrl . '/',
                'image' => $siteUrl . '/gofran-profile.png',
                'jobTitle' => 'Mahasiswa S1 Informatika · IoT & AI Systems · Technical Support',
                'description' => 'Mahasiswa Informatika ITB PalComTech Palembang dengan rekam jejak lintas bidang: administrasi data, dukungan jaringan komputer, serta proyek rekayasa sistem berbasis IoT dan AI.',
                'email' => 'mailto:' . $ownerEmail,
                'telephone' => '+6285669548964',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => 'Palembang',
                    'addressRegion' => 'Sumatera Selatan',
                    'addressCountry' => 'ID',
                ],
                'affiliation' => [
                    '@type' => 'EducationalOrganization',
                    'name' => $institution,
                    'url' => 'https://palcomtech.ac.id/',
                ],
                'sameAs' => [
                    'https://www.linkedin.com/in/gofran-ml',
                    'https://wa.me/6285669548964',
                ],
                'knowsAbout' => [
                    'Internet of Things (IoT)',
                    'Artificial Intelligence (AI)',
                    'Computer Networking',
                    'MikroTik',
                    'Cisco Networking',
                    'Web Engineering',
                    'Data Administration',
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id' => $siteUrl . '/#website',
                'url' => $siteUrl . '/',
                'name' => 'Gofran Muttaqi Likhan · Portfolio',
                'description' => 'Portofolio profesional Gofran Muttaqi Likhan, Mahasiswa Informatika ITB PalComTech berfokus pada IoT, AI, Networking, dan Administrasi.',
                'publisher' => [
                    '@id' => $siteUrl . '/#person',
                ],
                'inLanguage' => ['id-ID', 'en-US'],
            ],
            [
                '@type' => 'ProfilePage',
                '@id' => $siteUrl . '/#webpage',
                'url' => $siteUrl . '/',
                'name' => 'Gofran Muttaqi Likhan · Portofolio',
                'isPartOf' => [
                    '@id' => $siteUrl . '/#website',
                ],
                'mainEntity' => [
                    '@id' => $siteUrl . '/#person',
                ],
                'dateModified' => '2026-10-30',
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
