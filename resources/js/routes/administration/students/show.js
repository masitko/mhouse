const UserShow = () => import('../../../pages/administration/users/Show.vue');

export default {
    name: 'administration.students.show',
    path: ':user',
    component: UserShow,
    meta: {
        breadcrumb: 'show',
        title: 'Student Profile',
    },
};
