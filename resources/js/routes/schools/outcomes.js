import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./outcomes', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'outcomes',
    component: RouterView,
    meta: {
        breadcrumb: 'outcomes',
        route: 'schools.outcomes.index',
    },
    children: routes,
};
