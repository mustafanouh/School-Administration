
function fetchResults(query) {
    if (query.length < 2) return;

    axios.get(`/global-search?query=${query}`)
        .then(response => {
            // هAlpine.js
            window.dispatchEvent(new CustomEvent('search-results-updated', { detail: response.data.results }));
        });
}