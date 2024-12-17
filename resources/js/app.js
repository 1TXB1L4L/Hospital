import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

if (window.location.pathname === '/dashboard') {
    import('chart.js/auto').then((Chart) => {
        // Example: Use Chart here
        console.log('Chart.js loaded', Chart);
    }).catch((error) => {
        console.error('Failed to load Chart.js', error);
    });
}
