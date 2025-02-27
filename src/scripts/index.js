import {
  initHmbMenu
} from './modules/hamburger-menu'

import {
  gsap
} from 'gsap'
import {
  ScrollTrigger
} from 'gsap/ScrollTrigger'
import {
  initCommon
} from './common'
import '../styles/style.scss'
import {
  initTop
} from './pages/top'
import {
  initForm
} from './pages/form'
import {
  initWork
} from './pages/work'
gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {
  const pageId = document.querySelector('body').getAttribute('data-pageid')
  const isTop = pageId === 'top';
  if (isTop) {
    // initTop() // トップページ用スクリプト
    initForm()
    initWork()

  }
  const isWork = pageId === 'works';
  if (isWork) {
    initWork()
  }

  initHmbMenu();

  const navItems = document.querySelectorAll('.nav__item');

  if (!pageId || !navItems.length) return;

  navItems.forEach(item => {
    const navId = item.getAttribute('data-nav-id');
    if (navId === pageId) {
      item.classList.add('is-active');
    }
  })

  const mv = document.getElementById("mv");
  const header = document.getElementById("header");


  window.addEventListener("scroll", function () {
    const mvHeight = mv.offsetHeight; // MVの高さを取得
    if (window.scrollY > mvHeight) {
      header.style.opacity = "1"; // フェードイン
    } else {
      header.style.opacity = "0"; // フェードアウト
    }
  });


})