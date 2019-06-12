const UserEdit = () => import('../../../pages/administration/users/Edit.vue');

export default {
    name: 'administration.students.edit',
    path: ':student/edit',
    component: UserEdit,
    meta: {
        breadcrumb: 'edit',
        title: 'Edit Student',
    },
};
