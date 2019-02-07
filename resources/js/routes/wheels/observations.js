import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./observations', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'observations',
    component: RouterView,
    meta: {
        breadcrumb: 'observations',
        route: 'wheels.observations.index',
    },
    children: routes,
};
