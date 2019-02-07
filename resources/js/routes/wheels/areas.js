import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./areas', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'areas',
    component: RouterView,
    meta: {
        breadcrumb: 'areas',
        route: 'wheels.areas.index',
    },
    children: routes,
};
