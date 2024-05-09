smallimg.forEach(el => {
    el.addEventListener('click', function() {
        mainimg.src = el.src;
    });
});