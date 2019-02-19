import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./terms', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'terms',
    component: RouterView,
    meta: {
        breadcrumb: 'terms',
        route: 'schools.terms.index',
    },
    children: routes,
};
