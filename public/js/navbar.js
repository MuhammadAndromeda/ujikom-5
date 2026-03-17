const sidebar = document.getElementById('sidebar');

function openSidebar() {
    sidebar.classList.replace('translate-x-full', 'translate-x-0');
}

function closeSidebar() {
    sidebar.classList.replace('translate-x-0', 'translate-x-full');
}