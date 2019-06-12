import routeImporter from '../../modules/importers/routeImporter';

const routes = routeImporter(require.context('./students', false, /.*\.js$/));
const RouterView = () => import('../../core/Router.vue');

export default {
    path: 'students',
    component: RouterView,
    meta: {
        breadcrumb: 'students',
        route: 'administration.students.index',
        prefix: 'administration.students'
    },
    children: routes,
};
