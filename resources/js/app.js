import './bootstrap';
import Swal from 'sweetalert2';

// Set SweetAlert2 globally so it's accessible anywhere
window.Swal = Swal;

// Listen to Livewire dispatched custom 'swal' events
document.addEventListener('livewire:init', () => {
    Livewire.on('swal', (event) => {
        let options = event[0] || event;

        Swal.fire({
            icon: options.type || 'info',
            title: options.title || '',
            text: options.text || '',
            confirmButtonColor: '#ec4899', // Pink-500
        });
    });

    // Toast configuration (smaller, non-blocking notification)
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // Listen to Livewire 'toast' events
    Livewire.on('toast', (event) => {
        let options = event[0] || event;

        Toast.fire({
            icon: options.type || 'success',
            title: options.message || ''
        });
    });
});
