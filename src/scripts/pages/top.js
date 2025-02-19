import { jquery } from 'jquery';

export const initTop = () => {
  $(document).ready(function () {
    // スクロール時の処理
    $(window).scroll(function () {
      // fade-inクラスを持つ要素が画面内に入ったらフェードイン
      $('.fade-in:in-viewport').fadeIn();
    });

    // jQueryプラグインの拡張メソッドを追加
    $.extend($.expr[':'], {
      'in-viewport': function (el) {
        var rect = el.getBoundingClientRect();
        return (
          rect.top >= 0 &&
          rect.left >= 0 &&
          rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
          rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
      }
    });
  });
}