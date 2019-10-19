location.href = process.env.MIX_APP_URL + '/bookmark?url='
    + encodeURIComponent(location.href)
    + '&title=' + encodeURIComponent(document.title)
    + '&selection=' + encodeURIComponent(window.getSelection().toString())
