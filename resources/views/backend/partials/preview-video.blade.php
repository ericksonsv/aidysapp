<script>
	function previewVideo(item) {
		const reader = new FileReader();
		reader.onload = () => {
			const output = document.querySelector('#'+item);
			output.src = reader.result;
			output.style.display = 'block';
		}
		reader.readAsDataURL(event.target.files[0]);
	}
</script>