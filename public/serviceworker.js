var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/offline',
    '/assets/css/style.css',
    '/admin/css/style.css',
    '/custom-style.css',
    '/assets/js/script.js',
    '/images/icons/favicon (Custom).png',
    '/images/icons/favicon-16x16.png',
    '/images/icons/favicon-32x32.png',
    '/images/icons/favicon-96x96.png',
    '/images/icons/favicon-128x128.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-384x384.png',
    '/images/icons/icon-512x512.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});

self.addEventListener("push", function (event) {
    if (event.data) {
        var notification = event.data.json();
        event.waitUntil(
            self.registration.showNotification(notification.title, {
                body: notification.body,
                icon: "icon.png",
                tag: notification.tag,
                data: notification.url
            })
        );
    }
});

self.addEventListener("notificationclick", function (event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.notifURL)
    );
});
