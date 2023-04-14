<!DOCTYPE html>
<html>
<head>
	<title>URL Shortener</title>
</head>
<body>
	<h1>URL Shortener</h1>
	<form action="shorten.php" method="post">
		<label for="long_url">Long URL:</label>
		<input type="text" name="long_url" id="long_url">
		<button type="submit" name="submit">Shorten URL</button>
	</form>
	<div id="shortened_url" style="display: none;">
		<p>Shortened URL:</p>
		<input type="text" id="short_url">
		<button id="copy_button">Copy URL</button>
	</div>
	<script>
		// Function to copy the shortened URL to clipboard
		function copyToClipboard() {
			var copyText = document.getElementById("short_url");
			copyText.select();
			document.execCommand("copy");
			alert("Copied to clipboard!");
		}

		// When the form is submitted, make an AJAX request to shorten the URL
		var form = document.querySelector("form");
		form.addEventListener("submit", function(event) {
			event.preventDefault(); // Prevent page refresh
			var xhr = new XMLHttpRequest();
			xhr.open("POST", form.action);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function() {
				if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
					var response = JSON.parse(this.responseText);
					if (response.success) {
						// Show the shortened URL and copy button
						var shortUrl = response.short_url;
						var shortenedUrlDiv = document.getElementById("shortened_url");
						var shortUrlInput = document.getElementById("short_url");
						shortUrlInput.value = shortUrl;
						shortenedUrlDiv.style.display = "block";
						// Add click listener to copy button
						var copyButton = document.getElementById("copy_button");
						copyButton.addEventListener("click", copyToClipboard);
					} else {
						alert("An error occurred while shortening the URL.");
					}
				}
			};
			xhr.send("long_url=" + encodeURIComponent(form.long_url.value));
		});
	</script>
</body>
</html>
