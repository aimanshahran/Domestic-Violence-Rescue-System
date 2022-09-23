
   (function(html) {
   /* move header
    * -------------------------------------------------- */
   const ssMoveHeader = function () {

    const hdr = document.querySelector('.s-header');
    const hero = document.querySelector('#intro');
    let triggerHeight;

    if (!(hdr && hero)) return;

    setTimeout(function(){
        triggerHeight = hero.offsetHeight - 170;
    }, 300);

    window.addEventListener('scroll', function () {

        let loc = window.scrollY;

        if (loc > triggerHeight) {
            hdr.classList.add('sticky');
        } else {
            hdr.classList.remove('sticky');
        }

        if (loc > triggerHeight + 20) {
            hdr.classList.add('offset');
        } else {
            hdr.classList.remove('offset');
        }

        if (loc > triggerHeight + 150) {
            hdr.classList.add('scrolling');
        } else {
            hdr.classList.remove('scrolling');
        }

    });

}; // end ssMoveHeader


/* mobile menu
* ---------------------------------------------------- */ 
const ssMobileMenu = function() {

    const toggleButton = document.querySelector('.s-header__menu-toggle');
    const mainNavWrap = document.querySelector('.s-header__nav');
    const siteBody = document.querySelector('body');

    if (!(toggleButton && mainNavWrap)) return;

    toggleButton.addEventListener('click', function(event) {
        event.preventDefault();
        toggleButton.classList.toggle('is-clicked');
        siteBody.classList.toggle('menu-is-open');
    });

    mainNavWrap.querySelectorAll('.s-header__nav a').forEach(function(link) {

        link.addEventListener("click", function(event) {

            // at 800px and below
            if (window.matchMedia('(max-width: 800px)').matches) {
                toggleButton.classList.toggle('is-clicked');
                siteBody.classList.toggle('menu-is-open');
            }
        });
    });

    window.addEventListener('resize', function() {

        // above 800px
        if (window.matchMedia('(min-width: 801px)').matches) {
            if (siteBody.classList.contains('menu-is-open')) siteBody.classList.remove('menu-is-open');
            if (toggleButton.classList.contains('is-clicked')) toggleButton.classList.remove('is-clicked');
        }
    });

}; // end ssMobileMenu


/* highlight active menu link on pagescroll
* ------------------------------------------------------ */
const ssScrollSpy = function() {

    const sections = document.querySelectorAll('.target-section');

    // Add an event listener listening for scroll
    window.addEventListener('scroll', navHighlight);

    function navHighlight() {
    
        // Get current scroll position
        let scrollY = window.pageYOffset;
    
        // Loop through sections to get height(including padding and border), 
        // top and ID values for each
        sections.forEach(function(current) {
            const sectionHeight = current.offsetHeight;
            const sectionTop = current.offsetTop - 50;
            const sectionId = current.getAttribute('id');
        
           /* If our current scroll position enters the space where current section 
            * on screen is, add .current class to parent element(li) of the thecorresponding 
            * navigation link, else remove it. To know which link is active, we use 
            * sectionId variable we are getting while looping through sections as 
            * an selector
            */
            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                document.querySelector('.s-header__nav a[href*=' + sectionId + ']').parentNode.classList.add('current');
            } else {
                document.querySelector('.s-header__nav a[href*=' + sectionId + ']').parentNode.classList.remove('current');
            }
        });
    }

}; // end ssScrollSpy

/* smoothscroll
    * ------------------------------------------------------ */
const ssMoveTo = function(){

    const easeFunctions = {
        easeInQuad: function (t, b, c, d) {
            t /= d;
            return c * t * t + b;
        },
        easeOutQuad: function (t, b, c, d) {
            t /= d;
            return -c * t* (t - 2) + b;
        },
        easeInOutQuad: function (t, b, c, d) {
            t /= d/2;
            if (t < 1) return c/2*t*t + b;
            t--;
            return -c/2 * (t*(t-2) - 1) + b;
        },
        easeInOutCubic: function (t, b, c, d) {
            t /= d/2;
            if (t < 1) return c/2*t*t*t + b;
            t -= 2;
            return c/2*(t*t*t + 2) + b;
        }
    }

    const triggers = document.querySelectorAll('.smoothscroll');
    
    const moveTo = new MoveTo({
        tolerance: 0,
        duration: 1200,
        easing: 'easeInOutCubic',
        container: window
    }, easeFunctions);

    triggers.forEach(function(trigger) {
        moveTo.registerTrigger(trigger);
    });

}; // end ssMoveTo

/* Initialize
    * ------------------------------------------------------ */
(function ssInit1() {

    ssMoveHeader();
    ssMobileMenu();
    ssScrollSpy();
    ssMoveTo();

})();

})(document.documentElement);