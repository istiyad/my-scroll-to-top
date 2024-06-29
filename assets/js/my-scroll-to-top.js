// Click To Up
function myScrollToTop() {
    const myScroll = document.querySelector('#my-scroll-to-top');

    if (myScroll) {
        myScroll.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth',
            });
        });
    }
}

function myScrollToTopShow() {
    const myScroll = document.querySelector('#my-scroll-to-top');
    if (window.scrollY > 400) {
        myScroll.classList.add('show-my-scroll-to-top');
    } else {
        myScroll.classList.remove('show-my-scroll-to-top');
    }
}

// Load scroll function on window load
window.addEventListener('load', function () {
    myScrollToTop();
});

// Update scroll-to-top icon visibility on scroll
window.addEventListener('scroll', function () {
    myScrollToTopShow();
});
