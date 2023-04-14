import requests
import json

# Define the URLs for the API endpoints
cuttly_url = "https://cutt.ly/api/api.php"
bdshortener_url = "https://bdshortener.com/api/shorten"

# Define the API keys for the services
cuttly_key = "<insert your Cutt.ly API key here>"
bdshortener_key = "<insert your bdShortener API key here>"

# Define the original URL that we want to shorten
original_url = "https://m.youtube.com/redirect?event=comments&redir_token=QUFFLUhqbS00VEY4M05fa0tfOUpUSnM2dFlsQUtFWHFuQXxBQ3Jtc0tuX0JhYWc1bkt1YjFlNGdwWktQblBTLWZhRHQ4MGtMVjhXQ003MWUzZWZVaGlDcGlRRnJrMHV0eEJSTEp4a2hHT1ZNOEV4YkE2SkJMTlMtM3V1NE5laGZoU0RNZEN3UmhudXB1aTlvbzRhdm1FMWFrVQ&q="

# Define the parameters for the Cutt.ly API request
cuttly_params = {
    "key": cuttly_key,
    "short": original_url,
    "name": "My custom short link"
}

# Make the request to the Cutt.ly API
cuttly_response = requests.get(cuttly_url, params=cuttly_params)

# Parse the response from the Cutt.ly API
cuttly_data = json.loads(cuttly_response.text)
short_url = cuttly_data["url"]["shortLink"]

# Define the parameters for the bdShortener API request
bdshortener_params = {
    "url": short_url,
    "api": bdshortener_key
}

# Make the request to the bdShortener API
bdshortener_response = requests.get(bdshortener_url, params=bdshortener_params)

# Parse the response from the bdShortener API
bdshortener_data = json.loads(bdshortener_response.text)
final_url = bdshortener_data["shortenedUrl"]

# Save the final shortened URL to a file
with open("shortened_urls.txt", "a") as f:
    f.write(final_url + "\n")

# Print the final shortened URL
print(final_url)
