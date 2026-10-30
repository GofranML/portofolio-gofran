/**
 * Service Worker · Gofran Muttaqi Likhan Portfolio
 * Strategy: Safe Network-First for documents, Cache-First for static assets.
 * Security: Strict Network-Only bypass for /api/ and /inquiry. Zero sensitive caching.
 */

const CACHE_NAME = 'gml-portfolio-v4.1.0';
const PRECACHE_ASSETS = [
  '/',
  '/favicon.svg',
  '/manifest.webmanifest',
  '/css/portfolio.css',
  '/js/portfolio.js',
  '/og-image.png',
  '/images/icons/icon-192.png',
  '/images/icons/icon-512.png',
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(PRECACHE_ASSETS)).then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) =>
      Promise.all(
        keys.map((key) => {
          if (key !== CACHE_NAME) {
            return caches.delete(key);
          }
        })
      )
    ).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (event) => {
  const request = event.request;
  const url = new URL(request.url);

  // 1. Never intercept non-GET requests (e.g. POST /inquiry)
  if (request.method !== 'GET') {
    return;
  }

  // 2. Strict Network-Only for dynamic API endpoints & sensitive routes
  if (url.pathname.startsWith('/api/') || url.pathname.startsWith('/inquiry')) {
    return;
  }

  // 3. Navigation requests: Network-First with Cache fallback
  if (request.mode === 'navigate') {
    event.respondWith(
      fetch(request)
        .then((response) => {
          if (response && response.status === 200) {
            const clone = response.clone();
            caches.open(CACHE_NAME).then((cache) => cache.put(request, clone));
          }
          return response;
        })
        .catch(async () => {
          const cached = await caches.match(request);
          if (cached) return cached;
          const fallback = await caches.match('/');
          if (fallback) return fallback;
          return new Response(
            '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Offline · GML Portfolio</title><style>body{font-family:sans-serif;background:#090B0E;color:#F2EFE9;display:flex;align-items:center;justify-content:center;height:100vh;margin:0;text-align:center;}h1{color:#2EE59D;font-family:monospace;}</style></head><body><div><h1>SYS // OFFLINE</h1><p>Anda sedang berada di luar jaringan. Hubungkan kembali perangkat Anda untuk memuat pembaruan portofolio.</p></div></body></html>',
            { headers: { 'Content-Type': 'text/html; charset=UTF-8' } }
          );
        })
    );
    return;
  }

  // 4. Static Assets (CSS, JS, Fonts, Images): Stale-While-Revalidate or Cache-First
  if (
    url.pathname.startsWith('/css/') ||
    url.pathname.startsWith('/js/') ||
    url.pathname.startsWith('/images/') ||
    /\.(?:png|jpg|jpeg|webp|avif|svg|ico|woff2?)$/i.test(url.pathname)
  ) {
    event.respondWith(
      caches.match(request).then((cached) => {
        if (cached) {
          // Revalidate in background
          fetch(request)
            .then((res) => {
              if (res && res.status === 200) {
                caches.open(CACHE_NAME).then((cache) => cache.put(request, res));
              }
            })
            .catch(() => {});
          return cached;
        }
        return fetch(request).then((res) => {
          if (res && res.status === 200) {
            const clone = res.clone();
            caches.open(CACHE_NAME).then((cache) => cache.put(request, clone));
          }
          return res;
        });
      })
    );
  }
});
