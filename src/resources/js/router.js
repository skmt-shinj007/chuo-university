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
      component: Home,    // コンポーネントの指定
      label: 'ホーム',
      external: false,
    },
    {
      path: '/club',
      name: 'club',
      component: Club,
      label: 'クラブ',
      external: false,
    },
    {
      path: '/member',
      name: 'member',
      component: Member,
      label: 'メンバー',
      external: false,
    },
    {
      path: '/Hakumonkai',
      name: 'hakumonkai',
      component: Hakumonkai,
      label: '白門会',
      external: false,
    },
    {
      path: '/history',
      name: 'history',
      component: History,
      label: '歴史',
      external: false,
    },
    {
      path: '/photo',
      name: 'photo',
      component: Photo,
      label: 'フォトギャラリー',
      external: false,
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
      url: 'https://www.chuo-u.ac.jp/',
      external: true,
      label: '中央大学ホームページ'
    },
    {
      path: '/ritsumeikan',
      url: 'http://www5c.biglobe.ne.jp/~rst/',
      external: true,
      label: '立命館大学ホームページ'
    },
    {
      path: '/japan-student-federation',
      url: 'https://www.jssta.jp/',
      external: true,
      label: '日本学生ソフトテニス連盟'
    },
    {
      path: '/kanto-student-federation',
      url: 'https://kssta.net/',
      external: true,
      label: '関東学生ソフトテニス連盟'
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
