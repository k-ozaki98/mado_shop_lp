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

jQuery(document).ready(function($) {
  var maxWindows = 5;

  // 窓を追加する
  $('.form__add-window').on('click', function() {
    var count = $('.window-info').length;
    if (count < maxWindows) {
      var newIndex = count + 1;
      var newWindow = $('.window-info').first().clone();
      
      // インデックスの更新
      newWindow.attr('data-index', newIndex);
      newWindow.find('h4').text('窓の情報（' + newIndex + '）');
      newWindow.find('input[name^="height-"]').attr('name', 'height-' + newIndex);
      newWindow.find('input[name^="width-"]').attr('name', 'width-' + newIndex);
      newWindow.find('input[name^="frame-"]').attr('name', 'frame-' + newIndex);
      newWindow.find('input[name^="photo-"]').attr('name', 'photo-' + newIndex);
      newWindow.find('input[name^="count-"]').attr('name', 'count-' + newIndex);
      newWindow.find('select[name^="place-"]').attr('name', 'place-' + newIndex);

      // 削除ボタン表示
      newWindow.find('.remove-window').show();

      // 新しい窓の情報を追加
      newWindow.insertBefore('.form__add-btn');

      // window_count の更新
      $('input[name="window_count"]').val(newIndex);
      
      // Contact Form 7 の再初期化
      if (typeof wpcf7 !== 'undefined') {
        wpcf7.initForm($('form.wpcf7-form'));
      }
    }
  });

  // 窓を削除する
  $(document).on('click', '.remove-window', function() {
    $(this).parent('.window-info').remove();

    // インデックスの再設定
    $('.window-info').each(function(index) {
      var newIndex = index + 1;
      $(this).attr('data-index', newIndex);
      $(this).find('h4').text('窓の情報（' + newIndex + '）');
    });

    // window_count の更新
    var updatedCount = $('.window-info').length;
    $('input[name="window_count"]').val(updatedCount);
  });
});
