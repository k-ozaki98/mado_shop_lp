import { initHmbMenu } from './modules/hamburger-menu'

import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import { initCommon } from './common'
import '../styles/style.scss'
import { initTop } from './pages/top'
import { initForm } from './pages/form'
import { initWork } from './pages/work'
gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {
  const pageId = document.querySelector('body').getAttribute('data-pageid')
  const isTop = pageId === 'top';
  if (isTop) {
    initTop() // トップページ用スクリプト
    initForm()
    initWork()
  }
  const isWork = pageId === 'works';
  if (isWork) {
    initWork()
  }
})
