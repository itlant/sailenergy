/**
 * Sail Energy - Core JavaScript
 * @version 3.0.0
 */

(function ($) {
  "use strict";

  /* ============================================================================
     01. Utility Functions
     ============================================================================ */

  function formatPhoneNumber(value) {
    let phoneValue = value.replace(/\D/g, "");
    if (phoneValue.length === 0) return value;
    if (!phoneValue.startsWith("7") && !phoneValue.startsWith("8")) {
      phoneValue = "7" + phoneValue;
    }
    let formattedValue = "+7 ";
    if (phoneValue.length > 1) {
      formattedValue += "(" + phoneValue.substring(1, 4);
    }
    if (phoneValue.length >= 4) {
      formattedValue += ") " + phoneValue.substring(4, 7);
    }
    if (phoneValue.length >= 7) {
      formattedValue += "-" + phoneValue.substring(7, 9);
    }
    if (phoneValue.length >= 9) {
      formattedValue += "-" + phoneValue.substring(9, 11);
    }
    return formattedValue;
  }

  function validatePhone(phone) {
    const phoneRegex =
      /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
    return phoneRegex.test(phone.replace(/\D/g, ""));
  }

  window.showNotification = function (type, message) {
    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
    notification.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 20px;
      background: ${type === "success" ? "#28a745" : "#dc3545"};
      color: white;
      border-radius: 8px;
      z-index: 9999;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      animation: slideIn 0.3s ease;
    `;
    notification.textContent = message;

    if (!document.getElementById("notification-styles")) {
      const style = document.createElement("style");
      style.id = "notification-styles";
      style.textContent = `
        @keyframes slideIn {
          from { transform: translateX(100%); opacity: 0; }
          to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
          from { transform: translateX(0); opacity: 1; }
          to { transform: translateX(100%); opacity: 0; }
        }
      `;
      document.head.appendChild(style);
    }

    document.body.appendChild(notification);

    setTimeout(() => {
      notification.style.animation = "slideOut 0.3s ease";
      setTimeout(() => {
        if (notification.parentNode) {
          notification.parentNode.removeChild(notification);
        }
      }, 300);
    }, 5000);
  };

  /* ============================================================================
     02. DOM Ready Initialization
     ============================================================================ */

  $(document).ready(function () {
    console.log("Sail Energy JS initialized");

    // Core
    initBackToTop();
    initPhoneMask();
    initCookieModal();
    initScrollCTA();
    initDropdowns();
    initMobileMenu();
    initHideContactsOnOverflow();

    // Carousels
    initCarousels();
    initHeroWheelhouse();

    // Forms & Modals
    initModalHandlers();
    initFormValidation();
  });

  /* ============================================================================
     03. Dropdown Menu (Click only)
     ============================================================================ */

  function initDropdowns() {
    // Toggle dropdown on click
    $(".dropdown-toggle").on("click", function (e) {
      e.preventDefault();
      e.stopPropagation();

      // Для мобильных устройств не закрываем dropdown при клике на родительский пункт
      if (window.innerWidth < 992) {
        // Просто переключаем класс, без дополнительной логики
        const $dropdown = $(this).closest(".dropdown");
        $dropdown.toggleClass("show");
        $(this).next(".dropdown-menu").toggleClass("show");
        $(this).attr("aria-expanded", $dropdown.hasClass("show"));
        return;
      }

      // Остальной код для десктопа...
      const $toggle = $(this);
      const $dropdown = $toggle.closest(".dropdown");
      const $menu = $toggle.next(".dropdown-menu");
      const isOpen = $dropdown.hasClass("show");

      // Close all other dropdowns
      $(".dropdown.show")
        .not($dropdown)
        .each(function () {
          $(this).removeClass("show");
          $(this).find(".dropdown-menu").removeClass("show");
          $(this).find(".dropdown-toggle").attr("aria-expanded", "false");
        });

      // Toggle current dropdown
      if (!isOpen) {
        $dropdown.addClass("show");
        $menu.addClass("show");
        $toggle.attr("aria-expanded", "true");
      } else {
        $dropdown.removeClass("show");
        $menu.removeClass("show");
        $toggle.attr("aria-expanded", "false");
      }
    });

    // Close dropdown when clicking outside
    $(document).on("click", function (e) {
      if (!$(e.target).closest(".dropdown").length) {
        $(".dropdown.show").each(function () {
          $(this).removeClass("show");
          $(this).find(".dropdown-menu").removeClass("show");
          $(this).find(".dropdown-toggle").attr("aria-expanded", "false");
        });
      }
    });

    // Prevent closing when clicking inside dropdown menu
    $(".dropdown-menu").on("click", function (e) {
      e.stopPropagation();
    });

    // Handle escape key
    $(document).on("keydown", function (e) {
      if (e.key === "Escape") {
        $(".dropdown.show").each(function () {
          $(this).removeClass("show");
          $(this).find(".dropdown-menu").removeClass("show");
          $(this).find(".dropdown-toggle").attr("aria-expanded", "false");
        });
      }
    });
  }

  /* ============================================================================
     04. Carousels
     ============================================================================ */

  function initCarousels() {
    $(".testimonials-carousel").each(function () {
      $(this).owlCarousel({
        items: 1,
        loop: true,
        margin: 30,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        smartSpeed: 800,
        responsive: {
          768: {
            items: 2,
          },
        },
      });
    });
  }

  /* ============================================================================
     05. Hero Wheelhouse Slider
     ============================================================================ */

  function initHeroWheelhouse() {
    const $heroCarousel = $(".hero-background-carousel");
    if (!$heroCarousel.length) return;

    $heroCarousel.owlCarousel({
      items: 1,
      loop: true,
      margin: 0,
      nav: false,
      dots: true,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      smartSpeed: 800,
      animateOut: "fadeOut",
      animateIn: "fadeIn",
    });

    let isUpdatingFromSlider = false;
    let isUpdatingFromButton = false;

    $(".theme-btn").on("click", function (e) {
      e.preventDefault();
      if (isUpdatingFromSlider) return;

      isUpdatingFromButton = true;

      const $btn = $(this);
      const theme = $btn.data("theme");

      let targetIndex = 0;
      $(".hero-slide-item").each(function (index) {
        if ($(this).data("theme") === theme) {
          targetIndex = index;
          return false;
        }
      });

      $heroCarousel.trigger("to.owl.carousel", targetIndex);

      $(".theme-btn").removeClass("active");
      $btn.addClass("active");
      $("#currentThemeDisplay").text($btn.find(".theme-name").text());

      setTimeout(() => {
        isUpdatingFromButton = false;
      }, 100);
    });

    $heroCarousel.on("changed.owl.carousel", function (event) {
      if (isUpdatingFromButton) return;

      isUpdatingFromSlider = true;

      const currentIndex = event.item.index;
      const $currentSlide = $(".hero-slide-item").eq(currentIndex);
      const currentTheme = $currentSlide.data("theme");

      $(".theme-btn").removeClass("active");
      $(`.theme-btn[data-theme="${currentTheme}"]`).addClass("active");
      $("#currentThemeDisplay").text(
        $(`.theme-btn[data-theme="${currentTheme}"] .theme-name`).text(),
      );

      setTimeout(() => {
        isUpdatingFromSlider = false;
      }, 100);
    });
  }

  /* ============================================================================
     06. Back to Top
     ============================================================================ */

  function initBackToTop() {
    const backToTop = document.getElementById("backToTop");
    if (!backToTop) return;

    window.addEventListener("scroll", function () {
      backToTop.classList.toggle("visible", window.scrollY > 300);
    });

    backToTop.addEventListener("click", function (e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  /* ============================================================================
     07. Phone Mask
     ============================================================================ */

  function initPhoneMask() {
    document.querySelectorAll('input[type="tel"]').forEach((input) => {
      input.addEventListener("input", function (e) {
        e.target.value = formatPhoneNumber(e.target.value);
      });

      input.addEventListener("blur", function () {
        this.classList.toggle(
          "is-invalid",
          this.value && !validatePhone(this.value),
        );
      });
    });
  }

  /* ============================================================================
     08. Modals
     ============================================================================ */

  function initModalHandlers() {
    $("#courseRegModal").on("show.bs.modal", function (event) {
      const button = $(event.relatedTarget);
      const courseTitle = button.data("course-title");
      $(this)
        .find(".modal-title")
        .text("Регистрация на курс: " + courseTitle);
      $(this).find("#courseRegCourseName").val(courseTitle);
    });

    $("#regattaModal").on("show.bs.modal", function (event) {
      const button = $(event.relatedTarget);
      const eventTitle = button.data("event-title");
      $(this)
        .find(".modal-title")
        .text("Регистрация на регату: " + eventTitle);
      $(this).find("#regattaName").val(eventTitle);
    });
  }

  /* ============================================================================
     09. Form Validation
     ============================================================================ */

  function initFormValidation() {
    $(
      'form[data-validate="true"], #courseForm, #regattaForm, #consultationForm, #ctaForm',
    ).on("submit", function (e) {
      e.preventDefault();

      const $form = $(this);
      const $phoneInput = $form.find('input[type="tel"]');
      const $privacyCheck = $form.find(
        'input[type="checkbox"][name="privacy"], input[type="checkbox"][name="terms"]',
      );

      if (
        $phoneInput.length &&
        $phoneInput.val() &&
        !validatePhone($phoneInput.val())
      ) {
        $phoneInput.addClass("is-invalid");
        showNotification(
          "error",
          "Пожалуйста, введите корректный номер телефона",
        );
        return false;
      }

      if ($privacyCheck.length && !$privacyCheck.is(":checked")) {
        $privacyCheck.addClass("is-invalid");
        showNotification("error", "Необходимо согласие с условиями");
        return false;
      }

      showNotification(
        "success",
        "Заявка отправлена! Мы свяжемся с вами в ближайшее время.",
      );

      const $modal = $form.closest(".modal");
      if ($modal.length && typeof bootstrap !== "undefined") {
        const modalInstance = bootstrap.Modal.getInstance($modal[0]);
        if (modalInstance) modalInstance.hide();
      }

      $form[0].reset();
      $form.find(".is-invalid").removeClass("is-invalid");
    });

    $("form input, form textarea, form select").on("input change", function () {
      $(this).removeClass("is-invalid");
    });
  }

  /* ============================================================================
     10. Cookie Modal
     ============================================================================ */

  function initCookieModal() {
    const cookieModal = document.getElementById("cookieModal");
    if (!cookieModal) return;

    if (!localStorage.getItem("cookiesAccepted")) {
      setTimeout(() => {
        cookieModal.classList.add("show");
        cookieModal.style.display = "block";
      }, 10000);
    }

    document
      .getElementById("closeCookies")
      ?.addEventListener("click", function () {
        localStorage.setItem("cookiesAccepted", "true");
        cookieModal.classList.remove("show");
        setTimeout(() => {
          cookieModal.style.display = "none";
        }, 300);
      });
  }

  /* ============================================================================
     11. Scroll CTA
     ============================================================================ */

  function initScrollCTA() {
    const scrollCTA = document.getElementById("scrollCta");
    const scrollCTAClose = document.getElementById("scrollCtaClose");

    if (!scrollCTA) return;

    let lastScrollTop = 0;
    let scrollCTAShown = false;

    window.addEventListener("scroll", function () {
      const currentScroll =
        window.pageYOffset || document.documentElement.scrollTop;

      if (
        !scrollCTAShown &&
        currentScroll > 20000 &&
        currentScroll < lastScrollTop &&
        currentScroll > 500
      ) {
        if (!localStorage.getItem("scrollCtaClosed")) {
          scrollCTA.classList.add("visible");
          scrollCTAShown = true;
        }
      }

      lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    });

    if (scrollCTAClose) {
      scrollCTAClose.addEventListener("click", function () {
        scrollCTA.classList.remove("visible");
        localStorage.setItem("scrollCtaClosed", "true");
      });
    }
  }

  /* ============================================================================
     12. Hide Contacts on Overflow
     ============================================================================ */

  function initHideContactsOnOverflow() {
    const checkOverflow = () => {
      // Только для десктопа
      if (window.innerWidth < 992) return;

      const navbar = document.querySelector(".navbar .container");
      const contacts = document.querySelector(".header-contacts");

      if (!navbar || !contacts) return;

      // Проверяем, помещается ли меню без контактов
      const tempContacts = contacts.cloneNode(true);
      tempContacts.style.visibility = "hidden";
      tempContacts.style.position = "absolute";
      tempContacts.style.width = "auto";
      tempContacts.classList.remove("hide-on-overflow");

      navbar.appendChild(tempContacts);
      const contactsWidth = tempContacts.offsetWidth;
      navbar.removeChild(tempContacts);

      // Проверяем общую ширину
      const navbarWidth = navbar.offsetWidth;
      const logo = document.querySelector(".navbar-brand");
      const toggler = document.querySelector(".navbar-toggler");
      const nav = document.querySelector(".navbar-nav");

      let usedWidth = logo.offsetWidth + (toggler?.offsetWidth || 0) + 40;

      if (nav) {
        usedWidth += nav.scrollWidth;
      }

      // Если не помещается, скрываем контакты
      if (usedWidth + contactsWidth > navbarWidth) {
        contacts.classList.add("hide-on-overflow");
      } else {
        contacts.classList.remove("hide-on-overflow");
      }
    };

    window.addEventListener("load", checkOverflow);
    window.addEventListener("resize", checkOverflow);
    setTimeout(checkOverflow, 300);
  }

  /* ============================================================================
     13. Mobile Menu Enhancement
     ============================================================================ */

  function initMobileMenu() {
    const toggler = document.querySelector(".navbar-toggler");
    const collapse = document.querySelector(".navbar-collapse");

    if (!toggler || !collapse) return;

    // Функция для блокировки/разблокировки скролла
    const toggleBodyScroll = (disable) => {
      if (disable) {
        document.body.style.overflow = "hidden";
        document.body.style.height = "100vh";
        document.body.style.position = "fixed";
        document.body.style.width = "100%";
        document.body.style.top = `-${window.scrollY}px`;
      } else {
        const scrollY = document.body.style.top;
        document.body.style.overflow = "";
        document.body.style.height = "";
        document.body.style.position = "";
        document.body.style.width = "";
        document.body.style.top = "";
        window.scrollTo(0, parseInt(scrollY || "0") * -1);
      }
    };

    // Обработка клика по бургеру
    toggler.addEventListener("click", function () {
      const isExpanded = this.getAttribute("aria-expanded") === "true";

      if (isExpanded) {
        // Меню открывается
        setTimeout(() => {
          toggleBodyScroll(true);
        }, 10);
      } else {
        // Меню закрывается
        toggleBodyScroll(false);
      }
    });

    // Слушаем события Bootstrap collapse
    collapse.addEventListener("shown.bs.collapse", function () {
      toggleBodyScroll(true);
    });

    collapse.addEventListener("hidden.bs.collapse", function () {
      toggleBodyScroll(false);
    });

    // Закрытие меню при клике на ссылку
    collapse.querySelectorAll(".nav-link").forEach((link) => {
      link.addEventListener("click", (e) => {
        // Не закрываем, если это ссылка с dropdown
        if (link.classList.contains("dropdown-toggle")) {
          return;
        }

        if (window.innerWidth < 992) {
          const bsCollapse = bootstrap.Collapse.getInstance(collapse);
          if (bsCollapse) {
            bsCollapse.hide();
          }
          toggleBodyScroll(false);
        }
      });
    });

    // Закрытие при клике вне меню
    document.addEventListener("click", (e) => {
      if (window.innerWidth < 992) {
        const isClickInside =
          collapse.contains(e.target) || toggler.contains(e.target);
        const isExpanded = toggler.getAttribute("aria-expanded") === "true";

        if (!isClickInside && isExpanded) {
          const bsCollapse = bootstrap.Collapse.getInstance(collapse);
          if (bsCollapse) {
            bsCollapse.hide();
          }
          toggleBodyScroll(false);
        }
      }
    });

    // Закрытие при изменении размера окна
    window.addEventListener("resize", () => {
      if (window.innerWidth >= 992) {
        const bsCollapse = bootstrap.Collapse.getInstance(collapse);
        if (bsCollapse && collapse.classList.contains("show")) {
          bsCollapse.hide();
        }
        toggleBodyScroll(false);
      }
    });

    // Закрытие при нажатии Escape
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && window.innerWidth < 992) {
        const isExpanded = toggler.getAttribute("aria-expanded") === "true";
        if (isExpanded) {
          const bsCollapse = bootstrap.Collapse.getInstance(collapse);
          if (bsCollapse) {
            bsCollapse.hide();
          }
          toggleBodyScroll(false);
        }
      }
    });
  }
})(jQuery);
