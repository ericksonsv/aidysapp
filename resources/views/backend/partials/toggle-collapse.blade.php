<script>
	let toggleCollapse = document.querySelectorAll('.toggle-collapse');
	for (let i = toggleCollapse.length - 1; i >= 0; i--) {
		toggleCollapse[i].addEventListener('click', e => {
			e.preventDefault();
			toggleCollapse[i].classList.toggle('is-active');
			let currentDropdown = toggleCollapse[i].nextElementSibling;
			if (currentDropdown.style.maxHeight) {
				currentDropdown.style.maxHeight = null;
			} else {
				currentDropdown.style.maxHeight = currentDropdown.scrollHeight + 'px';
			}
		});
	}
</script>