const UserShow = () => import('../../../pages/administration/users/Show.vue');

export default {
    name: 'administration.students.show',
    path: ':student',
    component: UserShow,
    meta: {
        breadcrumb: 'show',
        title: 'Student Profile',
    },
};
