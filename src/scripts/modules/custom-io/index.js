/**
 * IntersectionObserverを使用して要素の交差を監視するクラスです。
 */
export default class {
  /**
   * クラスのインスタンスを作成します。
   *
   * @param {string} className - 監視対象の要素のクラス名。
   * @param {Object} [options={}] - IntersectionObserverのオプション。
   * @param {Element} [options.root=null] - 監視対象要素が交差を検出するために使用する要素。
   * @param {string} [options.rootMargin="-50% 0px"] - 監視対象要素の交差を検出するためのマージン。
   * @param {number} [options.threshold=0] - 監視対象要素の可視性がどの程度変化したとみなされるかを示す閾値。
   */
  constructor(className, options = {}) {
    const defaultOptions = {
      root: null,
      rootMargin: '-50% 0px',
      threshold: 0
    }
    this.observer = new IntersectionObserver(this._doWhenIntersect.bind(this), {
      ...defaultOptions,
      ...options
    })
    this.subscribers = {
      intersect: [],
      in: [],
      out: []
    }
    const targets = document.querySelectorAll(className)
    targets.forEach((target) => {
      this.observer.observe(target)
    })
  }

  /**
   * 交差が検出されたときに実行するコールバック関数を追加します。
   *
   * @param {Function} callback - 交差が検出されたときに実行するコールバック関数。
   */
  intersect(callback) {
    this.subscribers.intersect.push(callback)
  }

  /**
   * 要素が画面内に入ったときに実行するコールバック関数を追加します。
   *
   * @param {Function} callback - 要素が画面内に入ったときに実行するコールバック関数。
   */
  in(callback) {
    this.subscribers.in.push(callback)
  }

  /**
   * 要素が画面外に出たときに実行するコールバック関数を追加します。
   *
   * @param {Function} callback - 要素が画面外に出たときに実行するコールバック関数。
   */
  out(callback) {
    this.subscribers.out.push(callback)
  }

  /**
   * 指定されたイベントをトリガーし、関連するコールバック関数を実行します。
   *
   * @param {string} event - トリガーするイベントの名前。
   * @param {any} args - コールバック関数に渡される引数。
   */
  _trigger(event, args) {
    const ref = this.subscribers[event]
    for (let i = 0, len = ref.length; i < len; i++) {
      const listener = ref[i]
      if (typeof listener === 'function') listener(args)
    }
  }

  /**
   * IntersectionObserverの交差検出時に実行するコールバック関数です。
   *
   * @param {IntersectionObserverEntry[]} entries - IntersectionObserverのエントリー。
   */
  _doWhenIntersect(entries) {
    this._trigger('intersect', entries)
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        this._trigger('in', entry)
      } else {
        this._trigger('out', entry)
      }
    })
  }
}
