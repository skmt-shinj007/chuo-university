import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

// コンポーネントをインポート
import Home from './views/Home.vue';
import Club from './views/Club.vue';
import Member from './views/Member.vue';
import Hakumonkai from './views/Hakumonkai.vue';
import History from './views/History.vue';
import Photo from './views/Photo.vue';

// エラーページをインポート
import NotFound from './views/errorPage/NotFound.vue';

// テスト用ページ
import Test from './views/Test.vue';

// ページ単位のVueコンポーネントをルーティング
export default new VueRouter({
  // モードの設定
  mode: 'history',
  routes: [
    {
      path: '*',
      redirect: "notFound"
    },
    {
      path: '/',        // routeのパス設定
      name: 'home',      // 名前付きルートを設定したい場合付与
      component: Home    // コンポーネントの指定
    },
    {
      path: '/club',
      name: 'club',
      component: Club
    },
    {
      path: '/member',
      name: 'member',
      component: Member
    },
    {
      path: '/Hakumonkai',
      name: 'hakumonkai',
      component: Hakumonkai
    },
    {
      path: '/history',
      name: 'history',
      component: History
    },
    {
      path: '/photo',
      name: 'photo',
      component: Photo
    },
    {
      path: '/test',
      name: 'test',
      component: Test
    },
    {
      path: '/contact',
      name: 'contact',
      redirect: '/blade/contact'
    },

    /**
     * エラーページ
     * [400番台と500番台を用意する]
     */
    {
      // 404
      path: '/notFound',
      name: 'notFound',
      component: NotFound
    },

    /**
     * 外部リンク
     */
    {
      path: '/chuo',
      beforeEnter: () => {
        location.href = 'https://www.chuo-u.ac.jp/'
      },
    },
    {
      path: '/ritsumeikan',
      beforeEnter: () => {
        location.href = 'http://www5c.biglobe.ne.jp/~rst/'
      },
    },
    {
      path: '/japan-softtennis-student',
      beforeEnter: () => {
        location.href = 'https://www.jssta.jp/'
      },
    },
    {
      path: '/kantou-softtennis-student',
      beforeEnter: () => {
        location.href = 'https://kssta.net/'
      },
    }
  ],

  /**
   * ページ遷移時のスクロール位置を制御
   * @param {*} to
   * @param {*} from
   * @param {*} savedPosition
   */
  scrollBehavior (to, from, savedPosition) {
    return (savedPosition) ? savedPosition : { x: 0, y: 0};
  }
});
