import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./checklists', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'checklists',
    component: RouterView,
    meta: {
        breadcrumb: 'checklists',
        route: 'schools.checklists.index',
    },
    children: routes,
};
