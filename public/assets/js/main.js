var swiper = new Swiper(".hmsliderSwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    autoplay: {
        delay: 5500,
        disableOnInteraction: false
    },
});

var swiper = new Swiper(".stepswSwiper", {
    slidesPerView: 1,
    spaceBetween: 25,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        1920: {
            slidesPerView: 4
        },
        1028: {
            slidesPerView: 4
        },
        480: {
            slidesPerView: 1
        }
    },
});


var swiper = new Swiper(".platformSwiper", {
    slidesPerView: 3,
    spaceBetween: 15,
    pagination: {
        el: ".swiper-pagination",
        type: "progressbar",
    },
    navigation: {
        nextEl: ".swiper-button-nextpt",
        prevEl: ".swiper-button-prevpt",
    },
    breakpoints: {
        1920: {
            slidesPerView: 5
        },
        1028: {
            slidesPerView: 5
        },
        480: {
            slidesPerView: 3
        }
    },
});


var swiper = new Swiper(".custserviceSwiper", {
    slidesPerView: 1,
    spaceBetween: 25,
    pagination: {
        el: ".swiper-pagination",
        type: "progressbar",
    },
    navigation: {
        nextEl: ".swiper-button-nextbs",
        prevEl: ".swiper-button-prevbs",
    },
    breakpoints: {
        1920: {
            slidesPerView: 2
        },
        1028: {
            slidesPerView: 2
        },
        480: {
            slidesPerView: 1
        }
    },
});



var swiper = new Swiper(".commentSwiper", {
    slidesPerView: 1,
    spaceBetween: 15,
    pagination: {
        el: ".swiper-pagination",
        type: "progressbar",
    },
    navigation: {
        nextEl: ".swiper-button-nextcmt",
        prevEl: ".swiper-button-prevcmt",
    },
});

$(document).ready(function () {
    $("button").each(function (index) {
        var logo = $(this).data("logo");
        $(this)
            .find(".button-logo")
            .attr("src", $(this).data("logo"));
    });

    $("#detayModal").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        modal.find(".modal-name").text(button.data("name"));
    });
});

$(".burger").click(function () {
    $(".panelcontent").toggleClass("active")
});

function fileValue(value) {
    var path = value.value;
    var extenstion = path.split('.').pop();
    if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion == "gif") {
        document.getElementById('image-preview').src = window.URL.createObjectURL(value.files[0]);
        var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
        document.getElementById("filename").innerHTML = filename;
    } else {
        alert("YanlÄ±ÅŸ resim formatÄ± ")
    }
}


$(".toggle-password").click(function () {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});


$(document).ready(function () {
    checkMobileActiveClass();

    $(window).on('resize', function () {
      checkMobileActiveClass();
    });
  });

  function checkMobileActiveClass() {
    const panelContent = $('.panelcontent');

    if (window.innerWidth <= 768) {
      panelContent.removeClass('active');
    } 
  }

function myFunction(event) {
    event.preventDefault();

    var copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);

    var messageDiv = document.getElementById("message");
    messageDiv.style.display = "flex";

    setTimeout(function () {
        messageDiv.style.display = "none";
    }, 1000);
}


var $affectedElements = $("p, h1, h2, h3, h4, h5, h6");

$affectedElements.each(function () {
    var $this = $(this);
    $this.data("orig-size", $this.css("font-size"));
});

$("#btn-increase").click(function () {
    changeFontSize(1);
})

$("#btn-decrease").click(function () {
    changeFontSize(-1);
})

$("#btn-orig").click(function () {
    $affectedElements.each(function () {
        var $this = $(this);
        $this.css("font-size", $this.data("orig-size"));
    });
})

function changeFontSize(direction) {
    $affectedElements.each(function () {
        var $this = $(this);
        $this.css("font-size", parseInt($this.css("font-size")) + direction);
    });
}

const setTheme = theme => {
    document.documentElement.className = theme;
    localStorage.setItem('theme', theme);
};

document.addEventListener('DOMContentLoaded', function () {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        setTheme(savedTheme);
    }
});

