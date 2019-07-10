import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./exports', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'exports',
    component: RouterView,
    meta: {
        breadcrumb: 'exports',
        route: 'schools.exports.index',
    },
    children: routes,
};
