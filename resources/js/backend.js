// SweetAlert
	import Swal from 'sweetalert2';
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 5000,
		timerProgressBar: true,
		onOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	});
	window.Swal = Swal;
	window.Toast = Toast;
// SweetAlert

// Toggle Sidebar
	let mainContentWrapper = document.querySelector('#main-content-wrapper');
	let toggleSidebarBtn = document.querySelector('#toggle-sidebar-btn');
	let sidebar = document.querySelector('#sidebar');
	toggleSidebarBtn.addEventListener('click', (e) => {
		e.preventDefault();
		// e.stopPropagation();
		toggleSidebarBtn.classList.toggle('is-active');
		sidebar.classList.toggle('is-open');
		mainContentWrapper.classList.toggle('is-compact');
	});
// Toggle Sidebar

// Sidebar Dropdowns
	let sidebarDropDowns = document.querySelectorAll('.sidebar-dropdown');
	for (let i = sidebarDropDowns.length - 1; i >= 0; i--) {
		sidebarDropDowns[i].addEventListener('click', e => {
			e.preventDefault();
			e.stopPropagation();
			sidebarDropDowns[i].classList.toggle('is-open');
			let currentDropdown = sidebarDropDowns[i].nextElementSibling;
			if (currentDropdown.style.maxHeight) {
				currentDropdown.style.maxHeight = null;
			} else {
				currentDropdown.style.maxHeight = currentDropdown.scrollHeight + 'px';
			}
		});
	}
// Sidebar Dropdowns

// Toggle User Menu
	let toggleAuthMenuBtn = document.querySelector('#toggle-auth-menu-btn');
	let authMenu = document.querySelector('#auth-menu');
	toggleAuthMenuBtn.addEventListener('click', (e) => {
		e.preventDefault();
		e.stopPropagation();
		toggleAuthMenuBtn.classList.toggle('is-active');
		authMenu.classList.toggle('is-open');
		if (sidebar.classList.contains('is-open')) {
			sidebar.classList.toggle('is-open');
		}
		if (toggleSidebarBtn.classList.contains('is-active')) {
			toggleSidebarBtn.classList.toggle('is-active');
		}
		if (mainContentWrapper.classList.contains('is-compact')) {
			mainContentWrapper.classList.toggle('is-compact');
		}
	});
// Toggle User Menu

// Close Sidebar And User Menu
	document.querySelector('body').addEventListener('click', e => {
		if (authMenu.classList.contains('is-open')) {
			authMenu.classList.toggle('is-open');
		}
		if (toggleAuthMenuBtn.classList.contains('is-active')) {
			toggleAuthMenuBtn.classList.toggle('is-active');
		}
	});
// Close Sidebar And User Menu