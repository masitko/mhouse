import routeImporter from '../modules/importers/routeImporter';

const routes = routeImporter(require.context('./wheels', false, /.*\.js$/));
const RouterView = () => import('../core/Router.vue');

export default {
    path: '/wheels',
    component: RouterView,
    meta: {
        breadcrumb: 'wheels',
    },
    children: routes,
};
