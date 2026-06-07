<script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
<script defer src="{{ asset('assets/js/popper.min.js') }}"></script>
<script defer src="{{ asset('assets/js/tippy-bundle.umd.min.js') }}"></script>

<script defer src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/alpine-collaspe.min.js') }}"></script>
<script src="{{ asset('assets/js/alpine-persist.min.js') }}"></script>
<script defer src="{{ asset('assets/js/alpine-ui.min.js') }}"></script>
<script defer src="{{ asset('assets/js/alpine-focus.min.js') }}"></script>
<script defer src="{{ asset('assets/js/alpine.min.js') }}"></script>
<script src="{{ asset('assets/js/nice-select2.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.admin-flash-message').forEach((message) => {
            setTimeout(() => {
                message.classList.add('opacity-0', '-translate-y-2');
                setTimeout(() => message.remove(), 300);
            }, 3000);
        });
    });
</script>

@stack('page-scripts')
