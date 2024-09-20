@if (session('success'))
<div id="toast-container"></div>

<template id="toast-template">
    <div id="successToast" class="toast rounded-4" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-bell-ringing"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" /><path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" /></svg>
            <strong class="me-auto ms-1">Pemberitahuan</strong>
            <small>Baru saja</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <p class="text-secondary">{{ session('success') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"    stroke-linejoin="round" class="icon me-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l5 5l10 -10"></path>
                </svg>
            </p>
        </div>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toastContainer = document.getElementById('toast-container');
        const template = document.getElementById('toast-template');
        const toast = template.content.firstElementChild.cloneNode(true);
        
        toastContainer.appendChild(toast);

        // Trigger reflow
        toast.offsetHeight;

        setTimeout(() => {
            toast.classList.add('showing');
            setTimeout(() => toast.classList.replace('showing', 'show'), 250);
        }, 100);

        setTimeout(() => {
            toast.classList.remove('show');
            toast.classList.add('hide');
            setTimeout(() => toastContainer.removeChild(toast), 250);
        }, 30000);

        toast.querySelector('.btn-close').addEventListener('click', function() {
            toast.classList.remove('show');
            toast.classList.add('hide');
            setTimeout(() => toastContainer.removeChild(toast), 250);
        });
    });
</script>
@endif