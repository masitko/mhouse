import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./schools', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'schools',
    component: RouterView,
    meta: {
        breadcrumb: 'schools',
        route: 'administration.schools.index',
    },
    children: routes,
};
