import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

// コンポーネントをインポート
import Top from './views/Top.vue';
import Club from './views/Club.vue';
import Member from './views/Member.vue';
import Hakumonkai from './views/Hakumonkai.vue';
import History from './views/History.vue';
import Photo from './views/Photo.vue';
import Contact from './views/Contact.vue';

// テスト用ページ
import Test from './views/Test.vue';

// ページ単位のVueコンポーネントをルーティング
export default new VueRouter({
    // モードの設定
    mode: 'history',
    routes: [
    {
        path: '/',        // routeのパス設定
        name: 'top',      // 名前付きルートを設定したい場合付与
        component: Top    // コンポーネントの指定
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
        path: '/contact',
        name: 'contact',
        component: Contact
    },
    {
        path: '/test',
        name: 'test',
        component: Test
    },
    ]
});
