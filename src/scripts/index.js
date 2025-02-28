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
import jquery from 'jquery'
gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {
  const pageId = document.querySelector('body').getAttribute('data-pageid')
  const isTop = pageId === 'top';
  if (isTop) {
    // initTop() // トップページ用スクリプト
    // initForm()
    initWork()

    jquery(function($){
      $.datepicker.regional['ja'] = {
        closeText: '閉じる',
        prevText: '&#x3C;前',
        nextText: '次&#x3E;',
        currentText: '今日',
        monthNames: ['1月','2月','3月','4月','5月','6月',
        '7月','8月','9月','10月','11月','12月'],
        monthNamesShort: ['1月','2月','3月','4月','5月','6月',
        '7月','8月','9月','10月','11月','12月'],
        dayNames: ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],
        dayNamesShort: ['日','月','火','水','木','金','土'],
        dayNamesMin: ['日','月','火','水','木','金','土'],
        weekHeader: '週',
        dateFormat: 'yy/mm/dd',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: true,
        yearSuffix: '年'
      };
      $.datepicker.setDefaults($.datepicker.regional['ja']);
    });
    
    
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

})
