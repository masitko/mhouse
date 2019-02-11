import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./wheels', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'wheels',
    component: RouterView,
    meta: {
        breadcrumb: 'wheels',
        route: 'wheels.wheels.index',
    },
    children: routes,
};
