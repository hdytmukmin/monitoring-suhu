<style>
    .dashboard-shell {
        background:
            radial-gradient(circle at top right, rgba(250, 204, 21, 0.14), transparent 28rem),
            linear-gradient(180deg, rgba(236, 253, 245, 1), rgba(248, 250, 252, 1) 42%),
            #f8fafc;
    }

    .dashboard-shell input,
    .dashboard-shell select {
        color: #0f172a;
        outline: none;
    }

    .dashboard-shell option {
        color: #0f172a;
        background: #ffffff;
    }

    .dashboard-shell input::placeholder {
        color: #64748b;
    }

    .dashboard-shell input:focus,
    .dashboard-shell select:focus {
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
    }

    .dashboard-shell table tbody tr {
        transition: background-color 160ms ease;
    }

    .dashboard-shell table tbody tr:hover {
        background-color: #fafafa;
    }
</style>
