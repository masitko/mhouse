import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./classes', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'classes',
    component: RouterView,
    meta: {
        breadcrumb: 'classes',
        route: 'schools.classes.index',
    },
    children: routes,
};
