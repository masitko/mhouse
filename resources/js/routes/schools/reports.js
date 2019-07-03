import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./reports', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'reports',
    component: RouterView,
    meta: {
        breadcrumb: 'reports',
        route: 'schools.reports.index',
    },
    children: routes,
};
