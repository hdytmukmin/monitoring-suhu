<style>
    [x-cloak] {
        display: none !important;
    }

    html {
        scroll-behavior: smooth;
    }

    .admin-shell {
        background:
            radial-gradient(circle at top right, rgba(250, 204, 21, 0.16), transparent 26rem),
            linear-gradient(90deg, #ffffff 0 300px, rgba(236, 253, 245, 0.88) 300px, #f8fafc 55%),
            #f8fafc;
    }

    .admin-shell input,
    .admin-shell select,
    .admin-shell textarea {
        outline: none;
    }

    .admin-shell input:focus,
    .admin-shell select:focus,
    .admin-shell textarea:focus {
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
    }

    .admin-shell table tbody tr {
        transition: background-color 160ms ease;
    }

    .admin-shell table tbody tr:hover {
        background-color: #f8fafc;
    }

    .admin-shell ::selection {
        background: rgba(15, 118, 110, 0.16);
    }

    .admin-shell .modern-panel {
        border: 1px solid rgba(209, 250, 229, 0.95);
        background: rgba(255, 255, 255, 0.96);
        box-shadow: 0 18px 42px rgba(15, 118, 110, 0.08);
    }
</style>
