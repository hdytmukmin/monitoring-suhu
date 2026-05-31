<script>
    const adminSidebar = document.getElementById('adminSidebar');
    const adminSidebarOpen = document.getElementById('adminSidebarOpen');
    const adminSidebarClose = document.getElementById('adminSidebarClose');
    const adminSidebarBackdrop = document.getElementById('adminSidebarBackdrop');

    function openAdminSidebar() {
        adminSidebar?.classList.remove('-translate-x-full');
        adminSidebarBackdrop?.classList.remove('hidden');
    }

    function closeAdminSidebar() {
        adminSidebar?.classList.add('-translate-x-full');
        adminSidebarBackdrop?.classList.add('hidden');
    }

    adminSidebarOpen?.addEventListener('click', openAdminSidebar);
    adminSidebarClose?.addEventListener('click', closeAdminSidebar);
    adminSidebarBackdrop?.addEventListener('click', closeAdminSidebar);

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeAdminSidebar();
        }
    });
</script>
