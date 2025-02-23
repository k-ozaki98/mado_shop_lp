import {
  gsap
} from 'gsap'
import {
  ScrollTrigger
} from 'gsap/ScrollTrigger'
export const initCommon = () => {

  gsap.fromTo(
    ".about__img", {
      y: 250,
    }, {
      y: -150,
      ease: "none",
      scrollTrigger: {
        trigger: ".about",
        start: "top bottom",
        end: "bottom top",
        scrub: true,
      },
    }
  );

  const swiper = new Swiper(".swiper", {
    // ページネーションが必要なら追加
    pagination: {
      el: ".swiper-pagination"
    },
    // ナビボタンが必要なら追加
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    loop: true,
    slidesPerView: 2,
    centeredSlides: true,
    spaceBetween: 20,
  });
};