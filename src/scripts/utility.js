/**
 * URLからクエリパラメータの値を取得します。
 * @param {string} name - クエリパラメータの名前。
 * @param {string} [url=window.location.href] - クエリパラメータを抽出するURL。
 * @returns {string|null} - クエリパラメータの値。見つからない場合はnull。
 */
export const getParam = (name, url) => {
  if (!url) url = window.location.href
  name = name.replace(/[[\]]/g, '\\$&')
  const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)')
  const results = regex.exec(url)
  if (!results) return null
  if (!results[2]) return ''
  return decodeURIComponent(results[2].replace(/\+/g, ' '))
}

/**
 * 特定のプロパティ値に基づいて配列内のオブジェクトを検索します。
 * @param {string} [id=""] - 検索するプロパティの値。
 * @param {Object[]} [data=[]] - 検索対象のオブジェクトの配列。
 * @returns {Object|null} - 検索されたオブジェクト。見つからない場合はnull。
 */
export const findData = (id = '', data = []) => {
  const d = data.find((element) => element.id === id)
  return d
}

/**
 * 指定された値を最小値と最大値の範囲で正規化します。
 *
 * @param {number} value - 正規化する値
 * @param {number} minValue - 最小値
 * @param {number} maxValue - 最大値
 * @returns {number} - 正規化された値
 */
export const normalize = (value, minValue, maxValue) => {
  if (minValue === maxValue) {
    return 0
  }
  return (value - minValue) / (maxValue - minValue)
}

/**
 * 指定された数字を指定された桁数になるようにゼロパディングします。
 *
 * @param {number} number - ゼロパディングする数字
 * @param {number} length - 桁数
 * @returns {string} - ゼロパディングされた文字列
 */
export const zeroPadding = (number, length) => {
  let str = String(number)

  if (str.length >= length) {
    return str
  } else {
    const diff = length - str.length
    for (let i = 0; i < diff; i++) {
      str = '0' + str
    }
    return str
  }
}
