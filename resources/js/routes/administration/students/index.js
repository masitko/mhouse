const UsersIndex = () => import('../../../pages/administration/users/Index.vue');

export default {
    name: 'administration.students.index',
    path: '',
    component: UsersIndex,
    meta: {
        breadcrumb: 'index',
        title: 'Students',
    },
};
