const SchoolClassShow = () => import('../../../pages/schools/classes/Show.vue');

export default {
    name: 'schools.classes.show',
    path: ':schoolClass',
    component: SchoolClassShow,
    meta: {
        breadcrumb: 'show',
        title: 'School Class Profile',
    },
};
