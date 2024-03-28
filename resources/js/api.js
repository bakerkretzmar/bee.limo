const cookie = (name) => {
    const match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
    return match ? decodeURIComponent(match[3]) : null;
};

export default {
    get: (url) => fetch(url),
    post: (url, data) =>
        fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            credentials: 'same-origin',
            redirect: 'follow',
            headers: {
                'Content-Type': 'application/json',
                'X-XSRF-TOKEN': cookie('XSRF-TOKEN'),
            },
        }),
};
